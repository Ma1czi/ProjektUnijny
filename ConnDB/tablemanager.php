<?php
function updateTable($logs, $tablename){
    require_once('connDB.php');

    $result = $db->query("show tables like '{$tablename}'");
    if ($result->num_rows != 0) {
        $logs = explode(",", $logs);
        foreach($logs as $log){
            $change = explode("|", $log);
            $change[0] = cleanString($change[0]);
            $change[1] = cleanString($change[1]);
            if($change[1] == "delete"){
                $sql = "alter table {$tablename} drop column {$change[0]};";
            }elseif($change[1] == "add"){
                $sql = "alter table {$tablename} add column {$change[0]} varchar(50);";
            }else{
                $sql = "alter table {$tablename} change column {$change[0]} {$change[1]} varchar(50);";
            }
            $db -> query($sql);
        }
    }
    $db -> close();

}
