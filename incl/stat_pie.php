<?php
header ("Content-type: image/png");
$type = $_GET['type'];
$width = 200;
$hight = 150;
$stat = ImageCreate ($width, $hight) or die ("error");
$rgb[0] = sscanf('#0000CD', '#%2x%2x%2x');
$rgb[1] = sscanf('#008000', '#%2x%2x%2x');
$rgb[2] = sscanf('#DC143C', '#%2x%2x%2x');
$rgb[3] = sscanf('#FFD700', '#%2x%2x%2x');
$rgb[4] = sscanf('#C0C0C0', '#%2x%2x%2x');
$rgb[5] = sscanf('#9ACD32', '#%2x%2x%2x');
$rgb[6] = sscanf('#FF69B4', '#%2x%2x%2x');
$rgb[7] = sscanf('#00FFFF', '#%2x%2x%2x');
$rgb[8] = sscanf('#7FFFD4', '#%2x%2x%2x');
$rgb[9] = sscanf('#FF8C00', '#%2x%2x%2x');
$rgb[10] = sscanf('#0000CD', '#%2x%2x%2x');
$rgb[11] = sscanf('#008000', '#%2x%2x%2x');
$rgb[12] = sscanf('#DC143C', '#%2x%2x%2x');
$rgb[13] = sscanf('#FFD700', '#%2x%2x%2x');
$rgb[14] = sscanf('#C0C0C0', '#%2x%2x%2x');
$rgb[15] = sscanf('#9ACD32', '#%2x%2x%2x');
$rgb[16] = sscanf('#FF69B4', '#%2x%2x%2x');
$rgb[17] = sscanf('#00FFFF', '#%2x%2x%2x');
$rgb[18] = sscanf('#7FFFD4', '#%2x%2x%2x');
$rgb[19] = sscanf('#FF8C00', '#%2x%2x%2x');
$background_color = ImageColorAllocate ($stat, 0, 0, 0);

$i = 0;

$array = $_COOKIE['yop_stats_'.$type.''];
arsort($array);

foreach($array as $itm => $pcs)
{
$tmp = $pcs + $sum;
$sum = $tmp;
}

foreach($array as $itm => $pcs)
{
	$place[$i]['number'] = $pcs;
	$place[$i]['angle'] = round(360 / $sum * $place[$i]['number']);
	
	if($i == 0)
	{
		$place[0]['start'] = 0;
	}
	else
	{
		$place[$i]['start'] = round($place[($i - 1)]['start'] + $place[($i - 1)]['angle']);
	}
	
	$place[$i]['end'] = round($place[$i]['start'] + $place[$i]['angle']);
	if($place[$i]['end'] > 360)
	{
		$place[$i]['end'] = 360;
	}
		
	$color = ImageColorAllocate($stat, $rgb[$i][0], $rgb[$i][1], $rgb[$i][2]);

	for($z = 0; $z < ($width - 20);)
	{
		$xc = $z;
		$yc = ($z / 4 * 3);

		ImageArc( $stat , ($width / 2) , ($hight / 2) , $xc , $yc , $place[$i]['start'] , $place[$i]['end'] , "$color" );

		$temp = $z + 0.1;
		$z = $temp;
	}
	$i++;
}

ImagePNG( $stat , "stat_".$type.".png");
ImageDestroy($stat);

header( 'Location: ../admin.php?site=stats' ) ;
?>