<?php

if(isSet($last_fid))
{
$last_fid=$last_fid;
$loadmore="and fid<'$last_fid'";
}
else
{
$last_fid=0;
$loadmore='';
}



$total_friends=mysql_query("select * from follow_user where uid_fk=$profile_uid $loadmore");
$total_count=mysql_num_rows($total_friends);

$result=mysql_query("select * from follow_user where uid_fk=$profile_uid $loadmore order by fid desc LIMIT 10");
$row=mysql_num_rows($result);
if($row==0)
{
echo "<br/><div>No Friends</div>";
}

else
{
while($friends=mysql_fetch_row($result))
{
$fid=$friends[0];
$friend_id=$friends[2];
$data_result=mysql_query("select * from users where uid=$friend_id");
while($row=mysql_fetch_row($data_result))
{ 
$userid=$row[0];
$lowercase = strtolower($row[3]);
	
$image = md5($lowercase);

echo "<div class='userlist'>";
echo "<div class='userlist_img'><img src='http://www.gravatar.com/avatar/$image?s=50'/></div>";
echo "<div><div style='float:right;'>";

if($uid==$userid)
{
echo "<div>You !</div>";
}
else
{
$f_command="select * from follow_user WHERE uid_fk='$uid' and following_uid='$userid' ";
$user_sql=mysql_query($f_command);
$count=mysql_num_rows($user_sql);
if($count==0)
{
echo "<div id='follow$userid'><a href='' class='follow' id='$userid'><span class='follow_btn'> Follow </span></a></div>";
echo"<div id='remove$userid' style='display:none'><a href='' class='remove' id='$userid'><span class='following_btn'> Following </span></a></div>";
}
else
{
echo "<div id='follow$userid' style='display:none'><a href='' class='follow' id='$userid'><span class='follow_btn'> Follow </span></a></div>";
echo"<div id='remove$userid'><a href='' class='remove' id='$userid'><span class='following_btn'> Following </span></a></div>";
}

}

echo "</div>";
echo "<div class='userlist_body'><a href='profile.php?id=$userid'><b>$row[1]</b></a></div>";
echo "</div></div>";
} 
}
$last_fid=$fid;
}
if($total_count>10)
{
?>
<div id="more_frnd<?php echo $last_fid; ?>" class="morebox">
<a href="#" class="more_frnd" id="<?php echo $last_fid; ?>" rel="<?php echo $profile_uid;?>">More</a>
</div>
<?php
}
?>
