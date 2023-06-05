<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST["formName"];
    $content = $_POST['content'];
    $formFolderPath = "../../FormModify/";
    $logspath = "../../ModifyLogs/logs.json";
    $formPath = $formFolderPath.$formName;
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

//save logs in json file
$jsoncontent = file_get_contents($logspath);
$jsoncontent = json_decode($jsoncontent, true);
print_r($jsoncontent);

//create new content
$logs = explode(",", $alllogs);
$formName = str_replace(".off", "", $_POST["formName"]);
$formName = str_replace(".html", "", $formName);
foreach($logs as $log){
    $log = explode("|", $log);

    if(!empty($jsoncontent)){
        $jsoncontent[$formName][$log[0]] = $log[1];
    }else{
        $jsoncontent = array($formName => array($log[0] => $log[1]));
    }
}
file_put_contents($logspath, json_encode($jsoncontent));
}