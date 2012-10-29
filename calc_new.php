<?php
$date = date("d.m.Y",time());
$hour = date("H:i",time());

session_start();
require("global.php");
include ('incl/sessionhelpers.php');
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
<h1 id="siteName">'.about('pagename').' - @ '.$date.' - '.$hour.'</h1>';
echo '</span></div></div><!-- end masthead -->';
echo '<div id="content">
<div id="breadCrumb"> <span class="style3"><a href="'.about('url').'">'.about('organisation').'</a> / <a href="./index.php">'.about('pagename').'</a> / YOP </span></div><br />
<h2 id="pageName">Admin - calculation</h2>';

if(logged_in())
{
if(is_admin())
{

$confirm = $_POST['confirm'];
$reset = $_POST['reset'];

if($confirm == '42')
{
   $subtotal = 0;
   echo '<br /><h1>items</h1><br />';
   echo '<table width="850" border="'.ooborder().'"><tr bgcolor="'.setcolor('tb_color1').'"><th>Item</th><th>sold pcs</th><th>sold</th></tr>';
   $itemsq = mysql_query("SELECT * FROM `items`");
   while( $itemsa = mysql_fetch_array($itemsq))
   {
      echo '<tr><td bgcolor="'.setcolor('tb_color2').'">'.$itemsa['display'].'</td>';
      $itmsum = 0;
      $itmprice = 0;

      $sumq = mysql_query("SELECT * FROM `sold` WHERE `item` = '".$itemsa['display']."'");
      while( $suma = mysql_fetch_array($sumq))
      {
         $tot_fei = $subtotal + ($suma['pcs'] * ($suma['price'] - getv0p($itemsa['display'])));
         $subtotal = $tot_fei;
         $temp = $itmsum + $suma['pcs'];
         $itmsum = $temp;
         $temp2 = $itmprice + ($suma['pcs'] * ($suma['price'] - getv0p($itemsa['display'])));
         $itmprice = $temp2;
      }
      echo '<td bgcolor="'.setcolor('tb_color3').'"><div align="center">'.round($itmsum, 2).'</div></td><td bgcolor="'.setcolor('tb_color3').'"><div align="right">'.round($itmprice, 2).'</div></td></tr>';
   }
   echo '<tr><th bgcolor="'.setcolor('tb_color2').'">subtotal</th><td bgcolor="'.setcolor('tb_color3').'"></td><th bgcolor="'.setcolor('tb_color1').'">'.round($subtotal, 2).'</th></tr></table>';
   
   echo '<br /><br /><h1>expenses</h1><br />';
      
   echo '<table width="850" border="'.ooborder().'">
         <tr bgcolor="'.setcolor('tb_color1').'">
         <th  scope="col">ID</th>
         <th  scope="col">name</th>
         <th  scope="col">expense</th>
         <th  scope="col">usage</th>
         <th  scope="col">note</th>
         </tr>';
         
   $query = mysql_query("SELECT * FROM `expn`");
   while( $money = mysql_fetch_array($query))
   {
      echo '<form method="post" action="admin.php?site=expn&action=do_kill_expn&id='.$money['id'].'">';
      echo '<tr>
            <td bgcolor="'.setcolor('tb_color2').'">'.$money['id'].'</td>
            <td bgcolor="'.setcolor('tb_color3').'">'.$money['name'].'</td>
            <td bgcolor="'.setcolor('tb_color3').'"><div align="right">'.$money['preis'].' Fr. </div></td>
            <td bgcolor="'.setcolor('tb_color3').'">'.$money['zweck'].'</td>
            <td bgcolor="'.setcolor('tb_color3').'">'.$money['note'].'</td>
            </tr>';
      echo '</form>';
   }

   echo '</form></table>';
   echo '<br /><br />';
   echo '<table width="300" border="'.ooborder().'"><tr bgcolor="'.setcolor('tb_color1').'"><td>name</td><td>total</tr>';

   $anameq = mysql_query("SELECT * FROM `empl`");
   while( $aname = mysql_fetch_array($anameq))
   {
      $ausgq = mysql_query("SELECT sum(`preis`) AS total FROM `expn` WHERE `name` = '".$aname['name']."'");
      $ausg = mysql_fetch_array($ausgq);
      echo '<tr><td bgcolor="'.setcolor('tb_color2').'">'.$aname['name'].'</td><td bgcolor="'.setcolor('tb_color3').'"><div align="right">'.$ausg['total'].' Fr. </div></td></tr>';
      $temp = $total_empl + $ausg['total'];
      $total_empl = $temp;
   }
   echo '<tr><th bgcolor="'.setcolor('tb_color2').'">subtotal</th><th bgcolor="'.setcolor('tb_color1').'">'.$total_empl.'</th></tr></table>';

   echo '<br /><br /><h1>stock</h1><br />';
   echo'<table width="600" border="'.ooborder().'">
        <tr bgcolor="'.setcolor('tb_color1').'" >
        <td>name</td>
        <td>bought</td>
        <td>remaining</td>
        </tr>';
   $result = mysql_query("SELECT * FROM `ingr`");
   while($row = mysql_fetch_array($result))
   {
      $res = mysql_query("SELECT sum(".$row['display'].") AS ".$row['display']." FROM `stk`");
      $arr = mysql_fetch_array($res);
      $res2 = mysql_query("SELECT sum(".$row['display'].") AS ".$row['display']." FROM `used`");
      $arr2 = mysql_fetch_array($res2);
      $result1 = mysql_query("SELECT sum(".$row['display'].") AS ".$row['display']." FROM `stk`");
      $arra = mysql_fetch_array($result1);
      $result2 = mysql_query("SELECT sum(".$row['display'].") AS ".$row['display']." FROM `used`");
      $arrb = mysql_fetch_array($result2);
      $result3 = $arra[$row['display']] - $arrb[$row['display']];
      echo '<tr>';
      echo '<td width="100" bgcolor="'.setcolor('tb_color2').'" >'.$row['display'].'</td><td width="100" bgcolor="'.setcolor('tb_color3').'" align="center">'.$arr[$row['display']].'</td><td width="100" bgcolor="'.setcolor('tb_color3').'" align="center">';
      if( $result3 < 70 ){echo '<h6 class="rot">'.$result3.'</h6>';} else {echo $result3;}
      echo '</tr>';
   }
   echo '</table>';
   
   echo '<br /><br /><h1>total</h1><br />';
   echo '<table width="400"><tr bgcolor="'.setcolor('tb_color2').'"><td>items</td><td>'.round($subtotal, 2).'</td></tr><tr bgcolor="'.setcolor('tb_color2').'"><td>expenses</td><td>-'.$total_empl.'</td></tr><tr bgcolor="'.setcolor('tb_color1').'"><th>total</th><th>'.(round($subtotal, 2) - $total_empl).'</th></tr></table>';





}
}
}
?>
