<?php
include 'config.php';


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
	echo "<!-- Include js Jquery and Pjax -->
<script type=\"text/javascript\" src=\"https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"https://cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.js\"></script>";
	$GLOBALS['jquery']=1;
}


//mark the end of the html header
function yimian__headerEnd()
{
	echo "
<script>console.log('\\n' + ' %c Yimian  %c https://www.yimian.xyz ' + '\\n', 'color: #00FFFF; background: #030307; padding:5px 0;', 'background: #4682B4; padding:5px 0;');console.log('Proudly include Plugins:'+'\\n');</script>
<script src=\"/etc/fp/fp.js\"></script>
<script>console.log('Thankfully include Plugins:'+'\\n');console.log('\\n' + ' %c jQuery v1.10.2 %c https://jquery.com ' + '\\n' + '\\n', 'color: #fadfa3; background: #030307; padding:5px 0;', 'background: #fadfa3; padding:5px 0;');console.log('\\n' + ' %c jquery-pjax v2.0.1 %c https://github.com/defunkt/jquery-pjax ' + '\\n' + '\\n', 'color: #fadfa3; background: #030307; padding:5px 0;', 'background: #fadfa3; padding:5px 0;');</script>
<script src=\"/etc/cookie/cookie.js\"></script>
</head>
	
<body>";
}


