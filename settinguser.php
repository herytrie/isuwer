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
    
	<title>
<?php 
$sql="select * from users WHERE uid= '$profile_uid' ";
$result=mysql_query($sql);
$exist=mysql_num_rows($result);
if($exist==0)
{
echo "<html>";
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

	
	    <?php
		if($_POST['kirim'] == "Simpan")
	{
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		
		$sql = "UPDATE users SET fullname ='$fullname', email = '$email' WHERE uid = '$uid'";
			mysql_query($sql);

			if(mysql_errno() == 0)
			{
				echo"<script>alert('Data berhasil diupdate !');</script>";
			}else{
				echo"<script>alert('Data gagal diupdate !');</script>";
			}
		
	}
	
	// $sqldata = "SELECT * FROM users WHERE uid = '$uid'";
	// $result = mysql_query($sqldata);
	// if(mysql_num_rows($result) > 0)
	// {
		// while($data = mysql_fetch_array($result))
		// {
			// $uid = $data['uid'];
			// $fullname = $data['fullname'];
			// $email = $data['email'];
		// }
	// }
		
		
	$query=mysql_fetch_array(mysql_query("select * from users where uid='$uid'"));
	$fullname=$query['fullname'];
	$email=$query['email'];
	// $gender=$query['gender'];
	// $tanggal=$query['birth'];

	// $religion=$query['religion'];
	// $status=$query['status'];
	// $address=$query['address'];
	// $activity=$query['activity'];
	// $hobby=$query['hobby'];
	
	// $aksi="savesetting.php";
// switch($_GET[aksi]){	
	// case "default":
	?>
	<form method='post' action="">
	
	<div id='wall_container'>
	
    <table width='399' border='0'>
    <tr>
      <td width='113'>Full Name</td>
      <td width='1'>&nbsp;</td>
      <td width='271'><input type='text' name='fullname' value="<?php echo"$fullname"; ?>" size='30'/></td>
    </tr>
	<tr>
      <td width='113'>Email</td>
      <td width='1'>&nbsp;</td>
      <td width='271'><input type='text' name='email' value="<?php echo"$email"; ?>" size='30'/></td>
    </tr>
    <tr>
      <td colspan='3'><p></p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type='submit' value='Simpan' name='kirim' /></td>
    </tr>
    </table>
    
    </form>
	</div>
	
</body>
</html>