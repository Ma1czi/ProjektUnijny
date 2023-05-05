<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filepath = $_POST['filepath'];
    $userFolder = "../../Form/".$filepath;
    $adminFolder = "../../FormModify/".$filepath;
    echo $filepath;
    if(strpos($filepath, '.off') !== false){
        $newUserFolder = str_replace('.off', '', $userFolder);
        $newAdminFolder = str_replace('.off', '', $adminFolder);
        rename($userFolder, $newUserFolder);
        rename($adminFolder, $newAdminFolder);
    }else{
        $newUserFolder = str_replace('.html', '.off.html', $userFolder);
        $newAdminFolder = str_replace('.html', '.off.html', $adminFolder);
        rename($userFolder, $newUserFolder);
        rename($adminFolder, $newAdminFolder);
    }

}