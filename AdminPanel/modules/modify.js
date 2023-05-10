var convertForm = {
    convertIntoAdminPanel:function(){
        let playground = document.getElementsByClassName('playground')[0];
        // playground.setAttribute('onchange', 'findchange()');
        var main = document.querySelector("main");
        //disabled all input
        let allinput = document.querySelectorAll('input');
        allinput.forEach(elemnent =>{
            elemnent.setAttribute('disabled', 'true');
        });
        //change all label to input
        let alllabel = document.querySelectorAll('label');
        alllabel.forEach(label =>{

            //get information about label
            let labelfor = label.getAttribute('for');
            let labelinnerHTML = label.innerHTML;

            //create new input that replace label
            let newInput = document.createElement('input');
            newInput.setAttribute('type', 'text');
            newInput.setAttribute('value', labelinnerHTML);
            newInput.setAttribute('name', labelfor);
            newInput.setAttribute('onchange', 'changevalue(name, value)');

            //create new button that delete row
            if(label.parentElement == label.parentElement.parentElement.children[0]){
                let newButton = document.createElement('button');
                newButton.setAttribute('onClick', 'deleterow(\''+labelfor+'\')');
                newButton.innerHTML = "<div class='trash'><svg width='20' height='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z' fill='currentColor'/><path d='M9 9H11V17H9V9Z' fill='currentColor' /><path d='M13 9H15V17H13V9Z' fill='currentColor' /></svg></div>";
                label.parentNode.appendChild(newButton);

                //change name and id when user set value
                newInput.setAttribute('onchange', 'findchange(name, value)');
            }
            label.replaceWith(newInput);
        });
        //change title into input
        let title = document.getElementById('tytul');
        let input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('id', 'title');
        input.setAttribute('value', title.innerHTML);
        input.setAttribute('onchange', 'changetitle(value)');
        title.innerHTML = "";
        title.appendChild(input);
        //add adminpanel
        var textadd = '<div class="center" id="modipanel"><div class="playground" style="margin-top: 30px; display:flex; height: 60px;"><div style="width: calc(100% - 30px);"><button onclick="addElement()">Dodaj</button><input type="text" id="spacename" placeholder="Nazwa pola"> <select id="inputtype"><option value="text">Text</option><option value="password">Password</option><option value="email">E-mail</option><option value="checkbox">Checkbox</option><option value="file">File</option><option value="radio">Radio</option></select><select id="inputplace"><option value="Dane personalne">Dane personalne</option><option value="Dane kontaktowe">Dane kontaktowe</option><option value="Inne">Inne</option></select> <br><button onclick="undoChange()">Cofnij Zmiany</button><br><button onclick="saveChange()">Zapisz zmiany</button><br></div><div style="width: 30px; color:white;"><details><summary><div class="info"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="info"><g data-name="Layer 2"><g data-name="info"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"></path><circle cx="12" cy="8" r="1"></circle><path d="M12 10a1 1 0 0 0-1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0-1-1z"></path></g></g></svg></div></summary><div><b>Lista nazw wyjątkowych:</b> <br><q>Emial</q> - dodaje wymóg użycia @.<q>Kod</q> - dodaje wymóg użycia składni 00-000. <br></div></details></div></div></div>';
        main.innerHTML = main.innerHTML+textadd;

        //disabled form action
        let faction = document.querySelector('form');
        faction.removeAttribute('action');

    }, 
    convertintoUserForm:function(){ 
        let playground = document.getElementsByClassName('playground')[0];
        //playground.removeAttribute('onchange');
        document.getElementById("modipanel").remove();
        let allinput = document.querySelectorAll('input');
        allinput.forEach(input =>{

            if(input.getAttribute('id') == null){
                //get information about input
                let inputvalue = input.value;
                let inputname = input.getAttribute('name');

                //create and set new label
                let newlabel = document.createElement('label');
                newlabel.setAttribute('for', inputname);
                newlabel.innerHTML = inputvalue;
                if(input.parentElement.querySelector('button')){
                    input.parentElement.querySelector('button').remove();
                }
                input.replaceWith(newlabel);
            }else if(input.getAttribute('id') == 'title'){
                input.parentElement.innerHTML = input.value;
            }else{
                input.removeAttribute('disabled');

            }
        });
        //abled form action
        //disabled form action
        let faction = document.querySelector('form');
        faction.setAttribute('action', '../ConnDB/addElement.php');
    }
};
class log{
    constructor(){
        this.log = [];
    }
    addlog(id, change){
        let log = id+'|'+change;
        this.log.push(log);
    }
    resetlog(){
        this.log = [];
    }
    get logs(){
        return this.log;
    }
}
async function overwriteModifyFile(){
    convertForm.convertintoUserForm();
    let formData = new FormData;
    let fileName = location.pathname.split("/").slice(-1);
    fileName = decodeURIComponent(fileName);
    let content = document.body.innerHTML;
    formData.append("content", content);
    formData.append("formName", fileName);
    formData.append("logs", clog.logs);
    //console.log(formData);
    await fetch('../AdminPanel/modules/overwriteForm.php', {
        method: 'POST',
        body: formData
    });
    convertForm.convertIntoAdminPanel();
    //alert("dsa");
    return null;
}

