
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
        var textadd = '<div class="center"><div class="playground" style="margin-top: 30px;"><button onclick="addElement()">Dodaj</button><input type="text" id="spacename" placeholder="Nazwa pola"> <select id="inputtype"><option value="text">Text</option><option value="radio">Radio</option><option value="password">Password</option><option value="email">E-mail</option><option value="checkbox">Checkbox</option><option value="file">File</option></select><select id="inputplace"><option value="Dane personalne">Dane personalne</option><option value="Dane kontaktowe">Dane kontaktowe</option><option value="Inne">Inne</option></select> <br><button onclick="">Cofnij Zmiany</button><br><button onclick="">Zapisz zmiany</button><br></div></div>';
        if(!document.getElementById("spacename")){
            main.innerHTML = main.innerHTML.replace(/<input/g, '<input disabled');

            main.innerHTML = main.innerHTML+textadd;

        }

        result.forEach(element => {
            var input = element;
            var rowid = getFromBetween.getone(input,'"','"');
            console.log(input);
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
        
    }
};

async function overwriteModifyFile(){
    var formData = new FormData;
    var fileName = location.pathname.split("/").slice(-1);
    fileName = decodeURIComponent(fileName);
    var content = document.body.innerHTML;
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
    var elem = document.getElementById(rowid);
    elem.parentElement.parentElement.remove();
}

window.onbeforeunload = confirmExit;
async function confirmExit(){
    await overwriteModifyFile();
    //alert("confirm exit is being called");
    return false;
}

function addElement(){
    const inputtype = document.getElementById('inputtype');
    const inputplace = document.getElementById('inputplace');
    
    const val = document.getElementById("spacename").value;
    const type = inputtype.options[inputtype.selectedIndex].value;
    const place = inputplace.options[inputplace.selectedIndex].value;
    
    // console.log(val);
    // console.log(type);
    // console.log(place);
    
    
    //console.log(val);
    const fieldset = document.getElementById(place);
    
    const newtablerow = document.createElement("tr");
    const newtablecol1 = document.createElement("td");
    const input1 = document.createElement("input")
    input1.setAttribute("type", "text");
    input1.setAttribute("value", val);

    const button = document.createElement("button");
    button.innerHTML = "Usuń";
    button.setAttribute("onclick", 'deleterow(\''+val+'\')');

    newtablecol1.appendChild(input1);
    newtablecol1.appendChild(button);
    newtablerow.appendChild(newtablecol1);

    const newtablecol = document.createElement("td");
    const input = document.createElement("input")
    input.setAttribute("type", type);
    input.setAttribute("name", val);
    input.setAttribute("id", val);
    input.setAttribute("disabled", true);

    newtablecol.appendChild(input)
    newtablerow.appendChild(newtablecol);
    
    fieldset.appendChild(newtablerow);
    
    
}


convertForm.convertIntoAdminPanel();