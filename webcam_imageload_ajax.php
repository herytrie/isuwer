 <?php
 
error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/FbWall.php';
include_once 'includes/tolink.php';
include_once 'includes/time_stamp.php';
include_once 'session.php';
$FbWall = new FbWall();
if(isSet($_POST['webcam']))
{
$newdata=$FbWall->Get_Upload_Image($uid,0);
echo "<img src='uploads/".$newdata['image_path']."'  class='webcam_preview' id='".$newdata['id']."'/>";
}
?>
