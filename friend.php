<?php
include ("session.php");
include ("includes/db.php");

if(isset($_GET["id"]))
{
$profile_uid=$_GET["id"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link href="css/wtfdiary.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="icons/FB.png" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/follow_user.js"></script>
<script type="text/javascript" src="js/wall.js"></script>
</head>


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
echo "$fullname - Friend List";

?>

</title>


<body>
<div id="container">

<?php include ("includes/nav_bar.php");?>

<div><h3><a href="profile.php?id=<?php echo $profile_uid;?>"><?php echo "$fullname";?></a>'s Friends</h3></div><hr/>

<div id="content">
<?php include("load_friends.php");?>
</div>

<div class="info">
<hr></hr>
<div style='margin-top:5px;'>&copy; Testian's | <b><a href='#'>Send Your Testimonials</a></div>
</div>

</div>
</body>
</html>

<?php
}
?>