<?php
session_start();

include("includes/db.php");

$uid=$_SESSION["id"]; 

if($_POST['user_id'])
{
$user_id=$_POST['user_id'];
$user_id = mysql_escape_String($user_id);


$sql_in = mysql_query("DELETE from follow_user Where uid_fk='$uid' and following_uid='$user_id'");

}

?>