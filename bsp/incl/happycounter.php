<?
$endtime = mktime(happyhour('hh_e_hour'), happyhour('hh_e_minute'), happyhour('hh_e_seconds'), happyhour('hh_e_month'), happyhour('hh_e_day'), happyhour('hh_e_year'), 1);

$starttime = mktime(happyhour('hh_s_hour'), happyhour('hh_s_minute'), happyhour('hh_s_seconds'), happyhour('hh_s_month'), happyhour('hh_s_day'), happyhour('hh_s_year'), 1);

$curtime = time();

if($curtime <= $starttime)
{
	echo 'HR NOT YET STARTED |';
}

if($curtime >= $starttime)
{
	$curtime = $curtime;
	$difference = ($endtime-$curtime);
	$hours = floor($difference / 60 / 60);
	$difference = ($difference - ($hours*60*60));
	$minutes = floor($difference/60);
	$difference = $difference - ($minutes*60);
	$seconds = floor($difference);
	
	echo "h:$hours - m:$minutes - s:$seconds remaining |";
}

?>
