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

$profile_uid=$uid;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="icon" type="image/png" href="icons/FB.png" />
<link href="css/tipsy_title.css" rel="stylesheet" type="text/css">
<link href="css/facybox.css" rel="stylesheet" type="text/css">
<link href="css/wtfdiary.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.oembed.min.js"></script>
<script type="text/javascript" src="js/jquery.wallform.js"></script>
<script type="text/javascript" src="js/jquery.webcam.js"></script>
<script type="text/javascript" src="js/jquery.color.js"></script>
<script type="text/javascript" src="js/wall.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/facybox.js"></script>
<script type="text/javascript" src="js/facybox_ext.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("#hint_msg").fadeOut(7000);
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

<script type="text/javascript">
	$(function() {
		$('#south').tipsy({gravity: 's'});
		$('.stdelete').tipsy({gravity: 's'});
		$('#east').tipsy({gravity: 'e'});
		$('#west').tipsy({gravity: 'w'});
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

<title>Testian's - Send Your Testimonials</title>
</head>
<body>

<div id="container">

<?php include ("includes/nav_bar.php");?>

<div id="wall_container">

<div id="updateboxarea">
<div style="margin-bottom:5px;font-weight:bold;"><img src="icons/2.png">&nbsp;Update Status</div>
<textarea name="update" id="update" maxlength="200" placeholder="What's on your mind ?" title="What's on your mind ?"></textarea>
<br />
<div id="webcam_container" class='border'>
<div id="webcam" >
</div>
<div id="webcam_preview">

</div>

<div id='webcam_status'></div>
<div id='webcam_takesnap'>

<input type="button" value=" Take Snap " onclick="return takeSnap();" class="camclick button"/>
<input type="hidden" id="webcam_count" />
</div>
</div>
<div  id="imageupload" class="border">
<form id="imageform" method="post" enctype="multipart/form-data" action='image_ajax.php'> 
<div id='preview'>
</div>

<span id='addphoto'>Add Photo:</span> <input type="file" name="photoimg" id="photoimg" />
<input type='hidden' id='uploadvalues' />
</form>
</div>
<div id="button_bar" style="width:100%;clear:both;">
<input type="submit"  value=" Update "  id="update_button"  class="update_button" rel="<?php echo $profile_uid; ?>"/> 
<span style="float:right">
<a href="javascript:void(0);" id="camera"><img src="icons/cameraa.png" id="east" border="0" title="Upload Image"/></a> 
<a href="javascript:void(0);" id="webcam_button"><img src="icons/web-cam.png" id="south" border="0" title="Webcam Snap" style='margin-top:5px'/></a>
</span>
</div>

</div>


<?php 

$sql="select * from follow_user WHERE uid_fk='$uid'";
$sql_count=mysql_query($sql);
$count=mysql_num_rows($sql_count);
if($count==0)
{
echo "<div id='hint_msg'>";
echo "You are not Following any user. Go to <a href='show_user.php'>User's List</a>";
echo "</div>";
?>
<div id='flashmessage'>
<div id="flash" align="left"  ></div>
</div>
<div id="content">

<?php
$user_ids=$uid;
include('load_messages.php');
}
else
{
$n=0; 
$user_follow = array();
$command = "SELECT * from follow_user WHERE uid_fk=$uid";
$result=mysql_query($command);
while($row=mysql_fetch_row($result))
{

$user_follow[$n]="$row[2]";
$n++;

}
$user_follow[$n]="$uid";

$user_ids = implode(',',$user_follow);
?>
<div id='flashmessage'>
<div id="flash" align="left"  ></div>
</div>
<div id="content">
<?php
include('load_messages.php'); 
}
?>

</div>

<div class="info">
<hr></hr>
<div style='margin-top:5px;'>&copy; Testian's | <b><a href='#'>Send Your Testimonials</a></div>
</div>

</div>

</div>
</body>
</html>
