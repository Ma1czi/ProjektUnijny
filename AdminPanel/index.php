<?php
function displayforms() {
    echo "<ul>";
    $folderpath = "../Form/";
    foreach (new DirectoryIterator($folderpath) as $file) {
        if($file->isDot()) continue;
        $filepath = $folderpath.$file->getFilename();
        echo "<tr><td><li><a href='$filepath'>".preg_replace('/.html/i', '', $file->getFilename())."</a></li></td><td><table style=' width: 12%;'><tr><td><button onclick=\"modifefile('".$filepath."')\"><div class='notes'><svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M6 6C6 5.44772 6.44772 5 7 5H17C17.5523 5 18 5.44772 18 6C18 6.55228 17.5523 7 17 7H7C6.44771 7 6 6.55228 6 6Z' fill='currentColor'/><path d='M6 10C6 9.44771 6.44772 9 7 9H17C17.5523 9 18 9.44771 18 10C18 10.5523 17.5523 11 17 11H7C6.44771 11 6 10.5523 6 10Z' fill='currentColor'/><path d='M7 13C6.44772 13 6 13.4477 6 14C6 14.5523 6.44771 15 7 15H17C17.5523 15 18 14.5523 18 14C18 13.4477 17.5523 13 17 13H7Z' fill='currentColor'/><path d='M6 18C6 17.4477 6.44772 17 7 17H11C11.5523 17 12 17.4477 12 18C12 18.5523 11.5523 19 11 19H7C6.44772 19 6 18.5523 6 18Z' fill='currentColor'/><path fill-rule='evenodd' clip-rule='evenodd' d='M2 4C2 2.34315 3.34315 1 5 1H19C20.6569 1 22 2.34315 22 4V20C22 21.6569 20.6569 23 19 23H5C3.34315 23 2 21.6569 2 20V4ZM5 3H19C19.5523 3 20 3.44771 20 4V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V4C4 3.44772 4.44771 3 5 3Z' fill='currentColor'/></svg></div></button></td><td><button onclick=\"deletefile('".$filepath."')\"><div class='trash'><svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z' fill='currentColor'/><path d='M9 9H11V17H9V9Z' fill='currentColor' /><path d='M13 9H15V17H13V9Z' fill='currentColor' /></svg></div></button></td></tr></table></td>";
    }
     echo "</ul>";
}
function modifiedForm($csa){
    echo $csa;
}
function deleteForm(){
    echo "usuniety";
}
function addForm(){
    echo "nowy";
}

require 'page.php';
?>
