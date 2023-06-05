<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST['formName'];
    $formModifyFolderPath = "../../FormModify/";
    $formFolderPath = "../../Form/";
    $jsmodifyfilepath = "../AdminPanel/modules/modify.js";
    $logspath = "../../ModifyLogs/logs.json";
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

    $jsoncontent = file_get_contents($logspath);
    $jsoncontent = json_decode($jsoncontent, true);
    $formName = str_replace(".off", "", $_POST["formName"]);
    $formName = str_replace(".html", "", $formName);
    unset($jsoncontent[$formName]);
    file_put_contents($logspath, json_encode($jsoncontent));
}