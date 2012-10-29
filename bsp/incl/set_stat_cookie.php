<?php
require_once("../global.php");
$type = $_GET['type'];

if($type == 'items')
{				
	$result = mysql_query("SELECT * FROM `items` ");
	while($row = mysql_fetch_array($result))
	{
		$res = mysql_query("SELECT sum(".$row['display'].") AS ".$row['display']." FROM `itm_count`");
		$arr = mysql_fetch_array($res);
		$name = $row['display'];
		$pcs = $arr[$row['display']];
		setcookie( "yop_stats_items[$name]" , "$pcs" , (time() + (60*60)) , "/");

	}
}

if($type == 'users')
{
	$userquery = mysql_query("SELECT * FROM `users`");
	while($userarr = mysql_fetch_array($userquery))
	{
		$user = $userarr['UserName'];
		$sumquery = mysql_query("SELECT sum(`pcs`) FROM `sold` WHERE `user` = '".$user."'");
		$sumarr = mysql_fetch_array($sumquery);
		$pcs = $sumarr['sum(`pcs`)'];
		setcookie( "yop_stats_users[$user]" , "$pcs" , (time()+60*60) , "/");
	}
}

require_once("style.php");
echo "<font class=\"sucess\">- Stat has been refreshed -</font>";
echo '<meta http-equiv="refresh" content="1.5; url=stat_pie.php?type='.$type.'" />';

?>