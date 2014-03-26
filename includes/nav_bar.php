<?php
$img_query=mysql_query("Select uid,email from users where uid='$uid'");
$email_value=mysql_fetch_row($img_query);
$p=$email_value[0];
$lower_email=strtolower($email_value[1]);
$image=md5($lower_email);
$nav_face="http://www.gravatar.com/avatar/$image?s=20";
?>

<div id="nav_bar">

<div style="float:right;">
<table><tr><td><img src="<?php echo $nav_face;?>"/></td>
<td><a href="logout.php">Logout</a></td>
</tr></table>
</div>

<div style='width:400px;float:left;'>
<a href="home.php">Home</a>&nbsp;|&nbsp;

<a href="show_user.php">Users</a>&nbsp;|&nbsp;

<a href="profile.php?id=<?php echo $p; ?>">Profile</a>&nbsp;|&nbsp;

<a href="settinguser.php?id=<?php echo $p; ?>">Setting</a>
</div>


</div>