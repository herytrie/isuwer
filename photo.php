<?php 
include_once 'session.php';

error_reporting(0);
include_once 'includes/db.php';

$profile_uid=$_GET['id'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/facybox.js"></script>
<script type="text/javascript" src="js/facybox_ext.js"></script>

<link rel="icon" type="image/png" href="icons/FB.png" />
<link href="css/wtfdiary.css" rel="stylesheet" type="text/css">
<link href="css/facybox.css" rel="stylesheet" type="text/css">

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
$cover_img=$user_info[4];
$imgcode=md5($email);
$img_link="http://www.gravatar.com/avatar/$imgcode?s=50";
echo "$fullname - Photo Album";
}
?>

</title>
</head>

<body>
<div id="container">

<?php include("includes/nav_bar.php");

$photo_sql=mysql_query("Select * from user_uploads where uid_fk=$profile_uid");
$photo_count=mysql_num_rows($photo_sql);
?>

<div id="album_infobar">
<div id="aib_left"><img src="<?php echo $img_link; ?>"></div>
<div id="aib_right">
<div><a href="profile.php?id=<?php echo $profile_uid; ?>"><b><?php echo $fullname; ?></a>'s Photo Album</b></div>
<div style="margin-top:5px;"><b><?php echo $photo_count; ?></b> Photo in the Album</div>
</div>
</div>

<?php
if($photo_count==0)
{
echo "<div id='photo-album'><div><p>No Photos in the Album !</p></div></div>";
}
else
{
echo "<div id='photo-album'>";
while($photo_data=mysql_fetch_row($photo_sql))
{
$img_path="uploads/$photo_data[1]";

?>

<div><p><a href="<?php echo $img_path;?>" rel="facybox"><img src="<?php echo $img_path;?>" class='album_pic'/></a></p></div>		

<?php
}
echo "</div>";
}
?>


<div class="info">
<hr></hr>
<div style='margin-top:5px;'>&copy; Testian's | <b><a href='#'>Send Your Testimonials</a></div>
</div>
</div>
</body>
</html>




