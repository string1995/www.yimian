// JavaScript Document
//global var for storing current video info
var g_vId=0;
var g_vName='';
var g_vSeries='';
var g_vType='';
var g_vUrl1='';
var g_vUrl2='';
var g_idd=0;
var g_aid=0;

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
        bottom: '10%',
		user: fp
    }
});

//lstn for recording play time to cookie
var timeUpdate_count=0;
dp.on('timeupdate',function dpTimeRecord(){if(g_vId!=234&&g_vId!=0)cookie.set('vTime_'+g_vId,dp.video.currentTime);if(timeUpdate_count++>15){ $.post("/etc/api/video_fp.php",{"fp":fp,"id":g_vId,"seek":dp.video.currentTime,"ip":returnCitySN.cip});timeUpdate_count=0;window.history.replaceState(null, null, "https://cn.yimian.xyz/video/video.php?id="+g_vId);}
	if(typeof attach==="function") attach();});

//lstn for the video to the end
dp.on('ended',function dpEnd(){cookie.del('vTime_'+g_vId);nextVideo();});

//lstn error
dp.on('error',function dpError(){newVideo(234,1,6);});


//functuion for switch video by id and url
function newVideo_detail(id,url,next,seek,aid)
{
	if(!aid)
	dp.switchVideo({
		url: url
		},
		{
    	id: id,
    	api: 'https://dans.yimian.ac.cn/',
    	bottom: '10%',
		user: fp
	});
	else
	dp.switchVideo({
		url: url
		},
		{
    	id: id,
    	api: 'https://dans.yimian.ac.cn/',
    	bottom: '10%',
		addition: ['https://api.prprpr.me/dplayer/v3/bilibili?aid='+aid],
		user: fp
	});
	if(seek) {dp.seek(seek);dp.notice('已跳转至上次播放位置..', 3000);}
	if(next) dp.play();
}

//function for create a new video
function newVideo(id,next,seek)
{
	$.ajax({
       	type: "POST",
        url: '/etc/api/video.php',
        data: { "id": id},
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
			g_aid=msg.aid;
			
			videotoUrl(id);
			
			if(!seek){seek=cookie.get('vTime_'+g_vId)}
			
			newVideo_detail(msg.id,msg.url1,next,seek,msg.aid);
			cookie.set('vWatching',g_vId);
			//record video for usr
			timeUpdate_count=0;
			$.post("/etc/api/video_fp.php",{"fp":fp,"id":g_vId,"seek":0,"ip":returnCitySN.cip});
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
       	type: "POST",
        url: '/etc/api/video_redirect.php',
        data: { "id": id},
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
       	type: "POST",
        url: '/etc/api/video_toUrl.php',
        data: { "id": id},
        traditional: true,
        dataType: 'json',
		success: function (msg){
			if(!msg.id) return 0;
			dp.notice(msg.hint, 4000);
			setTimeout('window.location.href=\''+msg.url+'\'',4000);
			
		}
	});
}
