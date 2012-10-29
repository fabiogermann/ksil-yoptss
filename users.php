<?php

session_start();
require("global.php");
include ('incl/sessionhelpers.php');
$action = $_GET['action'];
if(!isset( $_GET['action'])) {$action = 'none';}
$site = $_GET['site'];
if(!isset( $_GET['site'])) {$site = 'home';}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>- '.about('pagename').' - '.$site.'</title>';

require_once("incl/style.php");

echo '<style type="text/css">
<!--
.style2 {font-size: 24px}
.style3 {font-size: x-small}
-->
</style>
</head>
<body>
<div id="masthead">
  <h1 id="siteName">'.about('pagename').'</h1>
  <div id="globalNav"> <span class="style2">| <a href="users.php?site=home">HOME</a> |';
  
  if(logged_in())
  {
  	echo '<a href="touch.php?site=buttons">TOUCH-SYSTEM</a> | <a href="users.php?site=stats">STATISTICS</a> | <a href="about.php">ABOUT</a> | '; 
	if(is_admin()){ echo'<a href="admin.php">ADMIN</a> |';}
	echo '<a href="home.php?action=logout">LOGOUT</a> |';
  }
  echo '</span></div></div><!-- end masthead -->';

echo '<div id="content">
  <div id="breadCrumb"> <span class="style3"><a href="'.about('url').'">'.about('organisation').'</a> / <a href="./index.php">'.about('pagename').'</a> / YOP </span></div><br />
  <h2 id="pageName">Users - '.$site.'</h2>';

if(logged_in())
{


	if( $site == 'home' )
	{
			echo '<table border="0">
			<tr>
			<td><img src="thumbs/logo_page.jpg" width="400" height="315" alt="logo" /></td>
			<td width="20"></td><td>You are logged in as:<br /> '.active_user().'</td></tr></table>
            <br /><a href="touch.php?site=buttons"><img src="thumbs/touchsys.gif" width="300" height="60" alt="touchsys" /></a>';
	}

	if($site == 'stats')
	{
	         $solditema = mysql_fetch_array(mysql_query("SELECT sum(`pcs`) FROM `sold`"));
	         $solditems = floatval($solditema['sum(`pcs`)']);
	         $selltrans = floatval(mysql_num_rows(mysql_query("SELECT * FROM `sold` ")));
             echo '<table border="'.ooborder().'"><tr><td width="200" bgcolor="'.setcolor('tb_color1').'">total sold items</td><td width="100" bgcolor="'.setcolor('tb_color2').'"><div align="center">'.$solditems.'</div></td></tr>
                   <tr><td width="200" bgcolor="'.setcolor('tb_color1').'">total sell transactions</td><td width="100" bgcolor="'.setcolor('tb_color2').'"><div align="center">'.$selltrans.'</div></td></tr>
                   <tr><td width="200" bgcolor="'.setcolor('tb_color1').'">items per transaction</td><td width="100" bgcolor="'.setcolor('tb_color2').'"><div align="center">'.($solditems / $selltrans).'</div></td></tr></table>';
    }
	


}
echo '   <div class="story"></div>
     </div>
     <!--end content -->
     <div id="navBar">
       <div id="advert"></div>
         <div id="headlines"></div>
       </div>';
require_once("incl/botbar.php");
echo '</body>
</html>';
?>
