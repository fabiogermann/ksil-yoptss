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
<div id="breadCrumb"> <span class="style3">/ Installation & Update / Step 6</span></div>
<br />
<h2 id="pageName">Last steps</h2>
<?php
$status = $_GET['status'];
require("global.php");
if($status == '')
{
echo'
<form method="post" action="install_s6.php?status=saved">
<table width="400" border="0">
<tr><td>Please specify a password for<BR>the administrator account:</td><td><input type="password" name="adminpw" /></td></tr>
<tr><td>Do you want to<BR>install example data?</td><td>No:<input type="radio" name="exmpl" value="0" /> / Yes:<input type="radio" name="exmpl" value="1" /></td></tr>
<tr><td><input type="submit" value="save" /></td><td></td></tr>
</table></form>';
}
if($status == 'saved')
{
$adminpw = $_POST['adminpw'];
$pw = md5($adminpw);
mysql_query("UPDATE `users` SET `UserPass` = '$pw' WHERE `UserID` =1 LIMIT 1");

$exmpl = $_POST['exmpl'];

echo'
<form method="post" action="install_s6.php?status=saved">
<table width="400" border="0">
<tr><td>Please specify a password for the administrator account:</td><td><input type="text" name="adminpw" /><br /><img src="../thumbs/tick.png" width="30" />...saved</td></tr>
<tr><td>Do you want to install example data?</td><td>No:<input type="radio" name="exmpl" value="0" /> / Yes:<input type="radio" name="exmpl" value="1" /></td></tr>
<tr><td><input type="submit" value="save" /></td><td></td></tr>
</table></form>';
}
if($exmpl == '1')
{
echo '<br />Example data...<img src="../thumbs/tick.png" width="30" />...installed<br />';
require("install_sample.php");
}
if($exmpl == '0')
{
echo '<br />Example data...<img src="../thumbs/cross.png" width="30" />...not installed<br />';
}

?>

<div class="story">

</div>
</div>
<!--end content -->

<!--end navbar -->
<div id="siteInfo"><div align="right"><button  onclick="javascript:window.open('install_s7.php', '_self')" value="next" <?php if(!$_GET['status'] == 'saved') { echo 'disabled';} ?> ><h1>Next 7/8</h1></button></div></div>
<br />
<div id="b_left_bar"><img src="../incl/php.gif" width="70" alt="w3c-valid" /></div>
<div id="botbar"><img src="../incl/valid.png" width="70" alt="w3c-valid" /></div>
<div id="b_right_bar"><img src="../incl/mysql.gif" width="70" alt="w3c-valid" /></div>
</body>
</html>
