<?php
session_start();

include("includes/db.php");
include_once 'session.php'; 

if($_POST['user_id'])
{
$user_id=$_POST['user_id'];
$user_id = mysql_escape_String($user_id);


$sql_in = "INSERT into follow_user(uid_fk,following_uid) values ('$uid','$user_id')";
mysql_query( $sql_in);

}

?>