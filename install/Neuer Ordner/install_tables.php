<?php

require_once("global.php");

$confirm = $_POST['best'];

if($confirm == 42)
{
mysql_query("CREATE TABLE `subcat` (nr VARCHAR (20), subcat VARCHAR (20))");
mysql_query("CREATE TABLE `items` (id MEDIUMINT NOT NULL AUTO_INCREMENT, display VARCHAR (20), subcat VARCHAR(20), thumb VARCHAR(20), anz VARCHAR(20))");
mysql_query("CREATE TABLE `itm_count` (timespamp VARCHAR (20))");
mysql_query("CREATE TABLE `itm_vp` (timespamp VARCHAR (20), id VARCHAR (20), 0p VARCHAR (20), vp VARCHAR (20))");
mysql_query("CREATE TABLE `used` (timestamp VARCHAR (20))");
mysql_query("CREATE TABLE `bought` (timestamp VARCHAR (20), name VARCHAR (20), preis VARCHAR (20), menge VARCHAR (20), id VARCHAR (20))");
mysql_query("CREATE TABLE `ingr` (id MEDIUMINT NOT NULL AUTO_INCREMENT, display VARCHAR (20))");
mysql_query("CREATE TABLE `stk` (timestamp VARCHAR (20))");

mysql_query('CREATE TABLE `itm_strc` ('
        . ' `id` MEDIUMINT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, '
        . ' `display` VARCHAR(20) NOT NULL'
        . ' )'
        . ' ENGINE = myisam;');
		
mysql_query('INSERT INTO `yop`.`itm_strc` (`id`, `display`) VALUES (NULL, \'id\');');
mysql_query('INSERT INTO `yop`.`itm_strc` (`id`, `display`) VALUES (NULL, \'display\');');
mysql_query('INSERT INTO `yop`.`itm_strc` (`id`, `display`) VALUES (NULL, \'subcat\');');
mysql_query('INSERT INTO `yop`.`itm_strc` (`id`, `display`) VALUES (NULL, \'thumb\');');
mysql_query('INSERT INTO `yop`.`itm_strc` (`id`, `display`) VALUES (NULL, \'anz\');');
mysql_query('CREATE TABLE `empl` ('
        . ' `id` MEDIUMINT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, '
        . ' `name` VARCHAR(20) NOT NULL'
        . ' )'
        . ' ENGINE = myisam;');

mysql_query('CREATE TABLE `expn` ('
        . ' `id` MEDIUMINT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY, '
        . ' `name` VARCHAR(20) NOT NULL, '
        . ' `preis` VARCHAR(20) NOT NULL, '
        . ' `zweck` VARCHAR(200) NOT NULL, '
        . ' `note` TEXT NOT NULL'
        . ' )'
        . ' ENGINE = myisam;');
		
mysql_query('CREATE TABLE `items` ('
        . ' `id` MEDIUMINT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY, '
        . ' `display` VARCHAR(20) NOT NULL, '
        . ' `subcat` VARCHAR(20) NOT NULL, '
        . ' `thumb` VARCHAR(50) NOT NULL, '
        . ' `anz` VARCHAR(20) NOT NULL'
        . ' )'
        . ' ENGINE = myisam;');

 mysql_query('CREATE TABLE `ingr` ('
        . ' `id` MEDIUMINT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, '
        . ' `display` VARCHAR(20) NOT NULL'
        . ' )'
        . ' ENGINE = myisam;');
mysql_query('ALTER TABLE `used` ADD `user` VARCHAR(20) NOT NULL;');
mysql_query('ALTER TABLE `itm_count` ADD `user` VARCHAR(20) NOT NULL;');
mysql_query("CREATE TABLE users ( UserID int(11) PRIMARY KEY auto_increment, UserName varchar(30) NOT NULL default '', UserPass varchar(32) NOT NULL default '', UserSession varchar(32), UserMail varchar(150) NOT NULL default '', UserGroup VARCHAR( 30 ) NOT NULL default '', UNIQUE KEY NickName (`UserName`), UNIQUE KEY UserMail (`UserMail`) );");
mysql_query("INSERT INTO users SET UserName='admin', UserPass=MD5('tutorial'), UserMail='mrhappiness@inter.net', UserGroup='admin'");
mysql_query("CREATE TABLE `about` (`info` VARCHAR( 30 ) NOT NULL ,`content` VARCHAR( 50 ) NOT NULL) ENGINE = MYISAM");
mysql_query("INSERT INTO `about` (`info` ,`content`)VALUES ('pagename', 'party')");
mysql_query("INSERT INTO `about` (`info` ,`content`)VALUES ('url', 'http://yourpage.ch')");
mysql_query("INSERT INTO `about` (`info` ,`content`)VALUES ('organisation', 'organisation')");
mysql_query('ALTER TABLE `subcat` ADD PRIMARY KEY(`nr`)');
mysql_query('ALTER TABLE `itm_vp` ADD PRIMARY KEY(`id`)');
mysql_query('ALTER TABLE `subcat` CHANGE `nr` `nr` MEDIUMINT(20) NOT NULL AUTO_INCREMENT');
mysql_query('ALTER TABLE `itm_vp` CHANGE `id` `id` MEDIUMINT(10) NOT NULL AUTO_INCREMENT');
mysql_query('ALTER TABLE `itm_count` CHANGE `timespamp` `timestamp` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL');
mysql_query('CREATE TABLE `sold` ('
        . ' `id` MEDIUMINT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, '
        . ' `user` VARCHAR(30) NOT NULL, '
        . ' `item` VARCHAR(30) NOT NULL, '
        . ' `pcs` VARCHAR(30) NOT NULL, '
        . ' `price` VARCHAR(30) NOT NULL'
        . ' )'
        . ' ENGINE = myisam;');
mysql_query('ALTER TABLE `sold` ADD `timestamp` VARCHAR(30) NOT NULL AFTER `id`;');
mysql_query('CREATE TABLE `happyhour` ('
        . ' `name` VARCHAR(30) NOT NULL, '
        . ' `value` VARCHAR(30) NOT NULL'
        . ' )'
        . ' ENGINE = myisam;');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'status\', \'1\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_s_hour\', \'20\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_s_minute\', \'00\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_s_seconds\', \'00\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_s_day\', \'12\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_s_month\', \'4\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_s_year\', \'2008\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_e_hour\', \'21\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_e_minute\', \'00\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_e_seconds\', \'00\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_e_day\', \'12\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_e_month\', \'4\');');
