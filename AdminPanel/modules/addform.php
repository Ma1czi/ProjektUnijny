<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $newformname = "../../Form/";
    $newformname .= $_POST["formname"];
    $newformname .= ".html";
    $f = fopen($newformname, 'wb');
    if (!$f) {
        die('Error creating the file ' . $filename);
    }else{
        copy('../formpattern.html', $newformname);
    }

}


?>