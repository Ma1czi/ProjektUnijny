<?php
include_once('cleanString.php');
include_once('connDB.php');
$tablename = explode('/', $_SERVER['HTTP_REFERER']);
$tablename = end($tablename);
$tablename = urldecode($tablename);
$tablename = str_replace('.html', '', $tablename);
$tablename = str_replace('.off', '', $tablename);
$tablename = cleanString($tablename);

//check if tablename exist in database
$result = $db->query("show tables like '{$tablename}'");
if ($result->num_rows == 0) {
    //table doesn't exist. Create new table
    $tablecolname = "";
    foreach($_POST as $key=>$value){
                $key = cleanString($key);
                $tablecolname .= $key." varchar(50) ,";
             }
            
    $tablecolname = substr($tablecolname, 0, -1);
    $tablecolname = "id int auto_increment primary key,".$tablecolname;
    $sql = "create table {$tablename}({$tablecolname});";
    $db -> query($sql);
}

$tablecolname = "";
    $tablecolvalue = "";
    foreach($_POST as $key=>$value){
        $key = cleanString($key);
        $value = cleanString($value);
        $tablecolname .= "".$key." ,";
        $tablecolvalue .= "'".$value."' ,";
    }
    $tablecolname = substr($tablecolname, 0, -1);
    $tablecolvalue = substr($tablecolvalue, 0, -1);
    
    $sql = "insert into {$tablename} ({$tablecolname}) values ({$tablecolvalue})";
    $db -> query($sql);
    $db -> close();

header("Location: ../UserPage/");

