<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST["formName"];
    $content = $_POST['content'];
    $formFolderPath = "../../FormModify/";
    $formPath = $formFolderPath.$formName;

    
    if(file_exists($formPath)){
        $Formcontent = file_get_contents($formPath);
        $Formcontent = substr($Formcontent, 0, strpos($Formcontent, "<body>"));
        $Formcontent = $Formcontent."<body>".$content."</body></html>";
        file_put_contents($formPath, $Formcontent);
        
    }else{
        die("Error: File doesn't exist: $formPath");
        return($formPath);
    }
}