async function deleterow(rowid){
    let elem = document.getElementById(rowid);
    clog.addlog(rowid, 'delete');
    elem.parentElement.parentElement.remove();
    console.log(clog.logs);
    overwriteModifyFile();
}
class createElement{
    constructor(){
        this.inputtype = document.getElementById('inputtype');
        this.inputplace = document.getElementById('inputplace');
        if(document.getElementById('quantity') != null){
            let inputquantity = document.getElementById('quantity');
            this.quantity = inputquantity.options[inputquantity.selectedIndex].value;
        }

        if(!document.getElementById(document.getElementById("spacename").value)){
            this.val = document.getElementById("spacename").value;
        }else{
            this.val = "Wartosc";
        }
        this.type = inputtype.options[inputtype.selectedIndex].value;
        this.place = inputplace.options[inputplace.selectedIndex].value;
    }
    createUserInput(){
        if(document.getElementById('quantity') == null){
            let input = document.createElement("input")
            let col = document.createElement('td');
            input.setAttribute("type", this.type);
            input.setAttribute("name", this.val);
            input.setAttribute("id", this.val);
            input.setAttribute("disabled", true);
            input.setAttribute("required", true);
            col.appendChild(input);
            return col;
        }else{
            let col = document.createElement('td');
            for(let i=0; i<this.quantity; i++){
                //create newinput
                let newinput = document.createElement('input');
                newinput.setAttribute('type', this.type);
                if(i == 0){
                    newinput.setAttribute("name", this.val);
                    newinput.setAttribute("id", this.val);
                    newinput.setAttribute("checked", 'true');
                }else{
                    newinput.setAttribute("name", this.val);
                    newinput.setAttribute("id", this.val+i);
                }
                newinput.setAttribute("disabled", true);

                //create newinput that will be label in usermode
                let newlabel = document.createElement('input');
                newlabel.setAttribute('type', 'text');
                newlabel.setAttribute('value', i);
                if(i==0)
                    newlabel.setAttribute('name', this.val);
                else
                    newlabel.setAttribute('name', this.val+i);
                    col.appendChild(newlabel);
                    col.appendChild(newinput);
            }
            return col;
        }
    }
    createAdminInput(){
        const input = document.createElement("input")
        input.setAttribute("type", "text");
        input.setAttribute("value", this.val);
        input.setAttribute("name", this.val);
        return input;
    }
    createButton(){
        const button = document.createElement("button");
        button.innerHTML = "<div class='trash'><svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z' fill='currentColor'/><path d='M9 9H11V17H9V9Z' fill='currentColor' /><path d='M13 9H15V17H13V9Z' fill='currentColor' /></svg></div>";
        button.setAttribute("onclick", 'deleterow(\''+this.val+'\')');
        return button;
    }
    createRow(){
        const row = document.createElement("tr");
        return row;
    }
    createCol(){
        const col = document.createElement("td");
        return col;
    }
    get getplace(){
        return document.getElementById(this.place);
    }
    get id(){
        return this.val;
    }
}
function addElement(){
    const element = new createElement();
    col = element.createCol();
    col.appendChild(element.createAdminInput());
    col.appendChild(element.createButton());
    row = element.createRow();
    row.appendChild(col);
    row.appendChild(element.createUserInput());
    element.getplace.appendChild(row);
    clog.addlog(element.id, 'add');
    console.log(clog.logs);
    overwriteModifyFile();
}
async function undoChange(){
    clog.resetlog();
    let formData = new FormData;
    let fileName = location.pathname.split("/").slice(-1);
    fileName = decodeURIComponent(fileName);
    formData.append("formName", fileName);
    await fetch('../AdminPanel/modules/undoChange.php', {
        method: 'POST',
        body: formData
    });
    window.location.reload();
}
async function changetitle(value){
    let fileName = location.pathname.split("/").slice(-1);
    fileName = decodeURIComponent(fileName);
    clog.addlog(value+';'+fileName, 'changetitle');
    overwriteModifyFile();
}
function changevalue(name, value){
//find all element to change value
    let input = document.getElementById(name);
    input.setAttribute('value', value);
    overwriteModifyFile();
}
function findchange(name, value){
    clog.addlog(name, value);
    console.log(clog.logs);

    //find all element to change value
    let inputs = document.getElementsByName(name);
    let parent = inputs[0].parentElement.parentElement.querySelectorAll('input');
    let button = inputs[0].parentElement.querySelector('button');
    console.log(parent);
    //change value
    button.setAttribute('onClick', 'deleterow(\''+value+'\')');
    parent.forEach(input => {
        if(input.getAttribute('id') != null){
            input.setAttribute('id', value);
        }
        input.setAttribute('name', value);
    });

    overwriteModifyFile();
}
async function saveChange(){
    convertForm.convertintoUserForm();
    let formData = new FormData;
    let fileName = location.pathname.split("/").slice(-1);
    fileName = decodeURIComponent(fileName);
    let content = document.body.innerHTML;
    formData.append("content", content);
    formData.append("formName", fileName);
    //console.log(formData);
    await fetch('../AdminPanel/modules/saveChange.php', {
        method: 'POST',
        body: formData
    });
    convertForm.convertIntoAdminPanel();
    clog.resetlog();
}
if(document.getElementById('modipanel') != null){
    document.getElementById('modipanel').onchange = function(){
        let type = document.getElementById('inputtype');
        let place = document.getElementById('inputplace');
        //create new input
        let newinput = document.createElement('select');
        newinput.setAttribute('id', 'quantity');
        for(let i=1; i<=3; i++){
            let newoption = document.createElement('option');
            newoption.innerHTML = i;
            newoption.setAttribute('value', i);
            newinput.appendChild(newoption);
        }
        
        if(type.value == 'radio' || type.value =='checkbox'){
            if(document.getElementById('quantity') == null){
                place.parentNode.insertBefore(newinput, place);
            }
        }else{
            if(document.getElementById('quantity') != null){
                document.getElementById('quantity').remove();
            }
        }
    };
}
// convertForm.convertintoUserForm();
convertForm.convertIntoAdminPanel();
var clog = new log();
//console.log(document.body.innerHTML);
//console.log(clog.logs);
// [Imie: | drop] Nazwisko: | cos:; wzrost: | add;