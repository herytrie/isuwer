<div id="updateboxarea">
<div style="margin-bottom:5px;font-weight:bold;"><img src="icons/2.png">&nbsp;Update Status</div>
<textarea name="update" id="update" maxlength="200" placeholder="What's on your mind ?" title="What's on your mind ?"></textarea>
<br />
<div id="webcam_container" class='border'>
<div id="webcam" >
</div>
<div id="webcam_preview">

</div>

<div id='webcam_status'></div>
<div id='webcam_takesnap'>

<input type="button" value=" Take Snap " onclick="return takeSnap();" class="camclick button"/>
<input type="hidden" id="webcam_count" />
</div>
</div>
<div  id="imageupload" class="border">
<form id="imageform" method="post" enctype="multipart/form-data" action='image_ajax.php'> 
<div id='preview'>
</div>

<span id='addphoto'>Add Photo:</span> <input type="file" name="photoimg" id="photoimg" />
<input type='hidden' id='uploadvalues' />
</form>
</div>
<div id="button_bar" style="width:100%;clear:both;">
<input type="submit"  value=" Update "  id="update_button"  class="update_button" rel="<?php echo $profile_uid;?>"/> 
<span style="float:right">
<a href="javascript:void(0);" id="camera"><img src="icons/cameraa.png" id="east" border="0" title="Upload Image"/></a> 
<a href="javascript:void(0);" id="webcam_button"><img src="icons/web-cam.png" id="south" border="0" title="Webcam Snap" style='margin-top:5px'/></a>
</span>
</div>

</div>