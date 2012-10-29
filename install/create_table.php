<?php
require("global.php"); echo '<br />opening connection . . . <img src="../thumbs/tick.png" width="30" />';

if(!$test = mysql_query("SELECT * FROM `about`")) {echo '<br />Checking for existing table `about`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {echo '<br />Existing table `about` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `bought`")) {echo '<br />Checking for existing table `bought`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {echo '<br />Existing table `bought` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `colors`")) {echo '<br />Checking for existing table `colors`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `empl`")) {echo '<br />Checking for existing table `empl`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `empl` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `expn`")) {echo '<br />Checking for existing table `expn`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `expn` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `happyhour`")) {echo '<br />Checking for existing table `happyhour`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `happyhour found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `ingr`")) {echo '<br />Checking for existing table `ingr`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `ingr` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `items`")) {echo '<br />Checking for existing table `items`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `items` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `itm_count`")) {echo '<br />Checking for existing table `itm_count`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `itm_count` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `itm_strc`")) {echo '<br />Checking for existing table `itm_strc`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `itm_strc` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `itm_vp`")) {echo '<br />Checking for existing table `itm_vp`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `itm_vp` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `sets`")) {echo '<br />Checking for existing table `sets`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `sets` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `sold`")) {echo '<br />Checking for existing table `sold`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `sold` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `stk`")) {echo '<br />Checking for existing table `stk`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `stk` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `subcat`")) {echo '<br />Checking for existing table `subcat`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `subcat` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `used`")) {echo '<br />Checking for existing table `used`. . . <img src="../thumbs/tick.png" width="30" /> successful';}
else {$error = 'exist'; echo '<br />Existing table `used` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed';}
if(!$test = mysql_query("SELECT * FROM `users`")) {echo '<br />Checking for existing table `users`. . . <img src="../thumbs/tick.png" width="30" /> successful<br />';}
else {$error = 'exist'; echo '<br />Existing table `users` found . . . <a href="delete_all_tables.php"onclick="return confirm(\'Please erase old data to continue installing the software...! \');"><img src="../thumbs/cross.png" width="30" /></a> failed<br />';}

?>
