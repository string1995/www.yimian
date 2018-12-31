<?php
include '../functions.php';

if(isset($_COOKIE['fp']))
{
	$fp=$_COOKIE['fp'];
	
	$res=db__getData(db__connect(),"videolog","fp",$fp);
	
	foreach($res as $data)
	{
		setcookie("vTime_".$data['video'],$data['seek']);
	}
	
}


if(!isset($_REQUEST['id']))
{
	if(isset($_COOKIE['fp']))
	{
		$conn=db__connect();
		
		$fp=$_COOKIE['fp'];
	
		$result=db__getData($conn,"fp","fp",$fp);
		
		$r_usr=$result[0]['usr'];
		
		if(!$r_usr) $res=$result;
		else
		$res=db__getData($conn,"fp","usr",$r_usr);
	
		$max=0;
	
		for($i=1;$i<count($res);$i++)
		{
			if($res[$i]['videotime']>$res[$max]['videotime']) $max=$i;
		}
	
		setcookie("vTime_".$res[$max]['video'],$res[$max]['videoseek'],time()+3600*24*365*15);
	
		$_REQUEST['id']=$res[$max]['video'];
		//echo "<script>window.location.href='./video.php?id=".$res[$max]['video']."';</script>";
	
	}
	else
		header("Location: https://cn.yimian.xyz/404.php");
}



yimian__header("Yimian Video","video,Yimian","This is the page for playing a video.");

js__jquery();

yimian__headerEnd();

dplayer__element();

echo "
<script>
var is_next=1;
</script>";

dplayer__setup();
dplayer__add($_REQUEST['id']);

echo "
<script>
$(\"#next\").on(\"click\",function (){nextVideo();});
</script>";
?>

<div id="pub-board">

<p id="usrName"></p>
	
 <p id="videoSeries"></p>
	
<p id="videoName"></p>

<p id="videoId"></p>
	
<p id="videoLength"></p>
	
<p id="videoDownload"></p>

	
<p id="videoState"></p>
	
<p id="videoSeek"></p>

<p id="dansFrom"></p>
	
<p id="dansLength"></p>
</div>
<script>
$("#usrName").html("UserName: <?php if(isset($_SESSION['s_usr']))echo $_SESSION['s_usr'];else echo "没有登录？<a href='https://cn.yimian.xyz/login'>戳我注册~</a>";?>");
	
function attach()
{
	$("#videoSeries").html("VideoSeries: "+g_vSeries);
	$("#videoName").html("VideoName: "+g_vName);
	$("#videoId").html("VideoId: "+g_vId);
	$("#videoLength").html("VideoDuration: "+dp.video.duration+'s');
	$("#videoDownload").html("VideoDownloadUrl: "+g_vUrl2);
	$("#videoState").html("PlayState: "+!dp.video.paused);
	$("#videoSeek").html("PlaySeek: "+dp.video.currentTime+'s');
	(dp.danmaku.dan.length>1500)||$("#dansFrom").html("DansBilibili: Off");
	(dp.danmaku.dan.length>1500)&&$("#dansFrom").html("DansBilibili: On");
	$("#dansLength").html("DansAmount: "+dp.danmaku.dan.length);
}
	
	</script>





<?
yimian__footer();
