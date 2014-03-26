<?php

include("session.php");
include("includes/db.php");


if($_POST['like_id'])
{
$like_id=$_POST['like_id'];
$like_id = mysql_real_escape_String($like_id);

$sql_in=mysql_query("INSERT into likes (msg_id_fk,uid_fk) values ('$like_id','$uid')");

$uid_sql=mysql_query("select * from likes where msg_id_fk='$like_id' and uid_fk='$uid'");
$count=mysql_num_rows($uid_sql);

if($count ==1)
{
echo "<div class='like_bar'><img src='icons/like.png' class='pos'>&nbsp;1 person likes this.</div>";
}
else
{
echo "<div class='like_bar'><img src='icons/like.png' class='pos'>&nbsp;$count people like this.</div>";
}

}
?>