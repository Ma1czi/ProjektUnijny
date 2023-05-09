<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     require_once('cleanString.php');
//     require_once('connDB.php');
    // $tablename = $_POST['filename'];
    // $tablename = cleanString($tablename);

//     $result = $db->query("show tables like '{$tablename}'");
//     if ($result->num_rows != 0) {
//         $sql = "select * from {$tablename}";
//         $result = $db -> query($sql);
//         echo "<table>";
//         $t = 1;
//         foreach($result -> fetch_all() as $val){
//             echo "<tr><td>{$t}</td>";
//             for($i = 0; $i < sizeof($val); $i++){
//                 echo "<td>{$val[$i]}</td>";
//             }
//             echo "</tr>";
//             $t++;
//         }
//         echo "</table>";
//         $db -> close();
//         return 0;
//     }
//     echo "Pusta tabela";
//     return 0;
// }
// echo "CYCKI";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require_once('cleanString.php');
    $tablename = $_POST['filename'];
    $tablename = cleanString($tablename);
    $_SESSION["tablename"] = $tablename;
}