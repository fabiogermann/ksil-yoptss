<?php
$background = setcolor('body_bg');
$link_text = setcolor('a_link');
$link_bg = setcolor('a_hover');
$text_h1 = setcolor('h1');
$mh_bg = setcolor('masterhead_bg');
$text_col = setcolor('body_col');

echo '<style type="text/css">
<!--
/***********************************************/
/* YOP STYLE SHEET                             */
/***********************************************/ 

body{
	font-family: Arial,sans-serif;
	color: '.$text_col.';
	line-height: 1.166;	
	margin: 0px;
	padding: 0px;
	background-color: '.$background.';
}

a:link, a:visited, a:hover {
	color: '.$link_text.';
	text-decoration: none;
}

a:hover {
	text-decoration:none;
	background-color: '.$link_bg.';
}

h1, h2, h3, h4, h5, h6 {
	font-family: Arial,sans-serif;
	margin: 0px;
	padding: 0px;
}

h1{
 font-family: Verdana,Arial,sans-serif;
 font-size: 120%;
 color: '.$text_h1.';
}

h2{
 font-size: 114%;
 color: #006699;
}

h3{
 font-size: 100%;
 color: #334d55;
}

h4{
 font-size: 100%;
 font-weight: normal;
 color: #333333;
}

h5{
 font-size: 100%;
 color: #009900;
}

h6{
	font-size: 100%;
	color: #CC0000;
}
				

/***********************************************/
/* DIV                                         */
/***********************************************/

#masthead{
	margin: 0;
	padding: 10px 0px;
	border-bottom: 1px solid #cccccc;
	background-color: '.$mh_bg.';
	width: 100%;
}

#navBar{
	margin: 0 79% 0 0;
	padding: 0px;
	background-color: #eeeeee;
	border-right: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
}

#content{
  float:right;
	width: 90%;
	margin: 0;
	padding: 0 3% 0 0;
}


#siteName{
	margin: 0px;
	padding: 0px 0px 10px 10px;
}



#pageName{
	padding: 0px 0px 10px 10px;
}


#globalNav{
color: #cccccc;
padding: 0px 0px 0px 10px;
white-space: nowrap;
}

#globalNav img{
 display: block;
}

#globalNav:hover
{
background-color: '.$mh_bg.';
}

#globalNav a {
	font-size: 90%;
	padding: 0px 4px 0px 0px; 
}

#botbar {
        position: fixed;
        top: 95%;
        left: 50%;
}

#b_left_bar {
        position: fixed;
        top: 95%;
        left: 25%;
}

#b_right_bar {
        position: fixed;
        top: 95%;
        left: 75%;
}

#topbar {
        position: fixed;
        top: 95%;
        left: 50%;
}

.headline {
          position: fixed;
          top: 10%;
}

.story{
	clear: both;
	padding: 10px 0px 0px 10px;
	font-size: 80%;
}

.story p{
	padding: 0px 0px 10px 0px;
}

#navBar ul a:link, #navBar ul a:visited {display: block;}

#navBar ul {list-style: none; margin: 0; padding: 0;}

#navBar li {border-bottom: 1px solid #EEE;}

.hht{
     height: 120px;
}

.tbcol{
       height: 243px;
}

/***********************************/
/* MESSAGE BOX STYLES BY SAMUEL    */
/***********************************/
.sucess, .error
{
 font-size: large;
 color: green;
 font-weight: bold;
 text-align:center;
 padding: 0;
 padding-top: 20px;
 background: #333839;
 
 position: fixed;
 top: 50%;
 left: 50%;
 width: 20em;
 height: 3em;
 margin-top: -4em;
 margin-left: -10em;
 
 visibility:visible;
 border: 1px solid #ccc;
}

* html .sucess
{
 width: 350px;
 height: 130px;
}

.error
{
 color: red;
}

* html .error
{
 width: 350px;
 height: 130px;
}

a.sucess, a.error
{
 position: fixed;
 width: 12em;
 height: 1.6em;
 top: 50%;
 left: 50%;
 margin-top: 2.4em;
 margin-left: -6em;
 
 padding: 0;
 padding-top: 0.5em;
 text-align:center;
 font-size: large;
 text-decoration: none;
 background: #f2f2f2;
}
*html a.sucess
{
	width: 230px;
  height: 40px;
	left: 40%;
}
* html a.error
{
  width: 230px;
	height: 40px;
	left: 40%;
}

//////OTHER

.style2 {font-size: 24px}
.style3 {font-size: x-small}
-->
</style>';
?>
