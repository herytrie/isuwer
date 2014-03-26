<?php
include ("session.php");
include ("includes/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link href="css/wtfdiary.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="icons/FB.png" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/follow_user.js"></script>

<title>All Users</title>
</head>
<body>
<div id="container">

<?php include ("includes/nav_bar.php");?>

<div><h2>Users</h2></div><hr/>
<?php
$result=mysql_query("select count(*) from users");
$row=mysql_fetch_row($result);
$tr=$row[0];
$rpp=10;  

$pn=1;

if(isset($_GET['pn']))
{
  $pn=$_GET['pn'];
}
$tp=($tr/$rpp);

if($tr%$rpp>0)
{
 $tp++;
}
$from=(($pn-1)*$rpp)+1;
$to=($pn)*($rpp);
$result=mysql_query("select * from users where uid between $from and $to");
while($row=mysql_fetch_row($result))
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
echo "<ul id='pages'>";
for($i=1;$i<=$tp;$i++)
{
echo "<li><a href='show_user.php?pn=$i'>$i</a></li>";
}
echo "</ul>";

?>


<div class="info">
<hr></hr>
<div style='margin-top:5px;'>&copy; Testian's | <b><a href='#'>Send Your Testimonials</a></div>
</div>
</body>
</html>