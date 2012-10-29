<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>- ABOUT -</title>
<link rel="stylesheet" type="text/css" href="install_style.css" />
<style type="text/css">
<!--
.style2 {font-size: 24px}
.style3 {font-size: x-small}
-->
</style>
</head>
<body>
<div id="masthead">
<h1 id="siteName">YOP - Installation / Update</h1>
<div id="globalNav"> <span class="style2">| <a href="javascript:window.open('index.php', '_self')">ABORT</a> |</span></div>
</div>
<!-- end masthead -->

<div id="content">
<div id="breadCrumb"> <span class="style3">/ Installation & Update / Step 1</span></div>
<br />
<h2 id="pageName">MySQL Database Information</h2>
<br />

<?php
$action = $_GET['action'];
$server = $_POST['server'];
$username = $_POST['username'];
$password = $_POST['passwd'];
$confirm = $_POST['passwd_confirm'];
$database = $_POST['database'];
$bad = 'bgcolor="#FAB2B1"';
$suc = '<div align="left"><img src="../thumbs/tick.png" width="30" /></div>';
$unsuc = '<div align="left"><img src="../thumbs/cross.png" width="30" /></div>';
if($action == 'save_settings')
{
if($password == $confirm)
 {
  $towrite = '<?php
  error_reporting(E_ALL ^ E_NOTICE);
  require_once("class_db.php");
  require_once("_functions.php");

  $db=new mysql();
  $db->sqlserver   = "'.$server.'";
  $db->sqlusername = "'.$username.'";
  $db->sqlpassword = "'.$password.'";
  $db->sqldb       = "'.$database.'";
  $db->connect();';

  if(fOpen('global.php' , 'r')){unlink("global.php");}

  $global = fOpen("global.php", "a+");
  fWrite($global , $towrite);
  fClose($global);
  $res = $suc;
  }
  else {$ic2 = $bad; $res = $unsuc;}
}







echo '<form method="post" action="install_s1.php?action=save_settings&amp;status=ok">
<table width="800" border="0">
<tr>
<th width="150">Server</th>
<td '.$ic.' width="150" ><input type="text" name="server" value="'.$server.'" /></td>
<td><button action="submit" > Save connection</button></td>
<td>'.$res.'</td>
</tr>
<tr>
<th>Username</th>
<td '.$ic.'><input type="text" name="username" value="'.$username.'"/></td>
</tr>
<tr>
<th>Password</th>
<td '.$ic.'><input type="password" name="passwd" value="'.$password.'" /></td>
</tr>
<tr>
<th>Confirm PW</th>
<td '.$ic2.'><input type="password" name="passwd_confirm" value="'.$confirm.'" /></td>
</tr>
<tr>
<th>Database</th>
<td '.$ic.'><input type="text" name="database" value="'.$database.'" /></td>
</tr>
</table>
</form>';

?>

<div class="story">

</div>
</div>
<!--end content -->

<!--end navbar -->
<div id="siteInfo"><div align="right"><button <?php if($_GET['status'] != 'ok'){echo 'disabled';} ?> onclick="javascript:window.open('install_s2.php', '_self')" value="next" ><h1>Next 2/8</h1></button></div></div>
<br />
<div id="b_left_bar"><img src="../incl/php.gif" width="70" alt="w3c-valid" /></div>
<div id="botbar"><img src="../incl/valid.png" width="70" alt="w3c-valid" /></div>
<div id="b_right_bar"><img src="../incl/mysql.gif" width="70" alt="w3c-valid" /></div>
</body>
</html>
