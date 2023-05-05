<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST["formName"];
    $content = $_POST['content'];
    $formFolderPath = "../../FormModify/";
    $modifyLogs = "../../ModifyLogs/";
    $formPath = $formFolderPath.$formName;
    $logspath = $modifyLogs.$formName;
    $logspath = str_replace(".off", "", $logspath);
    $logspath = str_replace(".html", ".txt", $logspath);
    $alllogs = $_POST['logs'];

    if(file_exists($formPath)){
        $Formcontent = file_get_contents($formPath);
        $Formcontent = substr($Formcontent, 0, strpos($Formcontent, "<body>"));
        $Formcontent = $Formcontent."<body>".$content."</body></html>";
        file_put_contents($formPath, $Formcontent);
        
    }else{
        die("Error: File doesn't exist: $formPath");
        return($formPath);
    }
    //Create a Log txt
    $f = fopen($logspath, 'wb');
    if (!$f) {
        die('Error creating the file ' . $logspath);
    }else{
        file_put_contents($logspath, $alllogs);
}
}