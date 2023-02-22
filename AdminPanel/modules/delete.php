<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filepath = "../";
    $filepath .= $_POST['filepath'];

    unlink($filepath);

}


?>