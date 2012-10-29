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
  <div id="globalNav"> <span class="style2">| <a href="admin.php?site=home">HOME</a> |';
  
if(logged_in())
{

	if(is_admin())
	{
  		echo '<a href="admin.php?site=users">USERS</a> | <a href="admin.php?site=stats">STATISTICS</a> | <a href="admin.php?site=add_things">ADD</a> | <a href="admin.php?site=items">ITEMS</a> | <a href="admin.php?site=stk">STK</a> | <a href="admin.php?site=price">PRICES</a> | <a href="admin.php?site=settings">SETTINGS</a> | <a href="admin.php?site=expn">EXPENSES</a> | <a href="admin.php?site=calc">CALCULATE</a> | <a  href="home.php?action=logout">LOGOUT</a> |';

		echo '</span></div></div><!-- end masthead -->';

		echo '<div id="content">
  				<div id="breadCrumb">
                  <span class="style3"><a href="'.about('url').'">'.about('organisation').'</a> / <a href="./index.php">'.about('pagename').'</a> / YOP </span>
                </div><br />
  			  <h2 id="pageName">Admin - '.$site.'</h2>';


		if( $site == 'home' )
		{
		echo '<table border="'.ooborder().'">
			<tr>
			<td><img src="thumbs/logo_page.jpg" width="400" height="315" alt="logo" /></td>
			<td width="20"></td><td>You are logged in as:<br /> '.active_user().'</td></tr></table>
			<br /><a href="touch.php?site=buttons"><img src="thumbs/touchsys.gif" width="300" height="60" alt="touchsys" /></a><a href="users.php?site=home"><img src="thumbs/usermode.gif" width="300" height="60" alt="usermode" /></a>';
		}
		
		if( $site == 'users' )
		{
			if($action == 'del_user')
				{
					$uid = $_GET['uid'];
					$query = ("DELETE FROM `users` WHERE `UserID` = '".$uid."' LIMIT 1;");
					mysql_query($query);
					echo '<meta http-equiv="refresh" content="1; url=admin.php?site=users" /><font class="error">user deleted...</font>';
				}
				
			if($action == 'mod_user')
			{
				$uid = $_GET['uid'];
				$del = $_POST['delete'];
				
				if($_POST['UserPass'] == 'hidden')
				{
					$query = ("UPDATE `users` SET `UserName` = '".$_POST['UserName']."', `UserMail` = '".$_POST['UserMail']."', `UserGroup` = '".$_POST['UserGroup']."' WHERE `UserID` = '".$uid."' LIMIT 1");
					mysql_query($query);
					if($del == '1')
					{
                            echo '<meta http-equiv="refresh" content="0.1; url=admin.php?site=users&amp;action=del_user&amp;uid='.$uid.'" />';
                    }
                    else {
					        echo '<meta http-equiv="refresh" content="1; url=admin.php?site=users" /><font class="sucess">user updated...</font>';
                         }
				}
				else
				{
					$query = ("UPDATE `users` SET `UserName` = '".$_POST['UserName']."', `UserPass` = MD5('".$_POST['UserPass']."'), `UserMail` = '".$_POST['UserMail']."', `UserGroup` = '".$_POST['UserGroup']."' WHERE `UserID` = '".$_POST['UserID']."' LIMIT 1");
					mysql_query($query);
					echo '<meta http-equiv="refresh" content="1; url=admin.php?site=users" /><font class="sucess">user updated...</font>';

				}
				
			}
			
			if($action == 'add_user')
			{
				$query = ("INSERT INTO `users` SET `UserName` = '".$_POST['UserName']."', `UserPass` = MD5('".$_POST['UserPass']."'), `UserMail` = '".$_POST['UserMail']."', `UserGroup` = '".$_POST['UserGroup']."'");
				mysql_query($query);
				echo '<meta http-equiv="refresh" content="1; url=admin.php?site=users" /><font class="sucess">user added...</font>';

			}
			
			
			echo '<table border="'.ooborder().'">
				<tr bgcolor="'.setcolor('tb_color1').'">
				<td width="145">Username</td>
				<td width="145">Password</td>
				<td width="145">E-Mail</td>
				<td width="145">Group</td>
				<td width="110">Action</td>
				<td width="20">DEL</td>
				</tr>
                </table>';
				
				$userquery = mysql_query(" SELECT * FROM `users` ");
				while($userarray = mysql_fetch_array($userquery))
				{
					echo '<form method="post" action="admin.php?site=users&amp;action=mod_user&amp;uid='.$userarray['UserID'].'">
                    <table border="'.ooborder().'">
                    <tr bgcolor="'.setcolor('tb_color2').'">
                              <td>
						          <input type="hidden" value="'.$userarray['UserID'].'" name="UserID" />
                                  <input type="text" value="'.$userarray['UserName'].'" name="UserName" />
                              </td>
					          <td>
                                  <input type="text" value="hidden" name="UserPass" />
                              </td>
					          <td>
                                  <input type="text" value="'.$userarray['UserMail'].'" name="UserMail" />
                              </td>
				              <td>
                                  <input type="text" value="'.$userarray['UserGroup'].'" name="UserGroup" />
                              </td>
						      <td>
                                  <input type="submit" value="save changes" name="submit" />
                              </td>
                              <td>
                                  <input type="checkbox" value="1" name="delete"/>
                              </td>
                          </tr>
                          </table>
                          </form>';
				}

				echo '<br /><br /><br /><br /><br /><br /><br /><br />';
				echo '<form method="post" action="admin.php?site=users&amp;action=add_user">
                <table border="'.ooborder().'">
					<tr bgcolor="'.setcolor('tb_color1').'">
					<td>ADD USER</td><td bgcolor="'.setcolor('tb_color1').'"></td>
					</tr><tr>
					<td bgcolor="'.setcolor('tb_color2').'">Username:</td><td bgcolor="'.setcolor('tb_color2').'"><input type="text" name="UserName" value="unique username" /></td>
					</tr><tr>
					<td bgcolor="'.setcolor('tb_color2').'">Password:</td><td bgcolor="'.setcolor('tb_color2').'"><input type="text" name="UserPass" value="password" /></td>
					</tr><tr>
					<td bgcolor="'.setcolor('tb_color2').'">E-Mail:</td><td bgcolor="'.setcolor('tb_color2').'"><input type="text" name="UserMail" value="unique mail" /></td>
					</tr><tr>
					<td bgcolor="'.setcolor('tb_color2').'">Group:</td><td bgcolor="'.setcolor('tb_color2').'"><input type="text" name="UserGroup" value="group" /></td>
					</tr><tr>
					<td bgcolor="'.setcolor('tb_color2').'"><input type="submit" value="add user" name="submit" /></td><td bgcolor="'.setcolor('tb_color2').'"></td></tr>
                </table>
                </form>';



		}
		
		if($site == 'stats')
		{
            require_once("incl/colors.php");
			
			echo '<table width="1000" border="'.ooborder().'">
				  <tr>
					<td>
                        <img src="incl/stat_items.png" width="200" height="150" alt="stat_items" /><br />
                        <a href="incl/set_stat_cookie.php?type=items" ><img src="thumbs/reload.jpg" width="50" alt="reload" /></a>
                    </td>
					<td>
                        <img src="incl/stat_users.png" width="200" height="150" alt="stat_users" /><br />
                        <a href="incl/set_stat_cookie.php?type=users" ><img src="thumbs/reload.jpg" width="50" alt ="reload" /></a>
                    </td>
					<td>';
                         $solditema = mysql_fetch_array(mysql_query("SELECT sum(`pcs`) FROM `sold`"));
	                     $solditems = floatval($solditema['sum(`pcs`)']);
	                     $logged_in_usrs = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `UserSession` != 'NULL'"));
	                     $selltrans = floatval(mysql_num_rows(mysql_query("SELECT * FROM `sold` ")));
	                     if($selltrans == '') {$selltrans = 1; $solditems = 1;}
                         echo '<table border="'.ooborder().'"><tr><td width="200" bgcolor="'.setcolor('tb_color1').'">total sold items</td><td width="100" bgcolor="'.setcolor('tb_color2').'"><div align="center">'.$solditems.'</div></td></tr>
                         <tr><td width="200" bgcolor="'.setcolor('tb_color1').'">total sell transactions</td><td width="100" bgcolor="'.setcolor('tb_color2').'"><div align="center">'.$selltrans.'</div></td></tr>
                         <tr><td width="200" bgcolor="'.setcolor('tb_color1').'">items per transaction</td><td width="100" bgcolor="'.setcolor('tb_color2').'"><div align="center">'.($solditems / $selltrans).'</div></td></tr>
                         <tr><td width="200" bgcolor="'.setcolor('tb_color1').'">users online</td><td width="100" bgcolor="'.setcolor('tb_color2').'"><div align="center">'.$logged_in_usrs.'</div></td></tr></table>';

             echo' </td>
					<td></td>
				  </tr>
				  <tr>
					<td>'; 		
							$c = 0;
							echo '<table width="250" border="'.ooborder().'">';
							if(isset($_COOKIE['yop_stats_items']))
							{	
								$array = $_COOKIE['yop_stats_items'];
								arsort($array);
								foreach($array as $itm => $pcs)
								{
									echo '<tr><td bgcolor="'.$rgb[$c].'" width="50" ></td><td>'.$itm.'</td><td>'.$pcs.'</td></tr>';
									$c++;
									if($c > 6){ die();}
								}
							}
							else
							{
								echo '<a href="incl/set_stat_cookie.php?type=items">Refresh Stats</a>';
							}
							echo '</table>';
			echo '</td>
					<td>';
							$c = 0;
							echo '<table width="250" border="'.ooborder().'">';
							if(isset($_COOKIE['yop_stats_users']))
							{	
								$array = $_COOKIE['yop_stats_users'];
								arsort($array);
								foreach($array as $itm => $pcs)
								{
									echo '<tr><td bgcolor="'.$rgb[$c].'" width="50" ></td><td>'.$itm.'</td><td>'.$pcs.'</td></tr>';
									$c++;
									if($c > 6){ die();}
								}
							}
							else
							{
								echo '<a href="incl/set_stat_cookie.php?type=users">Refresh Stats</a>';
							}
							echo '</table>';
			echo '</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				</table>';
		}
		
		if($site == 'add_things')
		{
			if($action == 'none')
			{
			echo '<br /><br /><br />';

			echo '
                <form method="post" action="admin.php?site=add_things&amp;action=do_add_ingr">
                <table><tr><td width="200"><h2 >add ingredient:</h2></td><td>&nbsp;</td><td>
				<input name="iname" type="text" value="name of ingredient" size="20" />
				<input name="submit" type="submit" value="add" /></td></tr></table>
				</form>';
				
			echo '<br /><br /><br />';

			echo '
                <form method="post" action="admin.php?site=add_things&amp;action=do_add_subcat">
				<table><tr><td width="200"><h2>add subcategory:</h2></td><td>&nbsp;</td><td>
                <input type="text" name="new_subcat" value="name of subcategory" size="20"/>
				<input name="submit" type="submit" value="add" /></td></tr></table>
				</form>';

			echo '<br /><br /><br />';
			
			echo '
                <form method="post" action="admin.php?site=add_things&amp;action=add_item">
				<table><tr><td width="200"><h2 >add item:</h2></td><td>&nbsp;</td><td>
                <input name="pcs_itm" type="text" value="amount of ingredients" size="20" />
				<input name="submit" type="submit" value="next" /></td></tr></table>
				</form>';
				
			}
			
			if($action == 'do_add_ingr')
			{
				$name = $_POST['iname'];
				$query = ("ALTER TABLE `items` ADD `$name` VARCHAR(20) NOT NULL;");
				mysql_query($query);
				$query = ("INSERT INTO `itm_strc` (`display`) VALUES ('$name');");
				mysql_query($query);
				$query = ("ALTER TABLE `used` ADD `$name` VARCHAR(20) NOT NULL;");
				mysql_query($query);
				$query = ("INSERT INTO `ingr` (`display`) VALUES ('$name');");
				mysql_query($query);
				$query = (" ALTER TABLE `stk` ADD `$name` VARCHAR( 20 ) NOT NULL;");
				mysql_query($query);
				echo "<font class=\"sucess\">".$name." - added</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=add_things" />';	
			}
			
			
			if($action == 'add_item')
			{
			
				$pcs_ingr = $_POST['pcs_itm'];
				echo '<form enctype="multipart/form-data" method="post" action="admin.php?site=add_things&amp;action=do_add_item">
    					<br />
						<input name="submit" type="submit" value="next" /><br />
						<input name="pcs" type="hidden" value="'.$pcs_ingr.'" /><br />
						item name: <input name="name" type="text" value="name" size="50" /><br />
						item thumbnail: <input name="thumb" type="file" value="./thumbs/bild.gif" size="50" /><br />';
				  
				for($i=1;$i<=$pcs_ingr;$i++)
				{
					echo 'ingredient-'.$i.':<select name="z'.$i.'"><option value=" ">choose...</option>';
					$ingrquer = mysql_query("SELECT * FROM `ingr`");
					while($ingrarr =mysql_fetch_array($ingrquer))
					{
							echo '<option value="'.$ingrarr['display'].'" >'.$ingrarr['display'].'</option>';
					}
					
					echo '</select>amount: <input name="m'.$i.'" type="text" value="[cl]" size="5" /><br />';
				};
				echo ' subcategory: <select name="subcat"><option value="empty">choose...</option>';
				$quer = mysql_query("SELECT * FROM `subcat`");
				while($arra = mysql_fetch_array($quer))
				{
					echo '<option value="'.$arra['nr'].'" >'.$arra['subcat'].'</option>';
				}
				echo '</select>';
				echo '<br />item has happyhour reduction: <input type="radio" name="has_hh" value="0" />NO  - <input type="radio" name="has_hh" value="1" />YES';
				echo '</form>';
			}

			if($action == 'do_add_item')
			{
                $path = 'thumbs/';
                $filename_temp = $_FILES['thumb']['tmp_name'];
                $filename = $_FILES['thumb']['name'];
                move_uploaded_file($filename_temp, $path.$filename);
                $upload_successful = 'uploaded';


				$pcs = $_POST['pcs'];
				$name = $_POST['name'];
				$id = $_POST['id'];
				$thumb = $filename;
				$hh_set = $_POST['has_hh'];
				for($z=1; $z <= $pcs; $z++)
				{
					$arr[0][$z] = $_POST['z'.$z];
					$arr[1][$z] = $_POST['m'.$z];
				}
				$subcat = $_POST['subcat'];	
				$query = "INSERT INTO `items` ( `id` , `display` , `subcat` , `thumb` , `anz` , `hh` , ";
				for($i = 1; $i < $pcs; $i++)
					$query .= "`".$arr[0][$i]."` , ";
				if($i == $pcs)
					$query .= "`".$arr[0][$i]."`";
				$query .= ") VALUES (NULL , '".$name."' , '".$subcat."' , 'thumbs/".$thumb."' , '".$pcs."' , '".$hh_set."' , ";
				for($i = 1; $i < $pcs; $i++)
					$query .= "'".$arr[1][$i]."' , ";
				if($i == $pcs)
					$query .= "'".$arr[1][$i]."'";
				$query .= ")";
				mysql_query($query);
				$query = ("ALTER TABLE `itm_count` ADD `".$name."` VARCHAR(20) NOT NULL DEFAULT 'x'");
				mysql_query($query);
				$query = ("INSERT INTO `itm_vp` (`timestamp` , `0p` , `vp`) VALUES ( '".time()."' , '0' , '0')");
				mysql_query($query);
				echo "<font class=\"sucess\">".$name." - added</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=add_things" />';
			}
			
			if($action == 'do_add_subcat')
			{
			$s_name = $_POST['new_subcat'];
			$query = ("INSERT INTO `subcat` (`subcat`) VALUES ('".$s_name."')");
			mysql_query($query);
			echo "<font class=\"sucess\">".$s_name." - added</font>";
			echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=add_things" />';
			}

		}
		
		if($site == 'items')
		{
			if($action == 'none')
			{
				$catquery = mysql_query("SELECT * FROM `subcat`");
				while($category = mysql_fetch_array($catquery))
				{
					echo '<h2>-> '.$category['subcat'].':</h2><br />
					<table width="440" border="'.ooborder().'">
					<tr bgcolor="'.setcolor('tb_color1').'" >
                    <td>ID</td>
					<td>items (click on it to edit)</td>
					<td>item count</td>
					<td>happyhour</td>
					</tr>';
					
					$result = mysql_query("SELECT * FROM `items` WHERE subcat = ".$category['nr']."");
					while($row = mysql_fetch_array($result))
					{
						$res = mysql_query("SELECT sum(".$row['display'].") AS ".$row['display']." FROM `itm_count`");
						$arr = mysql_fetch_array($res);
						if( $row['hh'] == 1) {$hh = "ON";} else {$hh = "OFF";}
						echo '<tr>
                        <td bgcolor="'.setcolor('tb_color2').'" >'.$row['id'].'</td>
                        <td bgcolor="'.setcolor('tb_color3').'"><a href="admin.php?site=items&amp;action=cng_item&amp;id='.$row['id'].'&amp;name='.$row['display'].'">'.$row['display'].'</a></td>
                        <td bgcolor="'.setcolor('tb_color3').'" align="center" >'.$arr[$row['display']].'</td>
                        <td bgcolor="'.setcolor('tb_color3').'" align="center" >'.$hh.'</td>
                        </tr>';
					}
					echo '</table><br />';
				}
			}
			
			if($action == 'cng_item')
			{
				$itmname = $_GET['name'];
				$itmid = $_GET['id'];
				$iinfo = mysql_fetch_array(mysql_query("SELECT * FROM `items` WHERE `id` = '".$itmid."'"));
				$ingr = mysql_query("SELECT * FROM `ingr`");
				$num = mysql_num_rows(mysql_query("SELECT `display` FROM `itm_strc`"));
				$st = mysql_fetch_array($ingr);
				
				echo '<table width="400" border="'.ooborder().'">';
				echo '<tr bgcolor="'.setcolor('tb_color1').'">
						<th>---'.$itmname.'---</th>
						<th>amount</th>
					</tr>';
				
				$i = 6;
				$ingred = mysql_query("SELECT * FROM `ingr`");
				while($row = mysql_fetch_array($ingred))
				{
					if( $iinfo[$i] != NULL)
					{
						echo '<tr><td bgcolor="'.setcolor('tb_color2').'"><a href="admin.php?site=items&amp;action=det_ingr&amp;name='.$row['display'].'">'.$row['display'].'</a></td><td bgcolor="'.setcolor('tb_color3').'">'.$iinfo[$i].'</td></tr>';
					}
				$i++;	
				}
				
				echo '</table>';
				
				echo '<form method="post" action="admin.php?site=items&amp;action=do_cng_item&amp;name='.$itmname.'&amp;id='.$itmid.'"><br />
					reset item count: <br />
					<input type="radio" name="do_del_count" value="0" checked />no <input type="radio" name="do_del_count" value="1" />yes <br />
					delete item: <br />
					<input type="radio" name="do_del_item" value="0" checked />no <input type="radio" name="do_del_item" value="1" />yes <br />';
                if(has_hh($itmname) == off) {echo 'item has happyhour reduction: <input type="radio" name="has_hh" value="0" checked />NO  - <input type="radio" name="has_hh" value="1" />YES<br />';}
                if(has_hh($itmname) == on) {echo 'item has happyhour reduction: <input type="radio" name="has_hh" value="0" />NO  - <input type="radio" name="has_hh" value="1" checked />YES<br />';}
            	echo'<input type="text" name="confirm" value="to confirm action enter -42- please" size="40" /><input type="submit" value="submit" />
					</form>';
				echo '<br /><a href="javascript:history.back()"><img src="thumbs/num/back.gif" width="50" alt="back" /></a>';
			}
			
			if($action == 'do_cng_item')
			{
				$id = $_GET['id'];
				$name = $_GET['name'];
				$del_count = $_POST['do_del_count'];
				$del_item = $_POST['do_del_item'];
				$hh_set = $_POST['has_hh'];
				$confirm = $_POST['confirm'];
				
				if($confirm == '42')
				{
					if($del_count == '1')
					{
					mysql_query("DELETE FROM `itm_count` WHERE `".$name."` != 'x' ");
					}
					
					if($hh_set == 1) {mysql_query("UPDATE `items` SET `hh` = '1' WHERE `id` = '".$id."' LIMIT 1");}
					else {mysql_query("UPDATE `items` SET `hh` = '0' WHERE `id` = '".$id."' LIMIT 1");}
				
					if($del_item == '1')
					{
					mysql_query("DELETE FROM `items` WHERE `display` = '".$name."'");
					mysql_query("DELETE FROM `itm_count` WHERE `".$name."` != 'x' ");
					}
					
					echo "<font class=\"error\">changes in: $name saved</font>";
					echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=items" />';
				} 
				else
				{
					echo "<font class=\"error\">error<br />bad confirmation</font>";
					echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=items" />';
				}
				
			}
			
			if($action == 'det_ingr')
			{
				$name = $_GET['name'];
				echo '<table width="600" border="0">
				<tr bgcolor="'.setcolor('tb_color1').'" >
				<td>bought</td>
				<td>remaining</td>
				</tr>';
				$result = mysql_query("SELECT * FROM `ingr` WHERE `display` = '$name'");
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
					echo '<tr><td width="100" bgcolor="'.setcolor('tb_color3').'">'.$arr[$row['display']].'</td><td width="100" bgcolor="'.setcolor('tb_color3').'">'.$result3.'</td></tr>';
				}
				echo '</table>';
				echo '<br /><a href="javascript:history.back()"><img src="thumbs/num/back.gif" width="50" alt="back" /></a>';

			}
			
		}
		
		if($site == 'stk')
		{
			if($action == 'none')
			{
				echo'<table width="820" border="'.ooborder().'">
				<tr bgcolor="'.setcolor('tb_color1').'" >
				<td>name</td>
				<td>bought</td>
				<td>remaining</td>
				<td>state</td>
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
					echo '</td><td width="100" bgcolor="'.setcolor('tb_color3').'">';
					
					if($arr[$row['display']] == '') { $percent = 0;} else { $percent = $result3 / $arr[$row['display']] * 100;}
					
					$crit = $percent - 25; 
					$good = $percent - 50; 
					
					if($percent > 25){ echo '<img src="thumbs/bad.gif" width="10" alt="bad" /><img src="thumbs/bad.gif" width="10" alt="bad" /><img src="thumbs/bad.gif" width="10" alt="bad" /><img src="thumbs/bad.gif" width="10" alt="bad" /><img src="thumbs/bad.gif" width="10" alt="bad" />';}
					else
					{
						for($i = 0;$i < $percent; $i + 5)
						{
							echo '<img src="thumbs/bad.gif" width="10" alt="bad" />';
							if($i > $percent){die();}
							$n = $i + 5;
							$i = $n;
						}
					}
					
					if($percent > 50) { echo '<img src="thumbs/critical.gif" width="10" alt="critical" /><img src="thumbs/critical.gif" width="10" alt="critical" /><img src="thumbs/critical.gif" width="10" alt="critical" /><img src="thumbs/critical.gif" width="10" alt="critical" /><img src="thumbs/critical.gif" width="10" alt="critical" />';}
					else
					{
						for($i = 0;$i < $crit; $i + 5)
						{
							echo '<img src="thumbs/critical.gif" width="10" alt="critical" />';
							if($i > $crit){die();}
							$n = $i + 5;
							$i = $n;
						}
					}
					
					if($percent > 50)
					{
						for($i = 0;$i < $good;)
						{
							echo '<img src="thumbs/good.gif" width="10" alt="good" />';
							if($i > $good){die();}
							$n = $i + 5;
							$i = $n;
						}
					}
					echo '</td></tr>';
					
					
				}
				
				echo '</table>';
				
				echo '<br /><br /><br /><h2 >add admount</h2><br />
				<form method="post" action="admin.php?site=stk&amp;action=do_add_amount">';
				
				echo '<select name="ingr"><option value=" ">choose...</option>';
				
				$result = $db->query("SELECT * FROM `ingr`");
				while($row = $db->fetch_array($result))
				{
					echo '<option value="'.$row['display'].'" >'.$row['display'].'</option>';
				}
				echo '</select>';					
				
				echo '<br />
				amount: 
				<input name="amount" type="text" value="amount [cl]" size="10" /> 
				- price: &nbsp;&nbsp;
				<input name="price" type="text" value="price [Fr]" size="12" />
				<input value="add" type="submit" />
				</form>';
			}
			
			if($action == 'do_add_amount')
			{
				$query = ("INSERT INTO `bought` (`timestamp` , `name` , `preis` , `menge`) VALUES ('".time()."' , '".$_POST['ingr']."' , '".$_POST['price']."' , '".$_POST['amount']."');");
				mysql_query($query);
				$query = ("INSERT INTO `stk` (`timestamp` , `".$_POST['ingr']."`) VALUES ('".time()."' , '".$_POST['amount']."');");
				mysql_query($query);
				
				echo "<font class=\"sucess\">the amount has been added</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=stk" />';
			}
	
		}
		
		if($site == 'price')
		{
			if($action == 'none')
			{
				echo '<form method="post" action="admin.php?site=price&amp;action=do_set_price">
				<table width="800" border="'.ooborder().'">
				<tr bgcolor="'.setcolor('tb_color1').'">
				<td width="60" >ID</td>
				<td width="150" >name </td>
				<td width="100" >minimal price [Fr]</td>
				<td>actual price [Fr]</td>
				<td width="60" >subcat ID</td>
				</tr>';
					  
				$result = mysql_query("SELECT * FROM `items`");
				while($row = mysql_fetch_array($result))
				{
					$price = getactprice($row['id']);
					$v0 = round((getv0p($row['display'])), 3);
					echo '<tr>
                              <td bgcolor="'.setcolor('tb_color2').'">'.$row['id'].'</td>
                              <td bgcolor="'.setcolor('tb_color3').'">'.$row['display'].'</td>
                              <td bgcolor="'.setcolor('tb_color3').'">'.$v0.'</td>
                              <td bgcolor="'.setcolor('tb_color3').'"><input type="text" name="vp_'.$row['id'].'" value="'.$price.'" /> CHF</td>
                              <td bgcolor="'.setcolor('tb_color2').'">'.$row['subcat'].'</td>
                          </tr>';
				}
				
				echo '</table>';
				echo '<br /><input type="submit" value="save changes" /></form>';
			}
			
			if($action == 'do_set_price')
			{
				$i = 0;
				
				$arra = mysql_query("SELECT * FROM `items`");
				while( $row = mysql_fetch_array($arra))
				{
					$post[$i] = $_POST['vp_'.$row['id']];
					if(!mysql_fetch_array(mysql_query("SELECT * FROM `itm_vp` WHERE `id` = '".$row['id']."'")))
					{
					mysql_query("INSERT INTO `itm_vp` ( `timespamp` , `id` , `0p` , `vp` ) VALUES ( '".time()."', '".$row['id']."', '0', '".$post[$i]."' )");
					}
					mysql_query("UPDATE `itm_vp` SET `timestamp` = '".time()."' , `vp` = '".$post[$i]."' WHERE `id` = '".$row['id']."'");
					$i++;
				}
				
				echo "<font class=\"sucess\">new prices have been set</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=price" />';
			}
			
		}
		
		if($site == 'settings')
		{
			if($action == 'none')
			{

				
				echo '<br /><h2>happyhour</h2>
				<br />
				<form method="post" action="admin.php?site=settings&amp;action=do_happyhour">
				<table width="467" class="hht" border="'.ooborder().'">
				<tr bgcolor="'.setcolor('tb_color1').'">
				<th width="111" height="38" scope="col">HR</th>
				<th width="151" scope="col"><div align="center">hour</div></th>
				<th width="183" scope="col"><div align="center">minute</div></th>
				<th width="151" scope="col"><div align="center">seconds</div></th>
				<th width="151" scope="col"><div align="center">day</div></th>
				<th width="151" scope="col"><div align="center">month</div></th>
				<th width="151" scope="col"><div align="center">year</div></th>
				</tr>
				<tr>
				<th bgcolor="'.setcolor('tb_color2').'" scope="row">start</th>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_s_hour" value="'.happyhour('hh_s_hour').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_s_minute" value="'.happyhour('hh_s_minute').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_s_seconds" value="'.happyhour('hh_s_seconds').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_s_day" value="'.happyhour('hh_s_day').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_s_month" value="'.happyhour('hh_s_month').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_s_year" value="'.happyhour('hh_s_year').'" size="6" maxlength="4"/></div></td>
				</tr>
				<tr>
				<th bgcolor="'.setcolor('tb_color2').'" scope="row">end</th>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_e_hour" value="'.happyhour('hh_e_hour').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_e_minute" value="'.happyhour('hh_e_minute').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_e_seconds" value="'.happyhour('hh_e_seconds').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_e_day" value="'.happyhour('hh_e_day').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_e_month" value="'.happyhour('hh_e_month').'" size="5" maxlength="2"/></div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="hh_e_year" value="'.happyhour('hh_e_year').'" size="6" maxlength="4"/></div></td>
				</tr>
				</table>
				<input type="radio" name="status" value="0"/>happyhour OFF 
				<input type="radio" name="status" value="1" checked="checked" />happyhour ON <br />
				<input type="submit" value="submit"/>
				</form><br />';
				
				echo '<h2>tablecolor</h2>
				<br />
				<form method="post" action="admin.php?site=settings&amp;action=do_tablecolor">
				<table width="467" class="tbcol" border="'.ooborder().'">
				<tr bgcolor="'.setcolor('tb_color1').'">
				<th width="111" height="38" scope="col">color 1</th>
				<th width="151" scope="col"><div align="center">color 1</div></th>
				<th width="183" scope="col"><div align="center"><input type="text" name="tb_color1" value="'.setcolor('tb_color1').'"/></div></th>
				</tr>
				<tr>
				<th bgcolor="'.setcolor('tb_color2').'" scope="row">color 2</th>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center">color 3</div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center">color 3</div></td>
				</tr>
				<tr>
				<th bgcolor="'.setcolor('tb_color2').'" scope="row"><input type="text" name="tb_color2" value="'.setcolor('tb_color2').'"/></th>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center">color 3</div></td>
				<td bgcolor="'.setcolor('tb_color3').'"><div align="center"><input type="text" name="tb_color3" value="'.setcolor('tb_color3').'"/></div></td>
				</tr>
				</table>
				<br />
				<input type="radio" name="border" value="0" checked="checked" />Border OFF
				<input type="radio" name="border" value="1"/>Border ON <br />
				<input type="submit" value="submit"/>
				</form><br />';
				
				echo '<h2>other colors</h2>
				<br />
				<form method="post" action="admin.php?site=settings&amp;action=do_color">
				<table width="467" class="tbcol" border="'.ooborder().'">
				<tr bgcolor="'.setcolor('tb_color1').'">
				<th>name</th>
				<th>color</th>
				<th>code</th>
				</tr>
				<tr>
				<td bgcolor="'.setcolor('tb_color2').'">body background</td>
				<td bgcolor="'.setcolor('body_bg').'"></td>
				<td bgcolor="'.setcolor('tb_color3').'">Code: <input type="text" name="body_bg" value="'.setcolor('body_bg').'" /></td>
				</tr>
				<tr>
				<td bgcolor="'.setcolor('tb_color2').'">link color</td>
				<td bgcolor="'.setcolor('tb_color3').'"><a href="">color</a></td>
				<td bgcolor="'.setcolor('tb_color3').'">code: <input type="text" name="a_link" value="'.setcolor('a_link').'" /></td>
				</tr>
				<tr>
				<td bgcolor="'.setcolor('tb_color2').'">link over background</td>
				<td bgcolor="'.setcolor('tb_color3').'"><a href="">color</a></td>
				<td bgcolor="'.setcolor('tb_color3').'">code: <input type="text" name="a_hover" value="'.setcolor('a_hover').'" /></td>
				</tr>
				<tr>
				<td bgcolor="'.setcolor('tb_color2').'">title</td>
				<td bgcolor="'.setcolor('tb_color3').'"><h1>color</h1></td>
				<td bgcolor="'.setcolor('tb_color3').'">code: <input type="text" name="h1" value="'.setcolor('h1').'" /></td>
				</tr>
				<tr>
				<td bgcolor="'.setcolor('tb_color2').'">head background</td>
				<td bgcolor="'.setcolor('masterhead_bg').'"></td>
				<td bgcolor="'.setcolor('tb_color3').'">code: <input type="text" name="masterhead_bg" value="'.setcolor('masterhead_bg').'" /></td>
				</tr>
				<tr>
				<td bgcolor="'.setcolor('tb_color2').'">text color</td>
				<td bgcolor="'.setcolor('tb_color3').'">color</td>
				<td bgcolor="'.setcolor('tb_color3').'">code: <input type="text" name="body_col" value="'.setcolor('body_col').'" /></td>
				</tr>
				</table>
				<input type="submit" value="submit" /><p>ATTENTION: The touchscreenstylesheed needs to be corrected manually.</p>
				</form>
				<p><br />
				</p>';
				
			}
			
			if($action == 'do_happyhour')
			{
				foreach( $_POST as $name => $value)
				{
					$sql = ("UPDATE `happyhour` SET `value` = '".$value."' WHERE `name` = '".$name."'");
					mysql_query ($sql);
				}
				echo "<font class=\"sucess\">new happyhour ettings have been set</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=settings" />';
			}
			
			if($action == 'do_tablecolor')
			{
				foreach( $_POST as $color => $code)
				{
					$sql = ("UPDATE `colors` SET `code` = '".$code."' WHERE `color` = '".$color."'");
					mysql_query ($sql);
				}
				
				echo "<font class=\"sucess\">new table settings have been set</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=settings" />';

			}
			
			if($action == 'do_color')
			{
				foreach( $_POST as $color => $code)
				{
					$sql = ("UPDATE `colors` SET `code` = '".$code."' WHERE `color` = '".$color."'");
					mysql_query ($sql);
				}
				
				echo "<font class=\"sucess\">new colors have been set</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=settings" />';

			}
		}
		
		if($site == 'expn')
		{
			if($action == 'none')
			{
				echo '<table width="1034" border="'.ooborder().'">
				  <tr bgcolor="'.setcolor('tb_color1').'">
					<th width="60" scope="col">id</th>
					<th width="146" scope="col">name</th>
					<th width="119" scope="col">price</th>
					<th width="240" scope="col">usage</th>
					<th width="335" scope="col">note</th>
					<th width="94" scope="col">action</th>
				  </tr>';
				$query = mysql_query("SELECT * FROM `expn`");
				while( $money = mysql_fetch_array($query))
				{
					echo '	<tr>
							<td bgcolor="'.setcolor('tb_color2').'">'.$money['id'].'</td>
							<td bgcolor="'.setcolor('tb_color3').'">'.$money['name'].'</td>
							<td bgcolor="'.setcolor('tb_color3').'"><div align="right">'.$money['preis'].' Fr. </div></td>
							<td bgcolor="'.setcolor('tb_color3').'">'.$money['zweck'].'</td>
							<td bgcolor="'.setcolor('tb_color3').'">'.$money['note'].'</td>
							<td bgcolor="'.setcolor('tb_color3').'">
                            <form method="post" action="admin.php?site=expn&amp;action=do_kill_expn&amp;id='.$money['id'].'">
                            <input type="submit" value="delete" /></form></td>
							</tr>';
				}
				echo '</table>';
				echo '<form method="post" action="admin.php?site=expn&amp;action=do_add_expn">
                      <table width="1034" border="'.ooborder().'">
					  <tr>
				      <td width="60" bgcolor="'.setcolor('tb_color2').'">NEW:</td>
				      <td width="146" bgcolor="'.setcolor('tb_color3').'">
                      <select name="name"><option value="X">choose...</option>';

				$mitq = mysql_query("SELECT * FROM `empl`");
				while( $ma = mysql_fetch_array($mitq))
				{
					echo '<option value="'.$ma['name'].'">'.$ma['name'].'</option>';
				}	
				echo '</select></td>
                      <td width="119" bgcolor="'.setcolor('tb_color3').'"><input type="text" name="expense" size="15"/></td>
                      <td width="240" bgcolor="'.setcolor('tb_color3').'"><input type="text" name="usage" size="36"/></td>
                      <td width="335" bgcolor="'.setcolor('tb_color3').'"><input type="text" name="note" size="50"/></td>
                      <td width="100" bgcolor="'.setcolor('tb_color3').'"><input type="submit" value="add" /></td>
					</tr>
                    </table>
					</form>';
				
				echo '<br /><br />';
				
				echo '<table width="350" border="'.ooborder().'">
                         <tr bgcolor="'.setcolor('tb_color1').'">
                             <th>name</th>
                             <th>total</th>
                             <th>action</th>
                         </tr>';
				
				$anameq = mysql_query("SELECT * FROM `empl`");
				while( $aname = mysql_fetch_array($anameq))
				{
					$ausgq = mysql_query("SELECT sum(`preis`) AS total FROM `expn` WHERE `name` = '".$aname['name']."'");
					$ausg = mysql_fetch_array($ausgq);
					echo '<tr>
                              <td bgcolor="'.setcolor('tb_color2').'">'.$aname['name'].'</td>
                              <td bgcolor="'.setcolor('tb_color3').'"><div align="right">'.$ausg['total'].' Fr. </div></td>
                              <td bgcolor="'.setcolor('tb_color3').'">
                              <form method="post" action="admin.php?site=expn&amp;action=kill_empl&amp;id='.$aname['id'].'&amp;name='.$aname['name'].'">
                              <input type="submit" value="delete" />
                              </form>
                              </td>
                          </tr>';
				}
				
				echo '</table></form>';
				
				echo '<br /><br /><br />';
		
				echo '<h2>add employee</h2>';
				echo '<form method="post" action="admin.php?site=expn&amp;action=do_add_empl">
				<input type="text" name="new" value="name of employee" size="30"/>
				<input type="submit" value="add" />
				</form>';
			}
			
			if($action == 'do_add_empl')
			{
				$name = $_POST['new'];
				$query = ("INSERT INTO `empl` (`id`, `name`) VALUES (NULL, '".$name."')");
				mysql_query($query);
				echo "<font class=\"sucess\">".$name." - added</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=expn" />';
			}
			
            if($action == 'kill_empl')
            {
                $id = $_GET['id'];
                $name = $_GET['name'];
                mysql_query("DELETE FROM `empl` WHERE `id` = '".$id."'");
                mysql_query("DELETE FROM `expn` WHERE `name` = '".$name."'");
				echo "<font class=\"error\">eemployee deleted</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=expn" />';
            }
			if($action == 'do_kill_expn')
			{
				$id = $_GET['id'];
				mysql_query("DELETE FROM `expn` WHERE `id` = '".$id."'");
				echo "<font class=\"error\">expense deleted</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=expn" />';
			}
			
			if($action == 'do_add_expn')
			{
				$name = $_POST['name'];
				$expense = $_POST['expense'];
				$usage = $_POST['usage'];
				$note = $_POST['note'];
				$query = ("INSERT INTO `expn` (`name` , `preis` , `zweck` , `note`) VALUES ( '".$name."' , '".$expense."' , '".$usage."' , '".$note."')");
				mysql_query($query);
				echo "<font class=\"sucess\">expense added</font>";
				echo '<meta http-equiv="refresh" content="1.5; url=admin.php?site=expn" />';
			}
			
		}
		
		if($site == 'calc')
		{
		    if($action == 'none')
		    {
                echo '<br /><br />
                      <form method="post" action="calc.php">
                            <input type="text" name="confirm" value="type 42 to confirm" />
                            <br />reset data? No:<input type="radio" name="reset" value="OFF" checked="checked" /> - Yes:<input type="radio" name="reset" value="On" />
                            <br /><button type="submit" name="submit"><img src="thumbs/do_calc.gif" width="50" alt="docalc"/></button>
                      </form>';
            }
		}
	}
	else
	{
		echo '<meta http-equiv="refresh" content="5; url=users.php?" /><font class="error">you are not sufficient rights to view this page<br >please login as admin... <br >you will be redirected in 5 seconds...</font>';

	}
}
else
{
	echo '<meta http-equiv="refresh" content="5; url=home.php?action=login" /><font class="error">you are not permitted to view this page<br >please login... <br >you will be redirected in 5 seconds...</font>';
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
