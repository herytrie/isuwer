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
$profile_uid=$_GET['id'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="icon" type="image/png" href="icons/FB.png" />
<link href="css/tipsy_title.css" rel="stylesheet" type="text/css">
<link href="css/facybox.css" rel="stylesheet" type="text/css">
<link href="css/wtfdiary.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/wall.js"></script>
<script type="text/javascript" src="js/jquery.oembed.min.js"></script>
<script type="text/javascript" src="js/jquery.wallform.js"></script>
<script type="text/javascript" src="js/jquery.webcam.js"></script>
<script type="text/javascript" src="js/jquery.color.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/facybox.js"></script>
<script type="text/javascript" src="js/facybox_ext.js"></script>
<script type="text/javascript" src="js/follow_user.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("#hint_msg").fadeOut(7000);
});
</script>

<script type="text/javascript">
	$(function() {
		
		$('#south').tipsy({gravity: 's'});
		$('#east').tipsy({gravity: 'e'});
		$('#west').tipsy({gravity: 'w'});
		
	});
</script>

<script type="text/javascript">
 jQuery(function($){
   });
 
$(function() 
{
$("#update").focus(function()
{
$(this).animate({"height": "50px",}, "fast" );
$("#button_bar").slideDown("fast");
return false;
});

});
</script>

<script>

$(function() {

$(".like_button").click(function() 
{

var like_id = $(this).attr("id");
var dataString = 'like_id='+ like_id ;

$(".loading_image"+like_id).fadeIn(200).html('<img src="icons/loader.gif" />');


$.ajax({
   type: "POST",
   url: "message_like.php",
   data: dataString,
   cache: false,

   success: function(html)
   {
    $("#like"+like_id).hide();
    $("#unlike"+like_id).show();
    $(".loading_image"+like_id).hide();
    $(".like_show"+like_id).html(html);
  
  }  });
   

return false;
	});

});

</script>

<script>

$(function() {

$(".unlike_button").click(function() 
{

var unlike_id = $(this).attr("id");
var dataString = 'unlike_id='+ unlike_id ;

$(".loading_image"+unlike_id).fadeIn(200).html('<img src="icons/loader.gif" />');


$.ajax({
   type: "POST",
   url: "message_unlike.php",
   data: dataString,
   cache: false,

   success: function(html)
   {
    $("#unlike"+unlike_id).hide();
    $("#like"+unlike_id).show();
    $(".loading_image"+unlike_id).hide();
  
  }  });
   

return false;
	});

});

</script>


<title>

<?php 

$sql="select * from users WHERE uid= '$profile_uid' ";
$result=mysql_query($sql);
$exist=mysql_num_rows($result);
if($exist==0)
{
echo "</title>";
echo "<body>";
echo "<div>Sorry this Profile doesn't Exist</div>";
echo "</body>";
echo "</html>";
}
else
{
$user_info=mysql_fetch_row($result);
$fullname=ucwords($user_info[1]);
$email=strtolower($user_info[3]);
$cover_img=$user_info[5];
$imgcode=md5($email);
$img_link="http://www.gravatar.com/avatar/$imgcode?s=80";
echo "$fullname";
}
?>

</title>
</head>

<body>
<div id="container">

<?php include("includes/nav_bar.php");?>

<div id='cover_container' style="background:url('cover_img/<?php echo $cover_img; ?>');">
<div id='info_box'>
<div id="profile_img">
<?php 
  // Ambil gambar profile
	$query_profil = mysql_query("SELECT photo_profil,fullname 
                  FROM `users` WHERE uid='$profile_uid'");
	$row=mysql_fetch_array($query_profil);
	if ($row['photo_profil'] != NULL) {
	    $image = "photo/$profile_uid/$row[photo_profil]";
	}
	else{
		  $image="photo/default.png";
	}
	?>
	<img src="<?php echo $image;?>">




</div>



<div id="info-box">
<div id="info-name"><b><?php echo $fullname;?></b></div>
<div id="info-content">
<div style="float:right">
<?php
if($uid==$profile_uid)
{
echo "<div><a href='change_cover.php'><img src='icons/cameraa.png' id='south' title='Change Cover Picture'/></a></div>";
}
else
{
$f_command="select * from follow_user WHERE uid_fk='$uid' and following_uid='$profile_uid' ";
$user_sql=mysql_query($f_command);
$count=mysql_num_rows($user_sql);
if($count==0)
{
echo "<div id='follow$profile_uid'><a href='' class='follow' id='$profile_uid'><span class='follow_btn'> Follow </span></a></div>";
echo"<div id='remove$profile_uid' style='display:none'><a href='' class='remove' id='$profile_uid'><span class='following_btn'> Following </span></a></div>";
}
else
{
echo "<div id='follow$profile_uid' style='display:none'><a href='' class='follow' id='$profile_uid'><span class='follow_btn'> Follow </span></a></div>";
echo"<div id='remove$profile_uid'><a href='' class='remove' id='$profile_uid'><span class='following_btn'> Following </span></a></div>";
}
}
?>
</div>
<div id="info-photos">
<div>Photos</div>
<?php
$photo_sql=mysql_query("Select * from user_uploads where uid_fk=$profile_uid");
$photo_count=mysql_num_rows($photo_sql);
?>
<div><a href='photo.php?id=<?php echo $profile_uid; ?>'><b><?php echo $photo_count ; ?></b></a></div>
</div>

<div id="info-friends">
<div>Friends</div>
<?php
$friend_sql=mysql_query("Select * from follow_user where uid_fk=$profile_uid");
$friend_count=mysql_num_rows($friend_sql);
?>
<div><a href='friend.php?id=<?php echo $profile_uid; ?>'><b><?php echo $friend_count; ?></b></a></div>
</div>

</div>
</div>

<div style='clear:both'></div>

</div>
</div>

<div id="wall_container">

<?php
if($uid==$profile_uid)
{
include("includes/update_box.php");
}


else if($count==0)
{
?>
<br/>
<div id="hint_msg">
Follow <a href='profile.php?id=<?php echo $profile_uid;?>'><?php echo $fullname?></a> to write on his Wall.
</div>
<div id="profile_textarea" style='display:none;'>
<?php include("includes/update_box.php");?>
</div>

<?php
}
else
{
?>

<div id="profile_textarea">
<?php include("includes/update_box.php");?>
</div>
<?php
}
?>

<div id='flashmessage'>
<div id="flash" align="left"  ></div>
</div>
<div id="content">


<?php
$user_ids=$profile_uid;
include("load_messages.php");
?>

</div>

<div class="info">
<hr></hr>
<div style='margin-top:5px;'>&copy; Testian's | <b><a href='#'>Send Your Testimonials</a></div>

</div>
</div>
</body>
</html>




