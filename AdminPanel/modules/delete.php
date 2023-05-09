<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filepath = "../../Form/";
    $adminfilepath = "../../FormModify/";
    $logspath = "../../ModifyLogs/";
    $adminfilepath .= $_POST['filepath'];
    $filepath .= $_POST['filepath'];
    $logspath .= $_POST['filepath'];
    $logspath = str_replace(".off", "", $logspath);
    $logspath = str_replace(".html", ".txt", $logspath);

    unlink($adminfilepath);
    unlink($filepath);
    unlink($logspath);


    include_once('../../ConnDB/connDB.php');
    include_once('../../ConnDB/cleanString.php');
    $formName = str_replace('.html', '', $_POST['filepath']);
    $formName = str_replace('.off', '', $formName);
    $formName = cleanString($formName);

    if($formName != "" && isset($formName)){
        $sql = "drop table {$formName}";
        $db -> query($sql);
        $db -> close();
    }
}


?>