<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("class_db.php");
require_once("_functions.php");

$db=new mysql();
$db->sqlserver   = "localhost";
$db->sqlusername = "root";
$db->sqlpassword = "VirusILY";
$db->sqldb       = "yop";
$db->connect();
?>