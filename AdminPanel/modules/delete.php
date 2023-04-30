<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filepath = "../../Form/";
    $adminfilepath = "../../FormModify/";
    $adminfilepath .= $_POST['filepath'];
    $filepath .= $_POST['filepath'];

    unlink($adminfilepath);
    unlink($filepath);
    unlink('../../FormModify/'.$_POST['filepath']);


    include_once('../../ConnDB/connDB.php');
    include_once('../../ConnDB/cleanString.php');
    $formName = str_replace('.html', '', $_POST['filepath']);
    $formName = cleanString($formName);
    if($formName != "" && isset($formName)){
        $sql = "drop table {$formName}";
        $db -> query($sql);
        $db -> close();
    }
}


?>