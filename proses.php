<?php
include"includes/db.php";

$uid=$_POST[uid]; // membuat variabel untuk isi dari data base
$fullname=$_POST[fullname];
$email=$_POST[email];

$pilih=$_GET[pilih];
switch($pilih){  // memilih proses dengan switch
	case "ubah"	  : mysql_query("update users set fullname='$fullname', email='$email' where uid='$uid'");break;
}
header("location:index.php");	
?>