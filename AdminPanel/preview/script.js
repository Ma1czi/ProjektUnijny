function print(){
    let doc = new jsPDF('p','pt','a4');

doc.addHTML(document.getElementById('tabletoprint'),function() {
    doc.save('html.pdf');
});
}