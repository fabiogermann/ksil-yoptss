<?php
session_start();

$action = $_GET['action'];
if( isset( $_GET['action']) == FALSE) {$action = 'none';}

require("global.php");

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';

if( $action == 'redirect' )
{
	include 'incl/sessionhelpers.php';

	if( logged_in() == true)
	{

		if( is_admin() == true )
		{
				echo '<meta http-equiv="refresh" content="0.2; url=admin.php" />';
		}
		else
		{
				echo '<meta http-equiv="refresh" content="0.2; url=users.php" />';
		}
	}
}

echo '<title>- '.about('pagename').' -</title>';

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
<div id="globalNav"> <span class="style2">| <a href="home.php">HOME</a> | ';

echo '<a href="about.php">ABOUT</a> |</span></div>
</div>
<!-- end masthead -->';

echo '<div id="content">
  <div id="breadCrumb"> <span class="style3"><a href="'.about('url').'">'.about('organisation').'</a> / <a href="./index.php">'.about('pagename').'</a> / YOP </span></div><br />
  <h2 id="pageName">- Home -</h2>';

if( $action == 'none' )
{
	echo '<div class="story">
		<h3>Welcome to the YOP - Utillity.</h3>
		<br />
		<table border="0">
		<tr>
		<td><img src="thumbs/logo_page.jpg" width="400" height="315" alt="logo" /></td>
		<td width="20"></td>
		<td>
		<form method="post" action="home.php?action=login">
		  <label>Username:</label><input name="username" type="text" />
		  <br />
		  <label>Password: </label><input name="userpass" type="password" id="userpass" />
		  <br />
		  <input name="login" type="submit" id="login" value="Login" />
		</form>
		</td>
		</tr>
		</table>
		</div>';
}

if( $action == 'login' )
{
	include 'incl/sessionhelpers.php';
	if (isset($_POST['login']))
	{
		$userid=check_user($_POST['username'], $_POST['userpass']);
		if ($userid!=false)
		{ login($userid); }
    	else
    	{echo 'Your login informations seem not to be correct!';}
	}
	
	if (!logged_in())
    { echo '<div class="story">
             <table border="0" width="300">
			 <tr>
                 <td bgcolor="#FF786D">
                     <form method="post" action="home.php?action=login">
			         <label>Benutzername:</label><input name="username" type="text" /><br />
                     <label>Passwort: </label><input name="userpass" type="password" id="userpass" /><br />
			         <input name="login" type="submit" id="login" value="Einloggen" />
			         </form>
                 </td>
             </tr>
             </table>
            </div>';
	}
	else
    { echo '<meta http-equiv="refresh" content="2; url=home.php?action=redirect" /><font class="sucess">Login successful<br >redirecting... <a href="home.php?action=logout">Abort</a></font>';
	}
}

if( $action == 'logout' )
{
	include 'incl/sessionhelpers.php';

	logout();
	if (!logged_in())
	{ echo '<meta http-equiv="refresh" content="2; url=home.php?action=none"/><font class="error">Logout successful<br />redirecting... </font>';
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
