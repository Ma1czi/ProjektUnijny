


async function modifefile(filepath){
    var formData = new FormData;
    formData.set("filepath", filepath);
    var response = await (await fetch('modules/modify.php', {
        method: 'POST',
        body: formData
    })).text()
    window.location.reload();
    alert(response);
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

