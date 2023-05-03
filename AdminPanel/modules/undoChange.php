<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST['formName'];
    $formModifyFolderPath = "../../FormModify/";
    $formFolderPath = "../../Form/";
    $jsmodifyfilepath = "../AdminPanel/modules/modify.js";
    $modifyLogs = "../../ModifyLogs/";

    $logspath = $modifyLogs.$formName;
    $logspath = str_replace(".html", ".txt", $logspath);
    $formModifyPath = $formModifyFolderPath.$formName;
    $formPath = $formFolderPath.$formName;

    
    if(file_exists($formPath) && file_exists($formModifyPath)){
        $Formcontent = file_get_contents($formPath);
        $js = "<script src='{$jsmodifyfilepath}'></script></body>";
        $replace = str_replace("</body>", $js, $Formcontent);
        file_put_contents($formModifyPath, $replace);
    }else{
        die("Error: File doesn't exist: $formPath or $formModifyPath");
    }
    if(file_exists($logspath)){
        file_put_contents($logspath, "");
    }
}