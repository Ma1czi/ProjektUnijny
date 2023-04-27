<?php
include_once('connDB.php');
$tablename = explode('/', $_SERVER['HTTP_REFERER']);
$tablename = end($tablename);
$tablename = urldecode($tablename);
$tablename = str_replace('.html', '', $tablename);
$tablename = cleanString($tablename);

//check if tablename exist in database
$result = $db->query("show tables like '{$tablename}'");
if ($result->num_rows == 0) {
    //table doesn't exist. Create new table
    $tablecolname = "";
    foreach($_POST as $klucz=>$wart){
                $klucz = cleanString($klucz);
                $tablecolname .= $klucz." varchar(50) ,";
             }
            
    $tablecolname = substr($tablecolname, 0, -1);
    $tablecolname = "id int auto_increment primary key,".$tablecolname;
    $sql = "create table {$tablename}({$tablecolname});";
    $db -> query($sql);
}

$tablecolname = "";
    $tablecolvalue = "";
    foreach($_POST as $klucz=>$wart){
        $klucz = cleanString($klucz);
        $wart = cleanString($wart);
        $tablecolname .= "".$klucz." ,";
        $tablecolvalue .= "'".$wart."' ,";
    }
    $tablecolname = substr($tablecolname, 0, -1);
    $tablecolvalue = substr($tablecolvalue, 0, -1);
    
    $sql = "insert into {$tablename} ({$tablecolname}) values ({$tablecolvalue})";
    $db -> query($sql);
    $db -> close();

header("Location: ../UserPage/");


function cleanString($text) {
    $utf8 = array(
        '/[áàâãªäą]/u'   =>   'a',
        '/[ÁÀÂÃÄĄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[ł]/u'     =>   'l',
        '/[Ł]/u'     =>   'L',
        '/[éèêëę]/u'     =>   'e',
        '/[ÉÈÊËĘ]/u'     =>   'E',
        '/[óòôõºöó]/u'   =>   'o',
        '/[ÓÒÔÕÖÓ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/çć/'           =>   'c',
        '/ÇĆ/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/ś/'            =>   's',
        '/Ś/'            =>   'S',
        '/żź/u'           =>   'z',
        '/ŻŹ/u'           =>   'Z',
        '/[:-]/u'    =>   '',
        '/[\/]/'    =>   '',
        '/–/'           =>   '', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   '', // Literally a single quote
        '/[“”«»„]/u'    =>   '', // Double quote
        '/ /'           =>   '_', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}