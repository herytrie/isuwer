<div id="main"> <a name="TemplateInfo"></a>
<?php
if(isset($_POST['kirim'])){

	$uid=$_POST['uid'];
	
	$fullname=ucwords($_POST['fullname']);
	$email=$_POST['email'];
	$gender=$_POST['gender'];
	$tanggal=$_POST['birth'];
	
	$religion=$_POST['religion'];
	$status=$_POST['status'];
	$address=$_POST['address'];
	$activity=$_POST['activity'];
	$hobby=$_POST['hobby'];
		
	//exception
	if(empty($_POST['password'])){
		$password=$_POST['password'];
	}else{
		$password=md5($_POST['password']);
	}
	
	
	if(empty($_FILES['photo']['name'])){
		$photo=$_POST['photo'];
	}else{
		$photo=$_FILES['photo']['name'];
		
		//definisikan variabel file dan alamat file
		$uploaddir='./photo/';
		$alamatfile=$uploaddir.$photo;

		//periksa jika proses upload berjalan sukses
		$upload=move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile);
	}


	$query=mysql_query("update users set fullname='$fullname',email='$email',gender='$gender',
						birth='$tanggal',religion='$religion',status='$status',address='$address',activity='$activity',hobby='$hobby',
						password='$password',photo_profil='$photo' where uid='$uid'");
						
	if($query){
		?>
		<blockquote>
          <p></p>
		  <p>Data Anda berhasil disimpan...</p>
		  <p></p>
		</blockquote>
		<?php
	}else{
		echo mysql_query();
	}
	

}else{
	unset($_POST['kirim']);
}
?>
</div>