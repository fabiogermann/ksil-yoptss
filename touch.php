<?php

session_start();
require("global.php");
include ('incl/sessionhelpers.php');
$action = $_GET['action'];
if(!isset( $_GET['action'])) {$action = 'none';}
$site = $_GET['site'];
if(!isset( $_GET['site'])) {$site = 'home';}
$mode = $_GET['mode'];
if(!isset( $_GET['mode'])) {$mode = 'normal';}
$pcs_item = $_GET['num'];
if(!isset( $_GET['num'])) {$pcs_item = 1;}


if(logged_in())
{
	if($action == 'clear')
	{
		$itmname = $_GET['lstitm'];
		$time = $_GET['time'];
		$query = mysql_query("SELECT * FROM `items`");
		while($array = mysql_fetch_array($query))
		{
			$name = $array['display'];
			setcookie("yop_buttons[$name]", "0", time() - 240, "/");
		}
		if($_GET['lstitm']) {echo '<font class="error">...cleared...</font><meta http-equiv="refresh" content="1; url=touch.php?site=buttons&amp;lstitm='.$itmname.'&amp;time='.$time.'&amp;mode='.$mode.'" />';}
		else {echo '<font class="error">...cleared...</font><meta http-equiv="refresh" content="0.1; url=touch.php?site=buttons" />';}
	}

    if($action == 'clear_cust')
	{
		$itmname = $_GET['lstitm'];
		$time = $_GET['time'];
		$query = mysql_query("SELECT * FROM `itm_strc` WHERE `id` > 5 ");
		while($array = mysql_fetch_array($query))
		{
			$name = $array['display'];
			setcookie("yop_custom[$name]", "0", time() - 240, "/");
		}
		if($_GET['lstitm']) {echo '<font class="error">...cleared...</font><meta http-equiv="refresh" content="1; url=touch.php?site=buttons&amp;lstitm='.$itmname.'&amp;time='.$time.'&amp;mode='.$mode.'" />';}
		else {echo '<font class="error">...cleared...</font><meta http-equiv="refresh" content="0.1; url=touch.php?site=buttons" />';}
	}
	
	if($action == 'cookie_button')
	{
	
		$name = $_GET['name'];
		$pcs = $_GET['pcs'];
		
		setcookie("yop_buttons[$name]", "$pcs", time() + 120, "/");
		
		echo '<font class="sucess">...just a moment...</font><meta http-equiv="refresh" content="0.1; url=touch.php?site=buttons&amp;mode='.$mode.'" />';
	
	}
	
	if($action == 'custom_itm_cookie')
	{
	    $amount = $_GET['amount'];
	    $ing = $_GET['ingr'];
	    
	    setcookie("yop_custom[$ing]", "$amount", time() + 120, "/");
	    
	    echo '<font class="sucess">...just a moment...</font><meta http-equiv="refresh" content="0.1; url=touch.php?site=custom_itm&amp;mode='.$mode.'" />';
    }
    
	if($action == 'do_button')
	{
		if(isset($_COOKIE['yop_buttons']))
			{
				foreach($_COOKIE['yop_buttons'] as $name => $pcs)
				{
					$time = time();	
					$itemquery = mysql_query("SELECT * FROM `items` WHERE `display` = '".$name."'");
					$itemarray = mysql_fetch_array($itemquery);
					$ingrq = mysql_query("SELECT * FROM `ingr`");
					while( $ingra = mysql_fetch_array($ingrq))
					{
						$total = $itemarray[$ingra['display']] * $pcs;
						$query = "INSERT INTO `used` ( `timestamp` , `user` , `".$ingra['display']."` ) VALUES ( '".$time."' , '".active_user()."' , '".$total."' )";
		
						if($itemarray[$ingra['display']] != '')
						{
							mysql_query($query);
						} 
		
					}
					$itemcount = "INSERT INTO `itm_count` ( `timestamp` , `user` , `".$name."` ) VALUES ( '".$time."' , '".active_user()."', '".$pcs."' )";
					mysql_query($itemcount);
					
					if($mode == 'free')
					{
						$soldquery = "INSERT INTO `sold` ( `user` , `timestamp` , `item` , `pcs` , `price` ) VALUES ( '".active_user()."' , '".$time."' , '".$name."' , '".$pcs."' , '0' )";
					} elseif(is_now_happyhour())
					{
						$price = getactprice($itemarray['id']) / 2;
						$soldquery = "INSERT INTO `sold` ( `user` , `timestamp` , `item` , `pcs` , `price` ) VALUES ( '".active_user()."' , '".$time."' , '".$name."' , '".$pcs."' , '".$price."' )";
					} else {
						$soldquery = "INSERT INTO `sold` ( `user` , `timestamp` , `item` , `pcs` , `price` ) VALUES ( '".active_user()."' , '".$time."' , '".$name."' , '".$pcs."' , '".getactprice($itemarray['id'])."' )";
					}

					
					mysql_query($soldquery);
				}
			}
		
	
		echo '<font class="sucess">...buy listed...</font>
		<meta http-equiv="refresh" content="0.1; url=touch.php?site=buttons&amp;action=clear&amp;lstitm='.$name.'&amp;time='.$time.'&amp;mode='.$mode.'" />';
	
	}
	
	if($action == 'do_button_cust')
	{
		if(isset($_COOKIE['yop_custom']))
			{
				foreach($_COOKIE['yop_custom'] as $name => $pcs)
				{
					$time = time();
                    mysql_query("INSERT INTO `used` ( `timestamp` , `user` , `".$name."` ) VALUES ( '".$time."' , '".active_user()."' , '".$pcs."' )");
                $price = $pcs * price_per_one($name);
                $temp = $cust_sum;
                $cust_sum = $temp + $price;
                }
                mysql_query("INSERT INTO `itm_count` ( `timestamp` , `user` , `custom_itm` ) VALUES ( '".$time."' , '".active_user()."', '1' )");
                if($mode == 'free')
                {
					$soldquery = "INSERT INTO `sold` ( `user` , `timestamp` , `item` , `pcs` , `price` ) VALUES ( '".active_user()."' , '".$time."' , 'custom_itm' , '1' , '0' )";
                } else {
					$soldquery = "INSERT INTO `sold` ( `user` , `timestamp` , `item` , `pcs` , `price` ) VALUES ( '".active_user()."' , '".$time."' , 'custom_itm' , '1' , '".$cust_sum."' )";
                }
                mysql_query($soldquery);

			}


		echo '<font class="sucess">...buy listed...</font>
		<meta http-equiv="refresh" content="0.1; url=touch.php?site=custom_itm&amp;action=clear_cust&amp;lstitm='.$name.'&amp;time='.$time.'&amp;mode='.$mode.'" />';

	}
}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
        <head>
        <meta http-equiv="Content-Type" content="text/html" />
        <link rel="stylesheet" type="text/css" href="incl/touch_fix_style.css" />
        <title>- '.about('pagename').' - '.$site.'</title>';

