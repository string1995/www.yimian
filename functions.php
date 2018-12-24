<?php

/**global var**/
$jquery=0;

/**functions for html **/

//print a html header
function yimian__header($title="Yimian",$keywords="yimian",$description="Yimian Website")
{
	echo "<!--

   ___     ___
  |\  \    |  |
  \ \  \   |  |
   \ \  \  |  |
    \ \  \_|  |  ___    _____________    ___    _________      _________     
     \ \     /  |\  \  |\   __   __  \  |\  \  |\   ___  \    |\   ___  \ 
      \ \  \/   \ \  \ \ \  \-\  \-\  \ \ \  \ \ \  \--\  \   \ \  \--\  \ 
       \ \  \    \ \  \ \ \  \ \  \ \  \ \ \  \ \ \  \  \  \   \ \  \  \  \
        \ \  \    \ \  \ \ \  \ \  \ \  \ \ \  \ \ \  \__\  \___\ \  \  \  \ 
         \ \__\    \ \__\ \ \__\ \__\ \__\ \ \__\ \ \___________\\ \__\  \__\
          \|__|     \|__|  \|__| |__| |__|  \|__|  \|___________| \|__|  |__|

-->
";

	echo "<!doctype html>
<head>
	<meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
	<title>".$title."</title>
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no\"/>
   	<meta name=\"Keywords\" content=\"".$keywords."\">
	<meta name=\"Description\" content=\"".$description."\">";
}


//jquery install
function js__jquery()
{
	echo "<script src=\"https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js\"></script>";
	$GLOBALS['jquery']=1;
}


//mark the end of the html header
function yimian__headerEnd()
{
	echo "
</head>
	
<body>";
}


//print a html footer
function yimian__footer($wordColor="#C7C7C7",$backgroundColor="#2B2B2B",$urlColor="#87CEEB")
{
	echo "	<style>/*footer theme*/footer{padding:1.5rem 1rem;color:".$wordColor.";font-size:1.2rem;line-height:1.4;text-align:center;background:".$backgroundColor.";border-top:1px solid #C7C7C7}a.footera:link{color: ".$urlColor." ; text-decoration:none;}a.footera:visited {color:#79CDCD}</style>
	<footer class=\"footer\">Copyright © 2018.<a class=\"footera\" href=\"https://cn.yimian.xyz/cv\">Yimian LIU</a> All rights reserved.</footer>";
	echo "</body>
</html>";
}



/**functions for aplayer**/

//put this function to where you want the aplayer to dispaly
function aplayer__element()
{
	echo "<div id=\"aplayer\" class=\"aplayer\"></div>";
}
	
	
//this should put at the near the need of a body,
//the js object name is ap.
function aplayer__setup()
{
	echo "<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/aplayer@1.10/dist/APlayer.min.css\">
<script src=\"https://cdn.jsdelivr.net/npm/aplayer@1.10/dist/APlayer.min.js\"></script>";
	echo "<script>//script for setup the aplayer
	const ap = new APlayer({
    container: document.getElementById('aplayer'),
    mini: false,
    autoplay: false,
    theme: '#FADFA3',
    loop: 'all',
    order: 'random',
    preload: 'auto',
    volume: 0.7,
    mutex: true,
    listFolded: false,
    listMaxHeight: 90,
    lrcType: 3,
    audio: []
});	
	</script>";
}


//this should put at the near the need of a body,
//the js object name is ap.
function aplayer__setup_mini()
{
	echo "<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/aplayer@1.10/dist/APlayer.min.css\">
<script src=\"https://cdn.jsdelivr.net/npm/aplayer@1.10/dist/APlayer.min.js\"></script>";
	echo "<script>//script for setup the aplayer
	const ap = new APlayer({
    container: document.getElementById('aplayer'),
	fixed: true,
	loop: 'all',
    order: 'random',
	volume: 0.7,
    audio: []
});	
	</script>";
}

//the should put behind the setup function
function aplayer__add($name="",$artist="unknown",$url="",$coverurl="",$lrcurl="",$theme="#ebd0c2")
{
	echo "<script>//script for adding a new music to aplayer
	ap.list.add([{
    name: '".$name."',
    artist: '".$artist."',
    url: '".$url."',
    cover: '".$coverurl."',
    lrc: '".$lrcurl."',
    theme: '".$theme."'
}]);
</script>";
}

//play a netease playlist
function aplayer__netease($playlistid="2012006204",$loadStart=0,$numLimit=10,$theme="#ebd0c2")
{
	if(!$GLOBALS['jquery'])echo "<script src=\"https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js\"></script>";
	$GLOBALS['jquery']=1;
	echo "<script> $.ajax({
        type: \"GET\",
        url: 'https://api.bzqll.com/music/netease/songList',
        data: { \"key\": 579621905,
			  	\"id\": $playlistid,
				\"limit\": $numLimit},
        traditional: true,
        dataType: 'json',
        success: function (msg) {
		   for(var i=$loadStart;i<Math.min(msg.data.songListCount,$numLimit);i++)
		   {
		   		ap.list.add([{
				name: msg.data.songs[i].name,
				artist: msg.data.songs[i].singer,
				url: msg.data.songs[i].url,
				cover: msg.data.songs[i].pic,
				lrc: msg.data.songs[i].lrc,
				theme: '$theme'
				}]);
		   }
        }
    });</script>";
}


