<?php

function Expand_URL($url){
        $returns = "";
if(!empty($url))
{
if(eregi("youtu",$url) or eregi("youtube",$url))
{
    if(eregi("v=",$url))
    $splits = explode("=",$url);
    else
    $splits = explode("be/",$url);

     if(!empty($splits[1]))
      {

       if(preg_match("/feature/i", $splits[1]))
{
$splits[1] = str_replace("&feature","",$splits[1]);				       
}
       $returns = '<iframe width="410" height="200" src="http://www.youtube.com/embed/'.$splits[1].'" frameborder="0"></iframe>';
        }
} 

else if(eregi("vimeo",$url))
{
        $splits = explode("com/",$url);
        $returns = '<iframe src="http://player.vimeo.com/video/'.$splits[1].'?title=0&amp;byline=0&amp;portrait=0" width="410" height="200" frameborder="0"></iframe>';
}

else if(eregi("dailymotion",$url)){
        $splits = explode("video/",$url);
        $splits = explode("_",$splits[1]);
$returns = '<iframe frameborder="0" width="410" height="200" src="http://www.dailymotion.com/embed/video/'.$splits[0].'"></iframe>';
}

else if(eregi("collegehumor",$url)){
        $splits = explode("video/",$url);
        $splits = explode("/",$splits[1]);
$returns = '<iframe src="http://www.collegehumor.com/e/'.$splits[0].'" width="410" height="200" frameborder="0"></iframe>';

}


else if(eregi("metacafe",$url)){
        $splits = explode("watch/",$url);
        $splits = explode("/",$splits[1]);
$key = "$splits[0]/$splits[1].swf";

$returns = '<embed flashVars="playerVars=autoPlay=no" src="http://www.metacafe.com/fplayer/'.$key.'" width="410" height="200"></embed>';

}


}
return $returns;
}
?>
