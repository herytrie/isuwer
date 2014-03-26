
<?php

error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/FbWall.php';
include_once 'includes/tolink.php';
include_once 'includes/textlink.php';
include_once 'includes/htmlcode.php';
include_once 'includes/time_stamp.php';
include_once 'session.php';

$FbWall = new FbWall();
if(isSet($_POST['comment']))
{
$comment=$_POST['comment'];
$comment=str_replace("\n",'<br/>',$comment);
$comment=mysql_real_escape_string($_POST['comment']);

$msg_id=$_POST['msg_id'];
$ip=$_SERVER['REMOTE_ADDR'];
$cdata=$FbWall->Insert_Comment($uid,$msg_id,$comment,$ip);
if($cdata)
{
$com_id=$cdata['com_id'];
 $comment=tolink($cdata['comment'] );
 $time=$cdata['created'];
 $username=$cdata['fullname'];
 $userid=$cdata['uid_fk'];
 $cface=$FbWall->Gravatar($userid);

 ?>
<div class="stcommentbody" id="stcommentbody<?php echo $com_id; ?>">
<div class="stcommentimg">
<img src="<?php echo $cface; ?>" class='small_face' alt='<?php echo $username; ?>'/>
</div> 
<div class="stcommenttext">
<?php
if($userid==$uid)
{ ?>
<a class="stcommentdelete" href="#" id='<?php echo $com_id; ?>'></a>
<?php } ?>
<b><a href="profile.php?id=<?php echo $userid; ?>"><?php echo $username; ?></a></b> <?php echo clear($comment); ?>
<div class="stcommenttime"><?php time_stamp($time); ?></div> 
</div>
</div>
<?php
}
}
?>
