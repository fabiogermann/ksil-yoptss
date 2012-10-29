<?php
if(!defined("CLASS_MYSQL")):
define("CLASS_MYSQL", 1);

class mysql {
  var $sqlserver="";
  var $sqlusername="";
  var $sqlpassword="";
  var $sqldb="";

  var $link_id=0;
  var $query_anzahl=0;
  var $last_error="";
  var $query_id=0;


  function connect()
  {
    $this->link_id=mysql_connect($this->sqlserver,$this->sqlusername,$this->sqlpassword) or DIE($this->error());
    mysql_select_db($this->sqldb,$this->link_id) or DIE($this->error());
  }

  function close()
  {
    if($this->link_id != 0)
    {
      mysql_close($this->link_id);
      $this->link_id = 0;
    }
  }

  function query($query)
  {
    $this->query_anzahl=$this->query_anzahl+1;
    $this->query_id=mysql_query($query,$this->link_id) or die($this->error("\nQuery: <font color=\"green\">".$query."</font><br /><br />"));
    return $this->query_id;
  }

  function fetch_array($result=-1)
  {
    if($result==-1) $result=$this->query_id;
    return mysql_fetch_array($result);
  }

  function num_rows($result=-1)
  {
    if($result==-1) $result=$this->query_id;
    return mysql_num_rows($result);
  }

  function insert_id()
  {
    return mysql_insert_id($this->link_id);
  }

  function free_result($query=-1)
  {
    if($query==-1) $query=$this->query_id;
    return mysql_free_result($query);
  }

  function error($zusatz)
  {
    $this->last_error=mysql_errno().":".mysql_error();
    ob_end_clean();

    echo("<html>

<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<title>Datenbankfehler</title>
</head>

<body>
<h1>Datenbankfehler</h1>
MySQL-Fehler: ".$this->last_error." <br/><br />".$zusatz."
Script: ".getenv("REQUEST_URI")." <br /><br />
Referer: ".getenv("HTTP_REFERER")." <br /><br />
Zeit: ".date("d.m.Y @ H:i")." <br /><br /><br />
Fehler bitte dem Administrator mitteilen, mit den Angaben Zeit, Script und MySQL-Fehler.
</body>
</html>");
    flush();
    exit;
  }

}
endif;
?>