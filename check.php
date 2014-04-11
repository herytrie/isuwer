<?php
session_start();
include ("includes/db.php");

$email=$_POST['email'];
$password=md5($_POST['password']);

if(!empty($email) && !empty($password))

{

	$command="select * from users WHERE email='".$email."' and password='".$password."'";
	$result=mysql_query($command);
	$count=mysql_num_rows($result);
	if($count==0)
	{
		header("location:index.php?attempt=fail");
	}
	else
	{
	$sql="select * from users WHERE email='".$email."'";
	$result=mysql_query($sql);
	while($row=mysql_fetch_row($result))
		{
			$fullname=ucwords($row[1]);
			$_SESSION["id"]=$row[0];
			$_SESSION["fullname"]=$fullname;
			header("location:home.php");
		}
	}

}

else
{
header("location:index.php?attempt=null");
}
?>