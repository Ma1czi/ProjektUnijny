<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST["formName"];
    $content = $_POST['content'];
    $adminFormFolderPath = "../../FormModify/";
    $userFormFolderPath = "../../Form/";
    $logspath = "../../ModifyLogs/logs.json";
    $adminFormPath = $adminFormFolderPath.$formName;
    $userFormPath = $userFormFolderPath.$formName;
    

    //overwrite adminForm
    if(file_exists($adminFormPath)){
        $Formcontent = file_get_contents($adminFormPath);
        $Formcontent = substr($Formcontent, 0, strpos($Formcontent, "<body>"));
        $Formcontent = $Formcontent."<body>".$content."</body></html>";
        file_put_contents($adminFormPath, $Formcontent);
        
    }else{
        die("Error: File doesn't exist: $adminFormPath");
        return($adminFormPath);
    }
    //overwrite userForm
    if(file_exists($userFormPath)){
        $Formcontent = file_get_contents($userFormPath);
        $Formcontent = substr($Formcontent, 0, strpos($Formcontent, "<body>"));
        $Formcontent = $Formcontent."<body>".substr($content, 0, strpos($content, "<script src"))."</body></html>";
        file_put_contents($userFormPath, $Formcontent);
        
    }else{
        die("Error: File doesn't exist: $adminFormPath");
        return($userFormPath);
    }

    //update db table
    include_once('../../ConnDB/cleanString.php');
    include_once('../../ConnDB/tablemanager.php');
    if(file_exists($logspath)){
        $tname = str_replace(".html", "", $formName);
        $tname = str_replace(".off", "", $tname);
        $jsoncontent = file_get_contents($logspath);
        $jsoncontent = json_decode($jsoncontent, true);
        updateTable($jsoncontent, $tname);

        unset($jsoncontent[$tname]);
        file_put_contents($logspath, json_encode($jsoncontent));
    }
}