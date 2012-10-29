<?php

function debugmode($query)
{
	require_once("global.php");
	$dm = (mysql_fetch_array(mysql_query('SELECT `act` FROM `sets` WHERE `set` = CONVERT(_utf8 \'debugmode\' USING latin1) COLLATE latin1_general_ci')));

	if($dm['act'] == 1)
	{
		echo $query.'<br />';
	} else {
		mysql_query($query);
	}
}

function ooborder()
{
require_once("global.php");
	$sqlq = mysql_query('SELECT `act` FROM `sets` WHERE `set` = CONVERT(_utf8 \'border\' USING latin1) COLLATE latin1_general_ci');
	$sql = mysql_fetch_array($sqlq);
	
	if($sql['act'] == 1)
	{
		$border = 1;
	} else {
		$border = 0;
	}
	return $border;
}


function setcolor($color)
{
require_once("global.php");

$qc = 'SELECT `code` FROM `colors` WHERE `color` = CONVERT(_utf8 \''.$color.'\' USING latin1) COLLATE latin1_general_ci';
$mc = mysql_query($qc);
$c = mysql_fetch_array($mc);
return $c['code'];
}


function getv0p($name)
{
require_once("global.php");

$summe = 0;
$query = mysql_query("SELECT * FROM sortiment");
while( $result = mysql_fetch_array($query))
	{
		$aa = ("SELECT sum(`preis`) FROM `preise` WHERE `name` = '".$result['display']."'");
		$a = mysql_fetch_array(mysql_query($aa));
		$bb = ("SELECT sum(`menge`) FROM `preise` WHERE `name` = '".$result['display']."'");
		$b = mysql_fetch_array(mysql_query($bb));
		
		if( isset($b['sum(`menge`)']) == TRUE )
		{
		$result_c = $a['sum(`preis`)'] / $b['sum(`menge`)'];
		} else { $result_c = 0; }
		
		$c = mysql_fetch_array(mysql_query('SELECT * FROM `drinks` WHERE `display` = "'.$name.'"'));
		$tot_c = $c[$result['display']] * $result_c;
	
		$temp = $tot_c + $summe;
		$summe = $temp;
	
	}
		
return $summe;
}


function getactprice($name)
{
require_once("global.php");

$query = mysql_query("SELECT * FROM drk_preise WHERE name = '".$name."'");
$array = mysql_fetch_array($query);

$price = $array['vp'];

return $price;
}


function drinkcount($name)
{
$res = mysql_query("SELECT sum(`".$name."`) AS ".$name." FROM `drk_count`");
$arr = mysql_fetch_array($res);
$count = $arr[$name];

return $count;
}

function about($name)
{
$query = mysql_query(" SELECT * FROM about WHERE info = '".$name."'");
$array = mysql_fetch_array($query);
$about = $array['content'];

return $about;
}
?>