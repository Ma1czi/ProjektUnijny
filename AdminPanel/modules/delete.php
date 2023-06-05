<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filepath = "../../Form/";
    $adminfilepath = "../../FormModify/";
    $logspath = "../../ModifyLogs/";
    $adminfilepath .= $_POST['filepath'];
    $filepath .= $_POST['filepath'];
    $logspath = "../../ModifyLogs/logs.json";

    unlink($adminfilepath);
    unlink($filepath);
    $jsoncontent = file_get_contents($logspath);
    $jsoncontent = json_decode($jsoncontent, true);
    $formName = str_replace(".off", "", $_POST["filepath"]);
    $formName = str_replace(".html", "", $formName);
    unset($jsoncontent[$formName]);
    file_put_contents($logspath, json_encode($jsoncontent));

    include_once('../../ConnDB/connDB.php');
    include_once('../../ConnDB/cleanString.php');
    $formName = cleanString($formName);

    if($formName != "" && isset($formName)){
        $sql = "drop table {$formName}";
        $db -> query($sql);
        $db -> close();
    }
}


?>