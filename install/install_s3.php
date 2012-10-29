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
</head>
<body>
<div id="masthead">
<h1 id="siteName">YOP - Installation / Update</h1>
<div id="globalNav"> <span class="style2">| <a href="javascript:window.open('index.php', '_self')">ABORT</a> |</span></div>
</div>
<!-- end masthead -->

<div id="content">
<div id="breadCrumb"> <span class="style3">/ Installation & Update / Step 3</span></div>
<br />
<h2 id="pageName">Installing Tables</h2>

<?php require("create_table.php");

if($error == 'exist')
{
echo '
<div class="story">

</div>
</div>
<!--end content -->

<!--end navbar -->
<div id="siteInfo"><div align="right"><button  onclick="javascript:window.open(\'install_s4.php\', \'_self\')" value="next" disabled><h1>Next 4/8</h1></button></div></div>
<br />
<div id="b_left_bar"><img src="../incl/php.gif" width="70" alt="w3c-valid" /></div>
<div id="botbar"><img src="../incl/valid.png" width="70" alt="w3c-valid" /></div>
<div id="b_right_bar"><img src="../incl/mysql.gif" width="70" alt="w3c-valid" /></div>
</body>
</html>';
} else {
echo '
<div class="story">

</div>
</div>
<!--end content -->

<!--end navbar -->
<div id="siteInfo"><div align="right"><button  onclick="javascript:window.open(\'install_s4.php\', \'_self\')" value="next" ><h1>Next 4/8</h1></button></div></div>
<br />
<div id="b_left_bar"><img src="../incl/php.gif" width="70" alt="w3c-valid" /></div>
<div id="botbar"><img src="../incl/valid.png" width="70" alt="w3c-valid" /></div>
<div id="b_right_bar"><img src="../incl/mysql.gif" width="70" alt="w3c-valid" /></div>
</body>
</html>';
}
?>
