<?php 
$newformname = "Postaw na dobry zawód - elektronik to ty";
$formFolderPath = "../../Form/";
$formModifyFolderPath = "../../FormModify/";
$filetype = ".html";
$jsmodifyfilepath = "../AdminPanel/modules/modify.js";


if(!empty($_POST["formname"])){
    $newformname = $_POST["formname"];
}

$filepath = $formFolderPath.$newformname.$filetype;
$modifyFilepath = $formModifyFolderPath.$newformname.$filetype;

//Create a Form to users
$f = fopen($filepath, 'wb');
if (!$f) {
    die('Error creating the file ' . $filepath);
}else{
    copy('../formpattern.html', $filepath);
}

//Create a Form to Admin
$f = fopen($modifyFilepath, 'wb');
if (!$f) {
    die('Error creating the file ' . $modifyFilepath);
}else{
    $js = "<script src='{$jsmodifyfilepath}'></script></body>";
    copy($filepath, $modifyFilepath);
    $mfile = file_get_contents($modifyFilepath);
    $replace = str_replace("</body>", $js, $mfile);
    file_put_contents($modifyFilepath, $replace);
}




header('Location: ../index.php');

?>