function print(){
    let background = document.getElementById('tabletoprint');
    let borderRadius = background.style.borderRadius;
    let border = background.style.border;
    background.style.borderRadius = '0';
    background.style.border = 'none';
    let doc = new jsPDF('p','pt','a4');

doc.addHTML(document.getElementById('tabletoprint'),function() {
    doc.save('html.pdf');
});
}
function back(){
    window.location.href = '../';
}