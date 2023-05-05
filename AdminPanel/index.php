<?php
function displayforms() {
    echo "<ul>";
    $folderpath = "../Form/";
    $i =0;
    foreach (new DirectoryIterator($folderpath) as $file) {
        if($file->isDot()) continue;
        $filename = $file->getFilename();
        $filepath = $folderpath.$filename;
        $i += 1;
        $eyeid = "eye".$i;
        $namefile = preg_replace('/.html/i', '', $filename);
        if(strpos($filename, '.off') !== false){
            $eye = "<td><button onclick=\"changeEye('".$eyeid."','".$filename."')\"><div class='eye' id='{$eyeid}'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' id='eye-off'><g data-name='Layer 2'><g data-name='eye-off'><rect width='24' height='24' opacity='0'></rect><path d='M4.71 3.29a1 1 0 0 0-1.42 1.42l5.63 5.63a3.5 3.5 0 0 0 4.74 4.74l5.63 5.63a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM12 13.5a1.5 1.5 0 0 1-1.5-1.5v-.07l1.56 1.56z'></path><path d='M12.22 17c-4.3.1-7.12-3.59-8-5a13.7 13.7 0 0 1 2.24-2.72L5 7.87a15.89 15.89 0 0 0-2.87 3.63 1 1 0 0 0 0 1c.63 1.09 4 6.5 9.89 6.5h.25a9.48 9.48 0 0 0 3.23-.67l-1.58-1.58a7.74 7.74 0 0 1-1.7.25zM21.87 11.5c-.64-1.11-4.17-6.68-10.14-6.5a9.48 9.48 0 0 0-3.23.67l1.58 1.58a7.74 7.74 0 0 1 1.7-.25c4.29-.11 7.11 3.59 8 5a13.7 13.7 0 0 1-2.29 2.72L19 16.13a15.89 15.89 0 0 0 2.91-3.63 1 1 0 0 0-.04-1z'></path></g></g></svg></div></button></td>";
        }else{
            $eye = "<td><button onclick=\"changeEye('".$eyeid."','".$filename."')\"><div class='eye' id='{$eyeid}'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' id='eye'><g data-name='Layer 2'><g data-name='eye'><rect width='24' height='24' opacity='0'></rect><path d='M21.87 11.5c-.64-1.11-4.16-6.68-10.14-6.5-5.53.14-8.73 5-9.6 6.5a1 1 0 0 0 0 1c.63 1.09 4 6.5 9.89 6.5h.25c5.53-.14 8.74-5 9.6-6.5a1 1 0 0 0 0-1zM12.22 17c-4.31.1-7.12-3.59-8-5 1-1.61 3.61-4.9 7.61-5 4.29-.11 7.11 3.59 8 5-1.03 1.61-3.61 4.9-7.61 5z'></path><path d='M12 8.5a3.5 3.5 0 1 0 3.5 3.5A3.5 3.5 0 0 0 12 8.5zm0 5a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z'></path></g></g></svg></div></button></td>";
        }
        $namefile = preg_replace('/.off/i', '', $namefile);
        echo "<tr><td><li><a href='{$filepath}'>".$namefile."</a></li></td><td><table style=' width: 12%;'><tr><td><button onclick=\"modifefile('".$filename."')\"><div class='notes'><svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M6 6C6 5.44772 6.44772 5 7 5H17C17.5523 5 18 5.44772 18 6C18 6.55228 17.5523 7 17 7H7C6.44771 7 6 6.55228 6 6Z' fill='currentColor'/><path d='M6 10C6 9.44771 6.44772 9 7 9H17C17.5523 9 18 9.44771 18 10C18 10.5523 17.5523 11 17 11H7C6.44771 11 6 10.5523 6 10Z' fill='currentColor'/><path d='M7 13C6.44772 13 6 13.4477 6 14C6 14.5523 6.44771 15 7 15H17C17.5523 15 18 14.5523 18 14C18 13.4477 17.5523 13 17 13H7Z' fill='currentColor'/><path d='M6 18C6 17.4477 6.44772 17 7 17H11C11.5523 17 12 17.4477 12 18C12 18.5523 11.5523 19 11 19H7C6.44772 19 6 18.5523 6 18Z' fill='currentColor'/><path fill-rule='evenodd' clip-rule='evenodd' d='M2 4C2 2.34315 3.34315 1 5 1H19C20.6569 1 22 2.34315 22 4V20C22 21.6569 20.6569 23 19 23H5C3.34315 23 2 21.6569 2 20V4ZM5 3H19C19.5523 3 20 3.44771 20 4V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V4C4 3.44772 4.44771 3 5 3Z' fill='currentColor'/></svg></div></button></td><td><button onclick=\"deletefile('".$filename."')\"><div class='trash'><svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z' fill='currentColor'/><path d='M9 9H11V17H9V9Z' fill='currentColor' /><path d='M13 9H15V17H13V9Z' fill='currentColor' /></svg></div></button></td>".$eye."<td><button onclick='loop()'><div class='loop'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 50 50' id='search'><path d='M17 1C8.178 1 1 8.178 1 17s7.178 16 16 16c4.052 0 7.746-1.526 10.568-4.018l19.725 19.725 1.414-1.414-19.725-19.725C31.474 24.746 33 21.052 33 17c0-8.822-7.178-16-16-16zm0 30C9.28 31 3 24.72 3 17S9.28 3 17 3s14 6.28 14 14-6.28 14-14 14z'></path></svg></div></button></td></tr></table></td>";
    }
     echo "</ul>";
}

require 'page.php';
?>