mysql_query('INSERT INTO `happyhour` (`name`, `value`) VALUES (\'hh_e_year\', \'2008\');');

mysql_query("CREATE TABLE `colors` (`color` varchar(20) collate latin1_general_ci NOT NULL default '',`code` varchar(20) collate latin1_general_ci NOT NULL default '') ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;");
mysql_query("INSERT INTO `colors` VALUES ('tb_color1', '#00008B');");
mysql_query("INSERT INTO `colors` VALUES ('tb_color2', '#333839');");
mysql_query("INSERT INTO `colors` VALUES ('tb_color3', '#333839');");
mysql_query("CREATE TABLE `sets` (`set` varchar(20) collate latin1_general_ci NOT NULL default '',`act` binary(1) NOT NULL default '\0') ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;");
mysql_query("INSERT INTO `colors` VALUES ('body_bg', '#000000');");
mysql_query("INSERT INTO `colors` VALUES ('body_col', '#F5F5F5');");
mysql_query("INSERT INTO `colors` VALUES ('a_link', '#006699');");
mysql_query("INSERT INTO `colors` VALUES ('a_hover', '#ffcc33');");
mysql_query("INSERT INTO `colors` VALUES ('h1', '#FF7C2D');");
mysql_query("INSERT INTO `colors` VALUES ('masterhead_bg', '#00008B');");
mysql_query("INSERT INTO `sets` VALUES ('debugmode', 0x30);");
mysql_query("INSERT INTO `sets` VALUES ('border', 0x30);");
echo "<font class=\"sucess\">..Tables erfolgreich erstellt..<br>sie werden gleich weitergeleitet</font>";

}
else
{
echo "<font class=\"error\">..ERROR..<br>Vorgang fehlerhaft - Best&auml;tigung richtig ?</font>";
}



?>

<meta http-equiv="refresh" content="1.5; url=../index.php" />
<link rel="stylesheet" href="../style.css" type="text/css">