//print a html footer
function yimian__footer($wordColor="#C7C7C7",$backgroundColor="#2B2B2B",$urlColor="#87CEEB")
{
	echo "	<style>/*footer theme*/footer{padding:1.5rem 1rem;color:".$wordColor.";font-size:1.2rem;line-height:1.4;text-align:center;background:".$backgroundColor.";border-top:1px solid #C7C7C7}a.footera:link{color: ".$urlColor." ; text-decoration:none;}a.footera:visited {color:#79CDCD}</style>
	<script>function openwin(){window.open(\"https://cn.yimian.xyz/cv\");}</script>
	<footer class=\"footer\">Copyright © 2018.<a class=\"footera\" onclick=\"openwin()\" href=\"#\">Yimian LIU</a> All rights reserved.</footer>";
	echo "</body>
</html>";
}



/**database connection**/

//connect to database
function db__connect($servername="",$username="",$password="",$dbname="")
{
	/* reset */
	if($servername=="") $servername=$GLOBALS['g_db_serverName'];
	if($username=="") $username=$GLOBALS['g_db_usrName'];
	if($password=="") $password=$GLOBALS['g_db_psswd'];
	if($dbname=="") $dbname=$GLOBALS['g_db_dbName'];
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
		die("Mysql Connect Failed: " . $conn->connect_error);
	} 

	return ($conn);
}

//get table row number::(data_cnnct var,table name) ::(row number)
function db__rowNum($conn,$table,$clmnName="",$value="",$clmnName2="",$value2="")
{
	
	if($clmnName=="") $sql = "SELECT COUNT(*) FROM $table";
	elseif($clmnName2=="") $sql = "SELECT COUNT(*) FROM $table where $clmnName='$value'";
	else $sql = "SELECT COUNT(*) FROM $table where $clmnName='$value' AND $clmnName2='$value2'";
	
	$row_count = $conn->query($sql);   
	list($row_num) = $row_count->fetch_row(); 
	return ($row_num);
}

//get row data from database::(data_cnnct var, table name,column name, column value)::(row info)
function db__getData($conn,$table,$clmnName="",$value="",$clmnName2="",$value2="")
{
	if($clmnName=="") $sql = "SELECT * FROM $table";
	elseif($clmnName2=="") $sql = "SELECT * FROM $table where $clmnName='$value'";
	else $sql = "SELECT * FROM $table where $clmnName='$value' AND $clmnName2='$value2'";
		
	$result = $conn->query($sql);
	//no data
	if ($result->num_rows > 0) {}else{return 404;}

	$i=0;
	$arr=array();
	while($row = $result->fetch_assoc()) {
		$arr[$i++]=$row;
	}
	return ($arr);
}


//fnct for insert a row to database
function db__insertData($conn,$table,$content)
{	
	$key=array_keys($content);
	
	$sql="insert INTO $table (";
	
	for($i=0;$i<count($key);$i++)
	{
		$sql.="$key[$i]";
		if($i!=count($key)-1) $sql.=", ";
	}
	
	$sql.=") VALUES (";
	
	for($i=0;$i<count($key);$i++)
	{
		$tmp_key=$key[$i];
		$sql.="'$content[$tmp_key]'";
		if($i!=count($key)-1) $sql.=", ";
	}
	
	$sql.=")";
	
	if (!($conn->query($sql) === TRUE))  echo "SQL Insert Error: " . $sql . "<br>" . $conn->error;

}


//fnct for update a row to database without check
function db__updateData($conn,$table,$content,$index)
{	
	$key=array_keys($content);
	
	$sql="UPDATE $table SET ";
	
	for($i=0;$i<count($key);$i++)
	{
		$tmp_key=$key[$i];
		$sql.="$key[$i]='$content[$tmp_key]'";
		if($i!=count($key)-1) $sql.=", ";
	}
	
	$key=array_keys($index);
	
	$sql.=" WHERE ";
	
	for($i=0;$i<count($key);$i++)
	{
		$tmp_key=$key[$i];
		$sql.="$tmp_key='$index[$tmp_key]'";
		if($i!=count($key)-1) $sql.=" AND ";
	}
	
	if (!($conn->query($sql) === TRUE))  echo "SQL Insert Error: " . $sql . "<br>" . $conn->error;

}




//push row data from database::(data_cnnct var, table name,column name, column value)::(row info)
function db__pushData($conn,$table,$content,$index="",$is_force=1)
{
	if($index)
	{
		$index_keys=array_keys($index);

		if(count($index_keys)==1) $result=db__rowNum($conn,$table,$index_keys[0],$index[$index_keys[0]]); 
			
		elseif(count($index_keys)==2)	$result=db__rowNum($conn,$table,$index_keys[0],$index[$index_keys[0]],$index_keys[1],$index[$index_keys[1]]); 
			
		else return -1;
			
		if($result>0) db__updateData($conn,$table,$content,$index);
		else if($is_force) db__insertData($conn,$table,$content);
			
	}
	else
		db__insertData($conn,$table,$content);
}



/***tools***/
//fnct of get usr ip::()::(ip)
function getip() 
{
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
	{
		$ip = getenv("HTTP_CLIENT_IP");
	} 
	else
		if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
		{
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		}
		else
			if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
			{
				$ip = getenv("REMOTE_ADDR");
			} 
			else
				if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
				{
					$ip = $_SERVER['REMOTE_ADDR'];
				} 
				else 
				{
					$ip = "unknown";
				}
return ($ip);
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
	if(!$GLOBALS['jquery']) js__jquery();
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




/**functions for dplayer**/

//put this function to where you want the dplayer to dispaly
function dplayer__element()
{
	echo "<div id=\"dplayer\"></div>";
}
	
	
//this should put at the near the need of a body,
//the js object name is dp.
function dplayer__setup()
{
	echo "<script src=\"https://pv.sohu.com/cityjson?ie=utf-8\"></script>
";
	echo "<link rel=\"stylesheet\" href=\"https://cn.yimian.xyz/etc/dplayer/DPlayer.min.css\">
<script src=\"https://cn.yimian.xyz/etc/dplayer/DPlayer.min.js\"></script>";
	echo "<script type=\"text/javascript\">//script for set up the dplayer
//global var for storing current video info
var g_vId=0;
var g_vName='';
var g_vSeries='';
var g_vType='';
var g_vUrl1='';
var g_vUrl2='';
var g_idd=0;

const dp = new DPlayer({
    container: document.getElementById('dplayer'),
    autoplay: false,
    theme: '#1E90FF',
    loop: false,
    lang: 'zh-cn',
    hotkey: true,
    preload: 'auto',
    logo: 'https://cn.yimian.xyz/etc/img/logo/logo_white.png',
    volume: 0.7,
    mutex: true,
    video: {
        url: 'https://obs-410c.obs.myhwclouds.com/video/404.mp4'
    },
    danmaku: {
        id: 'null',
        api: 'https://dans.yimian.ac.cn/',
        bottom: '10%'
    }
});

//lstn for recording play time to cookie
var timeUpdate_count=0;
dp.on('timeupdate',function dpTimeRecord(){if(g_vId!=234&&g_vId!=0)cookie.set('vTime_'+g_vId,dp.video.currentTime);if(timeUpdate_count++>15){ $.post(\"/etc/api/video_fp.php\",{\"fp\":fp,\"id\":g_vId,\"seek\":dp.video.currentTime,\"ip\":returnCitySN.cip});timeUpdate_count=0;}});

//lstn for the video to the end
dp.on('ended',function dpEnd(){cookie.del('vTime_'+g_vId);nextVideo();});

//lstn error
dp.on('error',function dpError(){newVideo(234,1,6);});


//functuion for switch video by id and url
function newVideo_detail(id,url,next,seek)
{
	dp.switchVideo({
		url: url
		},
		{
    	id: id,
    	api: 'https://dans.yimian.ac.cn/',
    	bottom: '10%'
	});
	if(seek) {dp.seek(seek);dp.notice('已跳转至上次播放位置..', 3000);}
	if(next) dp.play();
}

//function for create a new video
function newVideo(id,next,seek)
{
	$.ajax({
       	type: \"POST\",
        url: '/etc/api/video.php',
        data: { \"id\": id},
        traditional: true,
        dataType: 'json',
		success: function (msg){
		
			g_vId=parseInt(msg.id);
			g_vName=msg.name;
			g_vSeries=msg.series;
			g_vType=msg.type;
			g_vUrl1=msg.url1;
			g_vUrl2=msg.url2;
			g_vIdd=parseInt(msg.idd);
			
			videotoUrl(id);
			
			if(!seek){seek=cookie.get('vTime_'+g_vId)}
			
			newVideo_detail(msg.id,msg.url1,next,seek);
			cookie.set('vWatching',g_vId);
			//record video for usr
			timeUpdate_count=0;
			$.post(\"/etc/api/video_fp.php\",{\"fp\":fp,\"id\":g_vId,\"seek\":0,\"ip\":returnCitySN.cip});
		},
        error: function (data,type, err) {
           alert('Can not Get Video!');
        }
    });
}

//fnct for playing the next video
function nextVideo()
{
	var id=g_vId;
	
	$.ajax({
       	type: \"POST\",
        url: '/etc/api/video_redirect.php',
        data: { \"id\": id},
        traditional: true,
        dataType: 'json',
		success: function (msg){
			if(msg.id) id=msg.toid;
			else id++;
			
			newVideo(id,1);
		}
	});

}

//for video to redirect to other website
function videotoUrl(id)
{
		$.ajax({
       	type: \"POST\",
        url: '/etc/api/video_toUrl.php',
        data: { \"id\": id},
        traditional: true,
        dataType: 'json',
		success: function (msg){
			if(!msg.id) return 0;
			dp.notice(msg.hint, 4000);
			setTimeout('window.location.href=\''+msg.url+'\'',4000);
			
		}
	});
}

</script>
";
echo "<script src=\"https://pv.sohu.com/cityjson?ie=utf-8\"></script>";
}


//this should put behind the setup function
function dplayer__add($id="234")
{
	echo "<script>//script for adding a new video to aplayer
newVideo('$id');
</script>";
}


