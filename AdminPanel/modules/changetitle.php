<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filename = $_POST['formname'];
    $newtitle = $_POST['title'].substr($filename, strpos($filename, "."));
    $userPath = "../../Form/";
    $adminPath = "../../FormModify/";
    $logPath = "../../ModifyLogs/";
    rename($userPath.$filename, $userPath.$newtitle);
    rename($adminPath.$filename, $adminPath.$newtitle);
    if(file_exists($logPath.str_replace(".off", "", $filename))){
        rename($logPath.str_replace(".off", "", $filename), $logPath.str_replace(".off", "", $newtitle));
    }
}
