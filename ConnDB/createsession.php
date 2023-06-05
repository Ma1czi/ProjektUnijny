<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $tablename = $_POST['filename'];
    $_SESSION["tablename"] = $tablename;
}