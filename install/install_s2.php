<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>- ABOUT -</title>
<link rel="stylesheet" type="text/css" href="install_style.css" />
<style type="text/css">
<!--
.style2 {font-size: 24px}
.style3 {font-size: x-small}
-->
</style>
<SCRIPT LANGUAGE="JavaScript">
function confirm(red)
{
var el = red.parentNode;
var text;
var href = red.href;
var original_text = el.innerHTML;
text = 'Please erase old data to continue installing the software...! <br />select `Update` when you  have an old installation running...!';
text += '<a href="' + href + '">Continue</a>';
text += ' / ';
text += '<a href="index.php">Abort</a>';
text += ' / ';
text += '<a href="update.php">Update</a>';
}
</SCRIPT>
</head>
<body>
<div id="masthead">
<h1 id="siteName">YOP - Installation / Update</h1>
<div id="globalNav"> <span class="style2">| <a href="javascript:window.open('index.php', '_self')">ABORT</a> |</span></div>
</div>
<!-- end masthead -->

<div id="content">
<div id="breadCrumb"> <span class="style3">/ Installation & Update / Step 2</span></div>
<br />
<h2 id="pageName">Checking connection</h2>

<?php if(require("global.php"))
{
echo 'Connect to MySQL Server . . . <img src="../thumbs/tick.png" width="30" /> successful';
copy("global.php", "../global.php");
}
else {echo 'Connect to MySQL Server . . . <img src="../thumbs/cross.png" width="30" /> failed';} ?>

<div class="story">

</div>
</div>
<!--end content -->

<!--end navbar -->
<div id="siteInfo"><div align="right"><button  onclick="javascript:window.open('install_s3.php', '_self')" value="next" ><h1>Next 3/8</h1></button></div></div>
<br />
<div id="b_left_bar"><img src="../incl/php.gif" width="70" alt="w3c-valid" /></div>
<div id="botbar"><img src="../incl/valid.png" width="70" alt="w3c-valid" /></div>
<div id="b_right_bar"><img src="../incl/mysql.gif" width="70" alt="w3c-valid" /></div>
</body>
</html>
