<?php
include_once 'session.php';
include('includes/db.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<title>Change Cover Picture</title>

<link rel="icon" type="image/png" href="icons/FB.png" />
<link rel="stylesheet" type="text/css" href="css/wtfdiary.css" media="screen" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>


<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').live('change', function()			{ 
			           $("#preview").html('');
				
			    $("#preview").html('<img src="icons/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
			target: '#preview'
		         }).submit();
			$("#goto_pro").show();
		
			});
        }); 
</script>

<style>

body
{
font-family:arial;
}

.preview
{
max-width:600px;
border:solid 1px #dedede;
padding:5px;
}

#preview
{
color:#cc0000;
font-size:12px
}

#goto_pro
{
display:none;
padding:5px;
background:#eeeeee;
}

</style>



</head>
<body>

<div id="container">
<?php include("includes/nav_bar.php");?>

<h2>Cover Picture Upload</h2>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaxcover.php'>
<b>Upload image from your computer:</b> <input type="file" name="photoimg" id="photoimg" /><br><br/>
<div><small>Best Size for Cover Picture: 600px by 200px | Not more than 250 KB</small></div><br/>

</form>

<div id='preview'></div><br/>

<div id="goto_pro">New Cover Image is Saved. Go to <a href="profile.php?id=<?php echo $uid;?>"><b>Profile</b></div>


<div class="info">
<hr></hr>
<div style='margin-top:5px;'>&copy; Testian's | <b><a href='#'>Send Your Testimonials</a></div>
</div>
</div>

</body>
</html>


