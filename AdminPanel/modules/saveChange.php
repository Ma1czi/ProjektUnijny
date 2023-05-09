<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST["formName"];
    $content = $_POST['content'];
    $adminFormFolderPath = "../../FormModify/";
    $userFormFolderPath = "../../Form/";
    $modifyLogs = "../../ModifyLogs/";
    $adminFormPath = $adminFormFolderPath.$formName;
    $userFormPath = $userFormFolderPath.$formName;
    $logspath = $modifyLogs.$formName;
    $logspath = str_replace(".off", "", $logspath);
    $logspath = str_replace(".html", ".txt", $logspath);

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
        $Formcontent = $Formcontent."<body>".substr($content, 0, strpos($content, "<script"))."</body></html>";
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
        $tname = cleanString($tname);
        echo $tname;
        updateTable(file_get_contents($logspath), $tname);
        file_put_contents($logspath, "");
    }
}