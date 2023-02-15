<?php
    function displayformslist(){
        echo "<ul>";
        $folderpath = "../Form/";
        foreach (new DirectoryIterator($folderpath) as $file) {
            if($file->isDot()) continue;
            $filepath = $folderpath.$file->getFilename();
            echo "<tr><td><li><a href='$filepath'>".preg_replace('/.html/i', '', $file->getFilename())."</a></li></td><td><table style=' width: 12%;'><tr><td><i class='gg-notes'></i></td><td><i class='gg-trash'></i></td></tr></table></td>";
        }
        echo "</ul>";
    }
?>