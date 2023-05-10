<?php
function updateTable($logs, $tablename){
    require_once('connDB.php');
    echo $logs.$tablename;
    $logspath = "../ModifyLogs/".$tablename.".txt";
    $logs = explode(",", $logs);
    foreach($logs as $log){
        $change = explode("|", $log);
        $change[1] = cleanString($change[1]);
        if($change[1] == "changetitle"){
            $filenames = explode(";", $change[0]);
            $filename = $filenames[1];
            $newtitle = $filenames[0].substr($filename, strpos($filename, "."));
            $userPath = "../../Form/";
            $adminPath = "../../FormModify/"; 
            $logPath = "../../ModifyLogs/";
            
            rename($userPath.$filename, $userPath.$newtitle);
            rename($adminPath.$filename, $adminPath.$newtitle);
            $filename = str_replace('.off', '', $filename);
            $filename = str_replace('.html', '.txt', $filename);
            if(file_exists($logPath.$filename)){
                rename($logPath.$filename, $logPath.$filenames[0].'.txt');
                $logspath = $logPath.$filenames[0].'.txt';
            }
        }
    }
    
    $result = $db->query("show tables like '{$tablename}'");
    if ($result->num_rows != 0) {
        foreach($logs as $log){
            $change = explode("|", $log);
            $change[1] = cleanString($change[1]);
            if($change[1] == "delete"){
                $change[0] = cleanString($change[0]);
                $sql = "alter table {$tablename} drop column {$change[0]};";
            }elseif($change[1] == "add"){
                $change[0] = cleanString($change[0]);
                $sql = "alter table {$tablename} add column {$change[0]} varchar(50);";
            }elseif($change[1] == "changetitle"){
                $filenames = explode(";", $change[0]);
                $filename = $filenames[1];
                $newtitle = $filenames[0].substr($filename, strpos($filename, "."));
                $newtitle = cleanString($filenames[0]);
                $sql = "RENAME TABLE {$tablename} TO {$newtitle}";
                $tablename = $newtitle;
            }else{
                $change[0] = cleanString($change[0]);
                $sql = "alter table {$tablename} change column {$change[0]} {$change[1]} varchar(50);";
            }
            $db -> query($sql);
        }
    }
    file_put_contents($logspath, "");
    $db -> close();

}