//require_once("incl/style.php");

echo '<style type="text/css">
<!--
.style2 {font-size: 24px}
.style3 {font-size: x-small}

body
{
	background-image: "thumbs/logo_touch.gif";
	background-repeat: no-repeat;
}

-->
</style>
</head>
<body>
<div id="masthead"><br />
<div class="headline" align="left"><a href="users.php?site=home"><img src="thumbs/exit.gif" width="60" alt="exit" /></a></div>
<div id="globalNav"><span class="style2">| <a href="touch.php?site=buttons&amp;mode=normal">BUTTONS</a> | <a href="touch.php?site=custom_itm">CUSTOM</a> | <a href="touch.php?site='.$site.'&amp;mode=free">FREE</a> | ';
if(!is_set_happyhour()){$hh = "NO HAPPYHR SET |"; echo $hh;} else { require_once("incl/happycounter.php");}
echo '</span></div></div>
      <!-- end head -->
      <div id="content">
      <br />
      ';

if(logged_in())
{

	if($mode == 'normal')
	{
		echo '<div align="center"><span class="style2"><img src="thumbs/normalmode.gif" width="400" alt="normalmode"/></span></div><br />
        ';
	}
	
	if($mode == 'free')
	{
		echo '<div align="center"><span class="style2"><img src="thumbs/freemode.gif" width="400" alt="freemode"/></span></div><br />
        ';
	}
	
	if($site == 'custom_itm')
	{
        echo '
               <table border="'.ooborder().'" width="1100">
			   <tr>
			   <td>';
			
        if($action == 'none')
        {
		echo '<table border="'.ooborder().'" width="800"><tr>';
		$z = 3;
		$qingr = mysql_query("SELECT * FROM `itm_strc` WHERE `id` > 5 ");
		while($ingr = mysql_fetch_array($qingr))
		{
			echo '<form method="post" action="touch.php?site=custom_itm&amp;action=next_custom_ing&itm='.$ingr['display'].'">';
			echo '<td width="200"><button name="'.$ingr['display'].'" type="submit"><img src="thumbs/custom.jpg" width="40" />'.$ingr['display'].'</button></td>';
			echo '</form>';
			if($z % 3 == 2)
			{
				echo '</tr><tr>';
			}
			$z++;
		}
		echo '</tr></table>';
		}
		echo '<table border="'.ooborder().'" width="800">';
		
		if($action == 'next_custom_ing')
		{
            $ingr = $_GET['itm'];
            $a1 = $_GET['a1'];

            $a10 = $_GET['a10'];

            $a100 = $_GET['a100'];

            
            echo '<tr><td><div align="center"><h1>'.$ingr.'</h1></div><br /></td></tr>
                 <tr><td>';
            for($n = 0; $n < 10; $n++)
            {
                if($a1 == $n)
                {$path[1][$n] = 'thumbs/num/num_act_'.$n.'.gif';} else {$path[1][$n] = 'thumbs/num/num_'.$n.'.gif';}
                if($a10 == $n)
                {$path[10][$n] = 'thumbs/num/num_act_'.$n.'.gif';} else {$path[10][$n] = 'thumbs/num/num_'.$n.'.gif';}
                if($a100 == $n)
                {$path[100][$n] = 'thumbs/num/num_act_'.$n.'.gif';} else {$path[100][$n] = 'thumbs/num/num_'.$n.'.gif';}
            }
            
            for($m = 1; $m <= 100;)
            {
                for($o = 0; $o < 10; $o++)
                {
                    if($m == 1) {echo '<a href="touch.php?site=custom_itm&amp;action=next_custom_ing&amp;itm='.$ingr.'&a1='.$o.'&a10='.$a10.'&a100='.$a100.'"><img src="'.$path[$m][$o].'" width="50" /></a>&nbsp;&nbsp;&nbsp;';}
                    if($m == 10) {echo '<a href="touch.php?site=custom_itm&amp;action=next_custom_ing&amp;itm='.$ingr.'&a1='.$a1.'&a10='.$o.'&a100='.$a100.'"><img src="'.$path[$m][$o].'" width="50" /></a>&nbsp;&nbsp;&nbsp;';}
                    if($m == 100) {echo '<a href="touch.php?site=custom_itm&amp;action=next_custom_ing&amp;itm='.$ingr.'&a1='.$a1.'&a10='.$a10.'&a100='.$o.'"><img src="'.$path[$m][$o].'" width="50" /></a>&nbsp;&nbsp;&nbsp;';}
                }
                echo '&nbsp;&nbsp;&nbsp;<h1> x'.$m.'</h1><br /><br />';
                $temp = $m * 10;
                $m = $temp;
            }
            $sum_ingr = $a1 + ($a10 * 10) + ($a100 * 100);
            echo '</td></tr><tr><td><h2>total amount of ingredient: </h2><div align="center"><h1>'.$sum_ingr.'</h1></div></td>';
            echo '<td><form method="post" action="touch.php?site=custom_itm&amp;action=custom_itm_cookie&amp;ingr='.$ingr.'&amount='.$sum_ingr.'"><button name="add_cust_ingr" action="submit"><img src="thumbs/plus.gif" width="40" height="40" /></button></form></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</td><td height="600"><table border="'.ooborder().'" width="320" height="400">';
        echo '<tr height="20" bgcolor="'.setcolor('tb_color1').'"><td>ingredient</td><td>amount</td><td>price</td></tr>';
        
        if(!isset($_COOKIE['yop_custom']))
		{
			echo '<tr height="20" bgcolor="'.setcolor('tb_color2').'"><td>no item selected</td><td>0</td><td>0.00 FR.</td></tr>';
		}

		if(isset($_COOKIE['yop_custom']))
		{
			foreach($_COOKIE['yop_custom'] as $ingr => $amount)
			{   $price = $amount * price_per_one($ingr);
                $temp = $cust_sum;
                $cust_sum = $temp + $price;
				echo '<tr height="20" bgcolor="'.setcolor('tb_color2').'"><td>'.$ingr.'</td><td>'.$amount.'</td><td>'.$price.' Fr.</td></tr>';
			}
		}
		echo '<tr bgcolor="'.setcolor('tb_color2').'"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
        echo '</table><form method="post" action="touch.php?action=clear_cust" ><table><tr><td><button name="clear_button" action="submit"><img src="thumbs/cancel_button.gif" width="160" /></button></td><td><h1>&nbsp; '.$cust_sum.' Fr. </h1></td></tr></table></form><form method="post" action="touch.php?action=do_button_cust&amp;mode='.$mode.'" ><button name="do_button" action="submit"><img src="thumbs/go_button.gif" width="300" /></button></form></tr></table>';
		echo '</td></tr></table>';
	}

	if($site == 'buttons')
	{
		$last_item_time = $_GET['time'];
			
		if($pcs_item == 1)
		{ $path1 = "thumbs/num/num_act_1.gif"; } else { $path1 = "thumbs/num/num_1.gif"; }
		if($pcs_item == 2)
		{ $path2 = "thumbs/num/num_act_2.gif"; } else { $path2 = "thumbs/num/num_2.gif"; }
		if($pcs_item == 3)
		{ $path3 = "thumbs/num/num_act_3.gif"; } else { $path3 = "thumbs/num/num_3.gif"; }
		if($pcs_item == 4)
		{ $path4 = "thumbs/num/num_act_4.gif"; } else { $path4 = "thumbs/num/num_4.gif"; }
		if($pcs_item == 5)
		{ $path5 = "thumbs/num/num_act_5.gif"; } else { $path5 = "thumbs/num/num_5.gif"; }
		if($pcs_item == 6)
		{ $path6 = "thumbs/num/num_act_6.gif"; } else { $path6 = "thumbs/num/num_6.gif"; }
		if($pcs_item == 7)
		{ $path7 = "thumbs/num/num_act_7.gif"; } else { $path7 = "thumbs/num/num_7.gif"; }
		if($pcs_item == 8)
		{ $path8 = "thumbs/num/num_act_8.gif"; } else { $path8 = "thumbs/num/num_8.gif"; }
		if($pcs_item == 9)
		{ $path9 = "thumbs/num/num_act_9.gif"; } else { $path9 = "thumbs/num/num_9.gif"; }
		
		echo '<table  border="'.ooborder().'" width="1100">
         <tr>
             <td>
                 <a href="touch.php?site=buttons&amp;num=1&amp;mode='.$mode.'"><img src="'.$path1.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
                 <a href="touch.php?site=buttons&amp;num=2&amp;mode='.$mode.'"><img src="'.$path2.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
                 <a href="touch.php?site=buttons&amp;num=3&amp;mode='.$mode.'"><img src="'.$path3.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
                 <a href="touch.php?site=buttons&amp;num=4&amp;mode='.$mode.'"><img src="'.$path4.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
                 <a href="touch.php?site=buttons&amp;num=5&amp;mode='.$mode.'"><img src="'.$path5.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
                 <a href="touch.php?site=buttons&amp;num=6&amp;mode='.$mode.'"><img src="'.$path6.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
                 <a href="touch.php?site=buttons&amp;num=7&amp;mode='.$mode.'"><img src="'.$path7.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
                 <a href="touch.php?site=buttons&amp;num=8&amp;mode='.$mode.'"><img src="'.$path8.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
                 <a href="touch.php?site=buttons&amp;num=9&amp;mode='.$mode.'"><img src="'.$path9.'" width="50" alt="num"/></a>&nbsp;&nbsp;&nbsp;
             </td>
             <td width="300">
             ';
		 
		if(isset($last_item_time))
		{
			echo '<div class="story"><form method="post" action="touch.php?site=undo_but&amp;time='.$last_item_time.'"><button type="submit" ><img src="thumbs/undo.gif" width="60" alt="undo" />Undo last buy...</button></form></div>';
		}
		echo '</td>
         </tr>
         <tr>
             <td>
             ';

		
		$subcq = mysql_query("SELECT * FROM `subcat`");
		while( $subc = mysql_fetch_array($subcq))
		{
			if($subc['nr'] % 2 == 0)
			{
				$color_tb = setcolor('tb_color2');
			} else {
				$color_tb = setcolor('tb_color3');
			}
			$z = 0;
			echo ' <h2>->:</h2>';
			echo '
              <table width="100" border="'.ooborder().'">
              <tr>';
			$scatq = mysql_query("SELECT * FROM `items` WHERE `subcat` = '".$subc['nr']."'");
			while( $item = mysql_fetch_array($scatq))
			{
				echo '
                <td bgcolor="'.$color_tb.'">
                          <form method="post" action="touch.php?site=buttons&amp;action=cookie_button&amp;name='.$item['display'].'&amp;pcs='.$pcs_item.'&amp;mode='.$mode.'">
                                <button name="'.$item['display'].'" type="submit"><img src="'.$item['thumb'].'" width="57" alt="item"/>'.$item['display'].'
                                </button>
                          </form>
                </td>';
		
				if($z % 5 == 4){ echo '</tr><tr>'; }
				
				$z++;
			}
			echo '
              </tr>
              </table>
             ';
		}
		echo '</td>
             ';

		echo '<td>
             <table width="320" id="tableHEbig" border="'.ooborder().'">
              <tr class="rowHEsmall" bgcolor="'.setcolor('tb_color1').'">
               <td>pieces</td>
               <td>item</td>
               <td>price</td>
              </tr>';
		
		$tot = 0;
		
		if(!isset($_COOKIE['yop_buttons']))
		{
			echo '
              <tr class="rowHEsmall" bgcolor="'.setcolor('tb_color2').'">
               <td>0</td>
               <td>no item selected</td>
               <td>0.00 FR.</td>
              </tr>';
		}

		if(isset($_COOKIE['yop_buttons']))
		{
			foreach($_COOKIE['yop_buttons'] as $name => $pieces)
			{	
				$array = mysql_fetch_array(mysql_query("SELECT * FROM `items` WHERE `display` = '$name'"));
				if(has_hh($name) == "on" && is_now_happyhour() && is_set_happyhour()) {$price = 0.5 * getactprice($array['id']);} else {$price = getactprice($array['id']);}
				$minitot = $price * $pieces;

                if(has_hh($name) == "on" && is_now_happyhour() && is_set_happyhour())
                {
                echo '
              <tr height="20" bgcolor="'.setcolor('tb_color2').'">
               <td>'.$pieces.' @HH</td>
               <td bgcolor="#FD5952">'.$name.'</td>
               <td bgcolor="#FD0601">'.$minitot.' FR.</td>
              </tr>';
                } else {
                echo '
              <tr height="20" bgcolor="'.setcolor('tb_color2').'">
               <td>'.$pieces.'</td>
               <td>'.$name.'</td>
               <td>'.$minitot.' FR.</td>
              </tr>';
                }
                
                
				$temp = $tot + $minitot;
				$tot = $temp;
			}
		}
		
		echo '
              <tr bgcolor="'.setcolor('tb_color2').'">
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
              </tr>';
		
		if(is_now_happyhour() && is_set_happyhour()) {$extention = "HappyHour";}
		
		echo '
             </table>
             <table width="300" border="'.ooborder().'">
              <tr>
               <td>
                <form method="post" action="touch.php?action=clear" >
                 <button name="clear_button" type="submit"><img src="thumbs/cancel_button.gif" width="160" alt="cancel"/></button>
                </form>
               </td>
               <td>
                <h1>'.$tot.' FR. '.$extention.'</h1>
               </td>
              </tr>
             </table>
             <form method="post" action="touch.php?action=do_button&amp;mode='.$mode.'" >
              <button name="do_button" type="submit"><img src="thumbs/go_button.gif" width="300" alt="go"/></button>
             </form>
             </td>
         </tr>
        </table>';

		echo '
<div class="story"></div>';

	}
	


	if($site == 'undo_but')
	{
		$time = $_GET['time'];
		$cur_user = active_user();
		
		$query = ("DELETE FROM `used` WHERE `timestamp` = '$time' AND `user` = '$cur_user'");
		mysql_query($query);

		$query = ("DELETE FROM `itm_count` WHERE `timestamp` = '$time' AND `user` = '$cur_user'");
		mysql_query($query);

		$query = ("DELETE FROM `sold` WHERE `timestamp` = '$time' AND `user` = '$cur_user'");
		mysql_query($query);
		echo '<font class="error">...buy undone...</font>
		<meta http-equiv="refresh" content="1.5; url=touch.php?site=buttons" />';

	}


}
else
{
echo '<meta http-equiv="refresh" content="5; url=home.php?action=login" /><font class="error">you are not permitted to view this page<br/>please login... <br/>you will be redirected in 5 seconds...</font>';
}
echo '   <div class="story"></div>
     </div>
     <!--end content -->
     <div id="navBar">
       <div id="advert"></div>
         <div id="headlines"></div>
       </div>
     <div id="botbar"><img src="incl/valid.png" width="70" alt="w3c-valid" /></div>
</body>
</html>';
?>
