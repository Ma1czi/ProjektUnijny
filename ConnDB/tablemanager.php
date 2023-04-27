<?php
require_once('connDB.php');

$sidename = explode('/', $_SERVER['HTTP_REFERER']);
$sidename = end($sidename);
$sidename = urldecode($sidename);
$sidename = str_replace('.html', '', $sidename);