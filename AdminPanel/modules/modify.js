var convertForm = {
    convertIntoAdminPanel:function(){
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

            //create new button that delete row
            if(label.parentElement == label.parentElement.parentElement.children[0]){
                let newButton = document.createElement('button');
                newButton.setAttribute('onClick', 'deleterow(\''+labelfor+'\')');
                newButton.innerHTML = "Usuń";
                label.parentNode.appendChild(newButton);
            }
            label.replaceWith(newInput);
        });
        //change title into input
        let title = document.getElementById('tytul');
        let input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('id', 'title');
        input.setAttribute('value', title.innerHTML);
        title.innerHTML = "";
        title.appendChild(input);
        //add adminpanel
        var textadd = '<div class="center" id="modipanel"><div class="playground" style="margin-top: 30px;"><button onclick="addElement()">Dodaj</button><input type="text" id="spacename" placeholder="Nazwa pola"> <select id="inputtype"><option value="text">Text</option><option value="radio">Radio</option><option value="password">Password</option><option value="email">E-mail</option><option value="checkbox">Checkbox</option><option value="file">File</option></select><select id="inputplace"><option value="Dane personalne">Dane personalne</option><option value="Dane kontaktowe">Dane kontaktowe</option><option value="Inne">Inne</option></select> <br><button onclick="undoChange()">Cofnij Zmiany</button><br><button onclick="saveChange()">Zapisz zmiany</button><br></div></div>';
        main.innerHTML = main.innerHTML+textadd;
    }, 
    convertintoUserForm:function(){ 
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
    }
};

async function overwriteModifyFile(){
    convertForm.convertintoUserForm();
    let formData = new FormData;
    let fileName = location.pathname.split("/").slice(-1);
    fileName = decodeURIComponent(fileName);
    let content = document.body.innerHTML;
    formData.append("content", content);
    formData.append("formName", fileName);
    //console.log(formData);
    await fetch('../AdminPanel/modules/overwriteForm.php', {
        method: 'POST',
        body: formData
    });
    convertForm.convertIntoAdminPanel();
    //alert("dsa");
    return null;
}

function deleterow(rowid){
    let elem = document.getElementById(rowid);
    elem.parentElement.parentElement.remove();
    overwriteModifyFile();
}
class createElement{
    constructor(){
        this.inputtype = document.getElementById('inputtype');
        this.inputplace = document.getElementById('inputplace');
        if(!document.getElementById(document.getElementById("spacename").value)){
            this.val = document.getElementById("spacename").value;
        }else{
            this.val = "Wartosc";
        }
        this.type = inputtype.options[inputtype.selectedIndex].value;
        this.place = inputplace.options[inputplace.selectedIndex].value;
    }
    createUserInput(){
        const input = document.createElement("input")
        input.setAttribute("type", this.type);
        input.setAttribute("name", this.val);
        input.setAttribute("id", this.val);
        input.setAttribute("disabled", true);
        input.setAttribute("required", true);
        return input;
    }
    createAdminInput(){
        const input = document.createElement("input")
        input.setAttribute("type", "text");
        input.setAttribute("value", this.val);
        return input;
    }
    createButton(){
        const button = document.createElement("button");
        button.innerHTML = "Usuń";
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
}
function addElement(){
    const element = new createElement();
    col = element.createCol();
    col.appendChild(element.createAdminInput());
    col.appendChild(element.createButton());
    row = element.createRow();
    row.appendChild(col);
    col = element.createCol();
    col.appendChild(element.createUserInput());
    row.appendChild(col);
    element.getplace.appendChild(row);
}
async function undoChange(){
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
document.body.onchange = function(){
    overwriteModifyFile();
};
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
    //alert("dsa");
    return null;
}

convertForm.convertIntoAdminPanel();
// convertForm.convertintoUserForm();
console.log(document.body.innerHTML);