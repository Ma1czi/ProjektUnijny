<?php
function displayformslist(){
    echo "<ul>";
    $folderpath = "../Form/";
    foreach (new DirectoryIterator($folderpath) as $file) {
        if($file->isDot()) continue;
        $filepath = $folderpath.$file->getFilename();
        echo "<li><a href='$filepath'>".preg_replace('/.html/i', '', $file->getFilename())."</a></li>";
    }
    echo "</ul>";
}
require 'page.php';