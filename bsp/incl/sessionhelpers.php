<?php
require("global.php");

function check_user($name, $pass)
{
    $sql="SELECT `UserId` FROM `users` WHERE `UserName` = '".$name."' AND `UserPass`= MD5('".$pass."')
    LIMIT 1";
    $result= mysql_query($sql) or die(mysql_error());
    if ( mysql_num_rows($result)==1)
    {
        $user=mysql_fetch_assoc($result);
        return $user['UserId'];
    }
    else
        return false;
}

function login($userid)
{
    $sql="UPDATE `users` SET `UserSession` = '".session_id()."' WHERE `UserId` = ".$userid;
     mysql_query($sql);
}

function logged_in()
{
    $sql="SELECT `UserId` FROM `users` WHERE `UserSession` = '".session_id()."' LIMIT 1";
    $result= mysql_query($sql);
      return ( mysql_num_rows($result)==1);
}

function is_admin()
{
    $sql="SELECT `UserId` FROM `users` WHERE `UserSession` = '".session_id()."' AND `UserGroup` = 'admin' LIMIT 1";
    $result= mysql_query($sql);
      return ( mysql_num_rows($result)==1);
}

function active_user()
{
    $sql="SELECT `UserName` FROM `users` WHERE `UserSession` = '".session_id()."'";
    $result= mysql_fetch_array(mysql_query($sql));
      return ( $result['UserName']);
}

function logout()
{
    $sql="UPDATE `users` SET `UserSession` = NULL WHERE `UserSession` = '".session_id()."'";
     mysql_query($sql);
}

//connect();
?>
