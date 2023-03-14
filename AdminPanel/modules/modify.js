
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
        main.innerHTML = main.innerHTML.replace(/<input/g, '<input disabled');
        var result = getFromBetween.get(main.innerHTML,'<label','</label>');
        //console.log(result);
        result.forEach(element => {
            var input = element;
            var rowid = getFromBetween.getone(input,'"','"');
            //console.log(rowid);
            input =  input.replace('for=', '<input type="text" id=');
            input =  input.replace('>', ' value="');
            input = input+'\"><button onclick="deleterow(\''+rowid+'\')">Usuń</button>';
            //console.log(input);
            var find = '<label'+element+'</label>';
            console.log(rowid);
            main.innerHTML = main.innerHTML.replace(find, input);
        });
        main.innerHTML = main.innerHTML+' <div class="center"><div class="playground" style="margin-top: 30px;"><input type="submit" value="Dodaj"><input type="text" name="" id="" placeholder="Nazwa pola"> <select name="np" id="np"><option value="">Text</option><option value="">Radio</option><option value="">Password</option><option value="">E-mail</option><option value="">Checkbox</option><option value="">File</option><option value="">Checkbox</option></select><select name="" id=""><option value="">Dane personalne</option><option value="">Dane kontaktowe</option><option value="">Inne</option></select> <br><input type="submit" value="Cofnij Zmiany"><br><input type="submit" value="Zapisz Zmiany"><br></div></div>';
        //console.log(document.body.innerHTML);
    }, 
    convertintoUserForm:function(){
        
    }
};
function deleterow(rowid){
    var elem = document.getElementById(rowid);
    elem.parentNode.removeChild(elem);
}

convertForm.convertIntoAdminPanel();
    
//<button onclick=\"modifefile('".$filename."')\">