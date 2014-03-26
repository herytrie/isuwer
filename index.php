<?php
if(isset($_GET["attempt"]))
{
$attempt=$_GET["attempt"];
}

if(isset($_GET["status"]))
{
$status=$_GET["status"];
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Testian's - Send Your Testimonials</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.validate_2.js"></script>

<link rel="stylesheet" href="css/wtfdiary.css" type="text/css" />
</head>
<body background="bg.jpg">
<div class="index_container">
<div style="padding:5px;"><img src="icons/header.jpg" id="header"></div>

<div id="form_holder">

<div class="form_login">
<h3>Curious? Sign in fast.</h3>
<form action="check.php" method="POST">
<div>Email :</div>
<div><input type="text" name="email" class="input" placeholder="Email Address"></div><br/>
<div>Password :</div>
<div><input type="password" name="password" class="input" placeholder="Password"></div>
<div><input type="submit" value="Sign In" class="signin_btn"></div>
</form>

<?php
if(isset($attempt))
{
if($attempt == "null")
{
?>
<br/><div class="error_msg">Both Fields are required.</div>
<?php
}
elseif($attempt == "fail")
{
?>
<br/><div class="error_msg">Email and Password do not match.</div>

<?php
}
}
?>

</div>

<div class="form_signup">
<h3>Sign Up for Testian's</h3>
<form action="save_user.php" method="POST">
<div><input type="text" name="fullname" class="input" placeholder="Full Name"></div><br/>
<div><input type="text" name="email" class="input" placeholder="Email Address"></div><br/>
<div><input type="password" name="password" class="input" placeholder="Password"></div>
<label>Birthday :</label>
 <div class="input-container">
	  <?php
	    // Tampilkan pilihan tanggal dari 1 s/d 31 pada ComboBox
      echo "<select name=tgl id=tgl><option value=0>Tanggal:</option>";
	    for($tgl=1; $tgl<=31; $tgl++) {
      	echo "<option value=$tgl>$tgl</option>";
	    }
	    echo "</select>";

	    // Tampilkan pilihan bulan dalam format Indonesia pada ComboBox
	    $nama_bln=array(1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nov","Des");
	    echo "<select name=bulan id=bulan>
	          <option value=0>Bulan:</option>";
 	    for ($bln=1; $bln<=12; $bln++) {
	       echo "<option value=$bln>$nama_bln[$bln]</option>";
	    }
	    echo "</select>";
	
	    // Tampilkan pilihan tahun dari 1970 s/d saat ini pada ComboBox
	    $thn_sekarang=date("Y");
	    echo "<select name=tahun id=tahun><option value=0>Tahun:</option>";
	    for($thn=1970; $thn<=$thn_sekarang;$thn++) {
	       echo "<option value=$thn>$thn</option>";
	    }
	    echo "</select>";
	  ?>




<div><input type="submit" value="Sign Up" class="signup_btn"></div>
</form>

<?php
if(isset($status))
{
if ($status == "fail")
{
?>
<br/><div class="error_msg">Enter all the information.</div>
<?php
}
elseif($status == "conflict")
{
?>
<br/><div class="error_msg">Email address already registered.</div>
<?php
}
}
?>

</div>

</div>
<div id="footer">&copy; Testian's | <b><a href='#'>Send Your Testimonials</a></b></div>
</div>
</body>
</html>