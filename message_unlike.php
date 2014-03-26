<?php

include("session.php");
include("includes/db.php");


if($_POST['unlike_id'])
{
$unlike_id=$_POST['unlike_id'];
$unlike_id = mysql_escape_String($unlike_id);


$uid_sql=mysql_query("select * from likes where msg_id_fk='$like_id' and uid_fk='$uid'");
$count=mysql_num_rows($uid_sql);

$sql_out=mysql_query("DELETE from likes WHERE msg_id_fk=$unlike_id and uid_fk=$uid");


}
?>