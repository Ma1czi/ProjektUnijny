<?php
function gettable(){
    
    require_once('../../ConnDB/cleanString.php');
    require_once('../../ConnDB/connDB.php');

    session_start();
    $tablename = "";
    if(!empty($_SESSION['tablename'])){
        $tablename = $_SESSION['tablename'];
        $tablename = cleanString($tablename);
    }
    

    $result = $db->query("show tables like '{$tablename}'");
    if ($result->num_rows != 0) {
        $sql = "select * from {$tablename}";
        $result = $db -> query($sql);
        $vals = array();
        echo "<table><tr>";
        foreach($result -> fetch_assoc() as $key=>$val){
            echo "<th>{$key}</th>";
            array_push($vals,$val);
        }
        echo "</tr><tr>";
        foreach($vals as $val){
            echo "<td>{$val}</td>";
        }
        echo "</tr>";
        foreach($result -> fetch_all() as $val){
            echo "<tr>";
            for($i = 0; $i < sizeof($val); $i++){
                echo "<td>{$val[$i]}</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        $db -> close();
        return 0;
    }
    echo "Pusta tabela";
    return 0;
}

require '../showtable.php';