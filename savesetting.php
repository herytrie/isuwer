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
		
	if(isset($_POST['kirim'])){

	// $uid=$_POST['uid'];
	// $fullname=ucwords($_POST['fullname']);
	// $email=$_POST['email'];	
	//exception
	// if(empty($_POST['password'])){
		// $password=$_POST['password'];
	// }else{
		// $password=md5($_POST['password']);
	// }
	
	
	// if(empty($_FILES['photo']['name'])){
		// $photo=$_POST['photo'];
	// }else{
		// $photo=$_FILES['photo']['name'];
		
		// //definisikan variabel file dan alamat file
		// $uploaddir='./photo/';
		// $alamatfile=$uploaddir.$photo;

		// //periksa jika proses upload berjalan sukses
		// $upload=move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile);
	// }


	$query=mysql_query("update users set fullname='$fullname',
										 email='$email'
										 where uid='$uid'");
						
	if($query){
		?>
		<blockquote>
          <p></p>
		  <p>Data Anda berhasil disimpan...</p>
		  <p></p>
		</blockquote>
		<?php
	}
	else{
		echo mysql_query();
	}
	

}
else{
	unset($_POST['kirim']);
}
?>
</div>