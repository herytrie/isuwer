<?php
session_start();
include ("includes/db.php");

$fullname=$_POST['fullname'];
$email=$_POST['email'];
$password = md5($_POST['password']);
$tgl      = $_POST['tgl'];
$bln      = $_POST['bulan'];
$thn      = $_POST['tahun'];
$tanggal  = "$thn-$bln-$tgl";
$default_img="default.jpg";
$api	= md5(uniqid(rand()));


if(!empty($email)&& !empty($password)&& !empty($fullname))

{


	$command="select * from users WHERE email='".$email."'";
	$result=mysql_query($command);
	$count=mysql_num_rows($result);
	if($count==0)
		{

		$command="INSERT into users(fullname,birth,password,email,cover_img,api) values('$fullname','$tanggal','$password','$email','$default_img','$api')";
		echo "$command";
		$result=mysql_query($command);
		mkdir("photo/$uid/foto", 0755);
	
			if($result)
			{ 
			$sql=mysql_query("SELECT * from users where email='$email'");
			while($row=mysql_fetch_row($sql))
				{
					$fullname=ucwords($row[1]);

					$_SESSION["id"]=$row[0];
					$_SESSION["fullname"]=$fullname;
					header("location:home.php");
				}

			}	
			else 
			{
			echo "not saved";
			}

		}

		else
		{
		header("location:index.php?status=conflict");

		}




}

else

{
header("location:index.php?status=fail");
}

?> 

