<?php

error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/FbWall.php';
include_once 'includes/tolink.php';
include_once 'includes/htmlcode.php';
include_once 'includes/textlink.php';
include_once 'includes/time_stamp.php';
include_once 'includes/Expand_URL.php';
include_once 'session.php';

$FbWall = new FbWall();
if(isSet($_POST['last_fid']))
{
$last_fid=mysql_real_escape_string($_POST['last_fid']);
$profile_uid=mysql_real_escape_string($_POST['profile_uid']);
$lastmsg=mysql_real_escape_string($lastmsg);
include('load_friends.php');
}
?>
