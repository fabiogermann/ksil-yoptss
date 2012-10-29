<?php
  error_reporting(E_ALL ^ E_NOTICE);
  require_once("class_db.php");
  require_once("_functions.php");

  $db=new mysql();
  $db->sqlserver   = "localhost";
  $db->sqlusername = "root";
  $db->sqlpassword = "gnet08_yop";
  $db->sqldb       = "yop_bsp";
  $db->connect();
