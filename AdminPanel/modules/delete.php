<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filepath = "../../Form/";
    $adminfilepath = "../../FormModify/";
    $adminfilepath .= $_POST['filepath'];
    $filepath .= $_POST['filepath'];

    unlink($adminfilepath);
    unlink($filepath);
    unlink('../../FormModify/'.$_POST['filepath']);
}


?>