<?php 
$newformname = "Postaw na dobry zawód - elektronik to ty";
$formFolderPath = "../../Form/";
$filetype = ".html";


if(!empty($_POST["formname"])){
    $newformname = $_POST["formname"];
}

$filepath = $formFolderPath.$newformname.$filetype;

$f = fopen($filepath, 'wb');

if (!$f) {
    die('Error creating the file ' . $filepath);
}else{
    copy('../formpattern.html', $filepath);
}

header('Location: ../index.php');

?>