
var getFromBetween = {
    results:[],
    string:"",
    getFromBetween:function (sub1,sub2) {
        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return false;
        var SP = this.string.indexOf(sub1)+sub1.length;
        var string1 = this.string.substr(0,SP);
        var string2 = this.string.substr(SP);
        var TP = string1.length + string2.indexOf(sub2);
        return this.string.substring(SP,TP);
    },
    removeFromBetween:function (sub1,sub2) {
        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return false;
        var removal = sub1+this.getFromBetween(sub1,sub2)+sub2;
        this.string = this.string.replace(removal,"");
    },
    getAllResults:function (sub1,sub2) {
        // first check to see if we do have both substrings
        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return;

        //  input one result
        var result = this.getFromBetween(sub1,sub2);
        // push it to the results array
        this.results.push(result);
        // remove the most recently found one from the string
        this.removeFromBetween(sub1,sub2);

        // if there's more substrings
        if(this.string.indexOf(sub1) > -1 && this.string.indexOf(sub2) > -1) {
            this.getAllResults(sub1,sub2);
        }
        else return;
    },
    get:function (string,sub1,sub2) {
        this.results = [];
        this.string = string;
        this.getAllResults(sub1,sub2);
        return this.results;
    },
    getone:function(string,sub1,sub2){
        this.string = string;
        return this.getFromBetween(sub1,sub2);
    }
};

var convertForm = {
    convertIntoAdminPanel:function(){
        var main = document.querySelector("main");
        var result = getFromBetween.get(main.innerHTML,'<label','</label>');
        //console.log(result);
        var textadd = '<div class="center" id="modipanel"><div class="playground" style="margin-top: 30px;"><button onclick="addElement()">Dodaj</button><input type="text" id="spacename" placeholder="Nazwa pola"> <select id="inputtype"><option value="text">Text</option><option value="radio">Radio</option><option value="password">Password</option><option value="email">E-mail</option><option value="checkbox">Checkbox</option><option value="file">File</option></select><select id="inputplace"><option value="Dane personalne">Dane personalne</option><option value="Dane kontaktowe">Dane kontaktowe</option><option value="Inne">Inne</option></select> <br><button onclick="undoChange()">Cofnij Zmiany</button><br><button onclick="">Zapisz zmiany</button><br></div></div>';
        if(!document.getElementById("spacename")){
            main.innerHTML = main.innerHTML.replace(/<input/g, '<input disabled');

            main.innerHTML = main.innerHTML+textadd;

        }

        result.forEach(element => {
            var input = element;
            var rowid = getFromBetween.getone(input,'"','"');
            //console.log(input);
            input =  input.replace('for=\"'+rowid+'\"', '<input type="text"');
            input =  input.replace('>', ' value="');
            input = input+'\"><button onclick="deleterow(\''+rowid+'\')">Usuń</button>';
            //console.log(input);
            var find = '<label'+element+'</label>';
            //console.log(rowid);
            main.innerHTML = main.innerHTML.replace(find, input);
        });
        //console.log(document.body.innerHTML);
    }, 
    convertintoUserForm:function(){ 
        document.getElementById("modipanel").remove();
        selectiontr = document.querySelectorAll('tr');
        selectiontr.forEach(tr => {
            if(tr.children[0].children[0] != undefined){
                //get id for label we create
                let id = tr.children[1].children[0].getAttribute('id');

                //create new label
                let newlabel = document.createElement('label');
                newlabel.setAttribute('for', id);
                newlabel.innerHTML = tr.children[0].children[0].getAttribute('value');
                //replace element 
                deleteAllChild(tr.children[0])
                tr.children[0].appendChild(newlabel);

                //create new userinput 
                var newuserinput = [];
                for(let i=0; i<tr.children[1].children.length; i++){

                    let userinput = tr.children[1].children[i];
                    userinput.removeAttribute('disabled');
                    newuserinput.push(userinput);
                }
                //replece element
                deleteAllChild(tr.children[1]);
                newuserinput.forEach(elemnet =>{
                    tr.children[1].appendChild(elemnet);
                });
            }
        });
        function deleteAllChild(myNode){
            while (myNode.firstChild) {
                myNode.removeChild(myNode.lastChild);
            }
        }


    }
};

async function overwriteModifyFile(){
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
    //alert("dsa");
    return null;
}

function deleterow(rowid){
    let elem = document.getElementById(rowid);
    elem.parentElement.parentElement.remove();
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

// window.onbeforeunload = confirmExit;
// async function confirmExit(){
//    await overwriteModifyFile();

//     return null;
// }
convertForm.convertIntoAdminPanel();
console.log(document.querySelectorAll('tr'));