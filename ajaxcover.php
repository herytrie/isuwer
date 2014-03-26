<?php
include('includes/db.php');
include_once 'session.php';

$path = "cover_img/";

$allowed_formats = array("jpg", "png", "gif","JPG");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
 {
  $name = $_FILES['photoimg']['name'];
  $size = $_FILES['photoimg']['size'];
  if(strlen($name))
         {
	list($txt, $ext) = explode(".", $name);
	if(in_array($ext,$allowed_formats))
		{
		if($size<(1024*1024))
			{
			$image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
			
			$tmp = $_FILES['photoimg']['tmp_name'];
			if(move_uploaded_file($tmp, $path.$image_name))
				{
				$command=mysql_query("UPDATE users SET cover_img='$image_name' WHERE uid='$uid'");
									
				echo "<img src='cover_img/".$image_name."'  class='preview'>";
							
										
					
				}
			else
			echo "failed";
		}
	else
	echo "Image file size max 250k";					
          }
else
echo "Invalid file format..";	 
}
				
else
echo "Please select image..!";
				
exit;
}
?>