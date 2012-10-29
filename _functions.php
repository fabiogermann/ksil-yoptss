<?php

function debugmode($query)
{
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
	$sql = mysql_fetch_array(mysql_query('SELECT `act` FROM `sets` WHERE `set` = CONVERT(_utf8 \'border\' USING latin1) COLLATE latin1_general_ci'));

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
	$c = mysql_fetch_array(mysql_query('SELECT `code` FROM `colors` WHERE `color` = CONVERT(_utf8 \''.$color.'\' USING latin1) COLLATE latin1_general_ci'));
	return $c['code'];
}


function getv0p($name)
{
	$summe = 0;
	$query = mysql_query("SELECT * FROM `ingr`");
	while( $result = mysql_fetch_array($query))
		{
			$a = mysql_fetch_array(mysql_query("SELECT sum(`preis`) FROM `bought` WHERE `name` = '".$result['display']."'"));
			$b = mysql_fetch_array(mysql_query("SELECT sum(`menge`) FROM `bought` WHERE `name` = '".$result['display']."'"));
			
			if( isset($b['sum(`menge`)']) == TRUE )
			{
			$result_c = $a['sum(`preis`)'] / $b['sum(`menge`)'];
			} else { $result_c = 0; }
			
			$c = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `display` = "'.$name.'"'));
			$tot_c = $c[$result['display']] * $result_c;
		
			$temp = $tot_c + $summe;
			$summe = $temp;
		
		}
			
	return $summe;
}


function getactprice($id)
{
	$query = mysql_query("SELECT * FROM `itm_vp` WHERE `id` = '".$id."'");
	$array = mysql_fetch_array($query);
	
	$price = $array['vp'];
	
	return $price;
}


function drinkcount($name)
{
	$res = mysql_query("SELECT sum(`".$name."`) AS ".$name." FROM `itm_count`");
	$arr = mysql_fetch_array($res);
	$count = $arr[$name];
	
	return $count;
}

function about($name)
{
	$array = mysql_fetch_array(mysql_query(" SELECT * FROM `about` WHERE `info` = '".$name."'"));
	$about = $array['content'];
	
	return $about;
}

function is_set_happyhour()
{
	$array = mysql_fetch_array(mysql_query("SELECT * FROM `happyhour` WHERE `name` = 'status'"));
	$hh = $array['value'];
	
	return $hh;
}

function is_now_happyhour()
{
	$endtime = mktime(happyhour('hh_e_hour'), happyhour('hh_e_minute'), happyhour('hh_e_seconds'), happyhour('hh_e_month'), happyhour('hh_e_day'), happyhour('hh_e_year'), 1);
	$starttime = mktime(happyhour('hh_s_hour'), happyhour('hh_s_minute'), happyhour('hh_s_seconds'), happyhour('hh_s_month'), happyhour('hh_s_day'), happyhour('hh_s_year'), 1);
	$curtime = time();
	if($starttime <= $curtime and $curtime <= $endtime)
	{
		$hh = 1;
	}
	
	return $hh;
}

function happyhour($name)
{
	$array = mysql_fetch_array(mysql_query("SELECT * FROM `happyhour` WHERE `name` = '".$name."'"));
	$hh = $array['value'];
	
	return $hh;
}

function has_hh($name)
{
    $array = mysql_fetch_array(mysql_query("SELECT * FROM `items` WHERE `display` = '".$name."'"));
    if($array['hh'] == 1) {$result = "on";} else {$result = "off";}
    
    return $result;
}

function price_per_one($name)
{
    $a = mysql_fetch_array(mysql_query("SELECT sum(`preis`) FROM `bought` WHERE `name` = '".$name."'"));
    $b = mysql_fetch_array(mysql_query("SELECT sum(`menge`) FROM `bought` WHERE `name` = '".$name."'"));

    if( isset($b['sum(`menge`)']) == TRUE )
    {
        $result = $a['sum(`preis`)'] / $b['sum(`menge`)'];
    } else { $result = 0; }
    
    return $result;
}

?>
