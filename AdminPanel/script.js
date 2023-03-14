function modifefile(filepath){
    filepath = "../FormModify/"+filepath;
    window.location.href = filepath;
}
async function deletefile(filepath){
    var formData = new FormData;
    formData.set("filepath", filepath);
    await fetch('modules/delete.php', {
        method: 'POST',
        body: formData
    });
    window.location.reload();
}

