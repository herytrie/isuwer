<?php
 
if(isSet($lastid))
{
$lastid=$lastid;
}
else
{
$lastid=0;
}

//Image query for Image in comment container (Sliding down)

$img_query=mysql_query("Select email from users where uid='$uid'");
$email_value=mysql_fetch_row($img_query);
$lower_email=strtolower($email_value[0]);
$image=md5($lower_email);
$comm_face="http://www.gravatar.com/avatar/$image?s=50";

$updatesarray=$FbWall->Updates($user_ids,$lastid);
$total=$FbWall->Total_Updates($user_ids);
if($updatesarray)
{
foreach($updatesarray as $data)
 {
 $msg_id=$data['msg_id'];
 $orimessage=$data['message'];
 $message=tolink($data['message']);
  $time=$data['created'];
 $username=$data['fullname'];
  $uploads=$data['uploads'];
 $userid=$data['uid_fk'];
 $profileid=$data['profile_uid'];
 $face=$FbWall->Gravatar($userid);
 if(textlink($orimessage))
 {
 $link =textlink($orimessage);
?>

<?php } ?>
<div class="stbody" id="stbody<?php echo $msg_id;?>">

<div class="stimg">
<img src="<?php echo $face;?>" class='big_face' alt='<?php echo $username; ?>'/>
</div> 
<div class="sttext">
<?php
if($userid==$uid)
{ ?>
<a class="stdelete" href="#" id="<?php echo $msg_id;?>" title='Delete Update'></a>
<?php } ?>

<b>
<?php 
if($userid==$profileid)
{
echo "<a href='profile.php?id=$userid'>$username</a>";
}
else
{
$p_name=mysql_query("select fullname from users where uid='$profileid'");
$name_value=mysql_fetch_row($p_name);
echo "<a href='profile.php?id=$userid'>$username</a> &nbsp;<span class='arrow-e'></span> <a href='profile.php?id=$profileid'>$name_value[0]</a>";
}

?> 

</b><?php echo clear($message);  ?> 

<?php
 if($uploads)
{
echo "<div style='margin-top:10px'>";
$s = explode(",", $uploads);
foreach($s as $a)
{
$newdata=$FbWall->Get_Upload_Image_Id($a);
if($newdata)
echo "<a href='uploads/".$newdata['image_path']."' rel='facybox'><img src='uploads/".$newdata['image_path']."' class='imgpreview'/></a>";
}
echo "</div>";
 }
 
echo "<div class='sttime'>";

$like_query=mysql_query("SELECT * from likes where msg_id_fk=$msg_id and uid_fk=$uid");
$likes_count = mysql_num_rows($like_query);
if($likes_count == 0)
{
?>
<span id="like<?php echo $msg_id ;?>"><a href='#' class='like_button' id='<?php echo $msg_id;?>' title='Like'>Like</a> </span>
<span id="unlike<?php echo $msg_id ;?>" style="display:none;"><a href='#' class='unlike_button' id='<?php echo $msg_id;?>' title='Unlike'>Unlike</a> </span>
<?php
}
else
{
?>
<span id="like<?php echo $msg_id ;?>" style="display:none;"><a href='#' class='like_button' id='<?php echo $msg_id;?>' title='Like'>Like</a> </span>
<span id="unlike<?php echo $msg_id ;?>"><a href='#' class='unlike_button' id='<?php echo $msg_id;?>' title='Unlike'>Unlike</a> </span>
<?php
}
?>

 | <a href='#' class='commentopen' id='<?php echo $msg_id;?>' title='Comment'>Comment</a>  | <?php time_stamp($time);?> &nbsp;&nbsp; 
<span class="loading_image<?php echo $msg_id; ?>"></span></div> 
<div id="stexpandbox">
<div id="stexpand<?php echo $msg_id;?>">
<?php
if(textlink($orimessage))
{
$link =textlink($orimessage);
echo Expand_URL($link);
}
?> 
</div>
</div>

<div class="like_show<?php echo $msg_id; ?>">
<?php
$like_query=mysql_query("SELECT * from likes where msg_id_fk=$msg_id");
$likes_count = mysql_num_rows($like_query);
if($likes_count == 0)
{
}
elseif($likes_count==1)
{
echo "<div class='like_bar'><img src='icons/like.png' class='pos'>&nbsp;$likes_count person likes this.</div>";
}
else
{
echo "<div class='like_bar'><img src='icons/like.png' class='pos'>&nbsp;$likes_count people like this.</div>";
}
?>
</div>

<div class="commentcontainer" id="commentload<?php echo $msg_id;?>">
<?php
$x=1;
include('load_comments.php') ?>
</div>
<div class="commentupdate" style='display:none' id='commentbox<?php echo $msg_id;?>'>
<div class="stcommentimg">
<img src="<?php echo $comm_face;?>" class='small_face'/>
</div> 
<div class="stcommenttext" >
<form method="post" action="">
<textarea name="comment" class="comment" maxlength="200"  id="ctextarea<?php echo $msg_id;?>"></textarea>
<br />
<input type="submit"  value=" Comment "  id="<?php echo $msg_id;?>" class="comment_button button"/>
</form>
</div>
</div>
</div> 
</div>
<?php
  }
  if($total>$postcount)
  {
  ?>
 <!-- More Button here $msg_id values is a last message id value. -->
 
<div id="more<?php echo $msg_id; ?>" class="morebox">
<a href="#" class="more" id="<?php echo $msg_id; ?>" rel="<?php echo $user_ids;?>">More</a>
</div>

  <?php
  }
  }
?>