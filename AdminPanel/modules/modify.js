
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
        var textadd = '<div class="center"><div class="playground" style="margin-top: 30px;"><button onclick="addElement()">Dodaj</button><input type="text" name="" id="spacename" placeholder="Nazwa pola"> <select name="np" id="np"><option value="">Text</option><option value="">Radio</option><option value="">Password</option><option value="">E-mail</option><option value="">Checkbox</option><option value="">File</option><option value="">Checkbox</option></select><select name="" id=""><option value="">Dane personalne</option><option value="">Dane kontaktowe</option><option value="">Inne</option></select> <br><input type="submit" value="Cofnij Zmiany"><br><input type="submit" value="Zapisz Zmiany"><br></div></div>';
        if(!document.getElementById("np")){
            main.innerHTML = main.innerHTML.replace(/<input/g, '<input disabled');

            main.innerHTML = main.innerHTML+textadd;

        }

        result.forEach(element => {
            var input = element;
            var rowid = getFromBetween.getone(input,'"','"');
            //console.log(rowid);
            input =  input.replace('for=', '<input type="text" id=');
            input =  input.replace('>', ' value="');
            input = input+'\"><button onclick="deleterow(\''+rowid+'\')">Usuń</button>';
            //console.log(input);
            var find = '<label'+element+'</label>';
            //console.log(rowid);
            main.innerHTML = main.innerHTML.replace(find, input);
        });
        console.log(document.body.innerHTML);
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


convertForm.convertIntoAdminPanel();
function addElement(){
    const val = document.getElementById("spacename").value;
    // alert("Dodaj");
    // const input = document.createElement("input");
    // input.setAttribute("type", type);
    // input.setAttribute("value", value);
    // input.setAttribute("name", value);
    // input.setAttribute("id", value);
        // const val = document.getElementById("place").value;
         alert(val);
    
}