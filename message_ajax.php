<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
 
error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/FbWall.php';
include_once 'includes/tolink.php';
include_once 'includes/textlink.php';
include_once 'includes/htmlcode.php';
include_once 'includes/time_stamp.php';
include_once 'includes/Expand_URL.php';
include_once 'session.php';
$FbWall = new FbWall();
if(isSet($_POST['update']))
{
$update=$_POST['update'];
$update=str_replace("\n",'<br/>',$update);
$update=mysql_real_escape_string("$update");
$uploads=$_POST['uploads'];
$profile_uid=$_POST['profile_uid'];
$data=$FbWall->Save_Update($uid,$update,$uploads,$profile_uid);

if($data)
{
$msg_id=$data['msg_id'];
$orimessage=$data['message'];
$message=tolink($data['message']);
$time=$data['created'];
$userid=$data['uid_fk'];
$profileid=$data['profile_uid'];
$username=$data['fullname'];
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
<b><a href='profile.php?id=$userid'><?php echo $username;?></a></b> <?php echo clear($message);?>
<?php
 if($uploads)
{
echo "<div style='margin-top:10px'>";
$uploads_array=explode(',',$uploads);
$uploads=implode(',',array_unique($uploads_array));
$s = explode(",", $uploads);
foreach($s as $a)
{
 $newdata=$FbWall->Get_Upload_Image_Id($a);
 if($newdata)
echo "<img src='uploads/".$newdata['image_path']."' class='imgpreview'/>";
}
echo "</div>";
 }
  ?>
<div class="sttime"><a href='#' class='' id='<?php echo $msg_id;?>' title='Like'>Like </a> | <a href='#' class='commentopen' id='<?php echo $msg_id;?>' title='Comment'>Comment </a> | <?php time_stamp($time);?></div> 
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
<div class="commentcontainer" id="commentload<?php echo $msg_id;?>">
<?php// include('load_comments.php') ?>
</div>
<div class="commentupdate" style='display:none' id='commentbox<?php echo $msg_id;?>'>
<div class="stcommentimg">
<img src="<?php echo $face;?>" class='small_face'/>
</div> 
<div class="stcommenttext" >
<form method="post" action="">
<textarea name="comment" class="comment" maxlength="200"  id="ctextarea<?php echo $msg_id;?>"></textarea>
<br />
<input type="submit"  value=" Comment "  id="<?php echo $msg_id;?>" class="comment_button"/>
</form>
</div>
</div>
</div> 
</div>
<?php
}
}
?>
