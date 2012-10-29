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
<div id="breadCrumb"> <span class="style3">/ Installation & Update / Step 5</span></div>
<br />
<h2 id="pageName">Installing Table Content</h2>
<?php
$status = $_GET['status'];
require("global.php");
if($status == '')
{
echo'
<form method="post" action="install_s5.php?status=saved">
<table width="400" border="0">
<tr><td>Name for this page:</td><td><input type="text" name="pagename" /></td></tr>
<tr><td>URL of your page:</td><td><input type="text" name="url" /></td></tr>
<tr><td>Name of your oganisation:</td><td><input type="text" name="org" /></td></tr>
<tr><td><input type="submit" value="save" /></td><td></td></tr>
</table></form>';
}
if($status == 'saved')
{
$page = $_POST['pagename'];
$url = $_POST['url'];
$org = $_POST['org'];

mysql_query("UPDATE `about` SET `content` = '$page' WHERE `info` = 'pagename'");
mysql_query("UPDATE `about` SET `content` = '$url' WHERE `info` = 'url'");
mysql_query("UPDATE `about` SET `content` = '$org' WHERE `info` = 'organisation'");

echo'
<form method="post" action="install_s5.php?status=saved">
<table width="400" border="0">
<tr><td>Name for this page:</td><td><input type="text" name="pagename" value="'.$page.'"/></td></tr>
<tr><td>URL of your page:</td><td><input type="text" name="url" value="'.$url.'"/></td></tr>
<tr><td>Name of your oganisation:</td><td><input type="text" name="org" value="'.$org.'"/></td></tr>
<tr><td><input type="submit" value="save" /></td><td></td></tr>
</table></form>';
}
?>

<div class="story">

</div>
</div>
<!--end content -->

<!--end navbar -->
<div id="siteInfo"><div align="right"><button  onclick="javascript:window.open('install_s6.php', '_self')" value="next" <?php if(!$_GET['status'] == 'saved') { echo 'disabled';} ?> ><h1>Next 6/8</h1></button></div></div>
<br />
<div id="b_left_bar"><img src="../incl/php.gif" width="70" alt="w3c-valid" /></div>
<div id="botbar"><img src="../incl/valid.png" width="70" alt="w3c-valid" /></div>
<div id="b_right_bar"><img src="../incl/mysql.gif" width="70" alt="w3c-valid" /></div>
</body>
</html>
