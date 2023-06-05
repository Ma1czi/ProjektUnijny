<?php
function updateTable($logs, $tablename){
    require_once('connDB.php');
    $cleantablename = cleanString($tablename);
    print_r($logs);
    foreach($logs[$tablename] as $key=>$change){
        if($change == "changetitle"){
            $change = cleanString($change);
            $filenames = explode(";", $key);
            $filename = $filenames[1];
            $newtitle = $filenames[0].substr($filename, strpos($filename, "."));
            $userPath = "../../Form/";
            $adminPath = "../../FormModify/"; 
            
            rename($userPath.$filename, $userPath.$newtitle);
            rename($adminPath.$filename, $adminPath.$newtitle);
            $filename = str_replace('.off', '', $filename);
            $filename = str_replace('.html', '', $filename);
        }
    }
    
    $result = $db->query("show tables like '{$cleantablename}'");
    if ($result->num_rows != 0) {
        foreach($logs[$tablename] as $key=>$change){
            if($change == "delete"){
                $change = cleanString($change);
                $key = cleanString($key);
                $sql = "alter table {$cleantablename} drop column {$key};";
            }elseif($change == "add"){
                $key = cleanString($key);
                $sql = "alter table {$cleantablename} add column {$key} varchar(50);";
            }elseif($change == "changetitle"){
                $filenames = explode(";", $key);
                $filename = $filenames[1];
                $newtitle = $filenames[0].substr($filename, strpos($filename, "."));
                $newtitle = cleanString($filenames[0]);
                $sql = "RENAME TABLE {$cleantablename} TO {$newtitle}";
                $tablename = $newtitle;
            }else{
                $key = cleanString($key);
                $sql = "alter table {$cleantablename} change column {$key} {$change} varchar(50);";
            }
            $db -> query($sql);
        }
    }
    $db -> close();
}
