// JavaScript Document


//global var for storing current video info
var g_vName='';
var g_vSeries='';
var g_vType='';
var g_vUrl1='';
var g_vUrl2='';
var g_idd=0;
var g_vCode='';
var seek=0;

$.ajax({
       	type: "POST",
        url: '/etc/api/video.php',
        data: { "id": g_vId},
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
			g_vCode=msg.vcode;
			
			if(!seek){seek=cookie.get('vTime_'+g_vId)}
			
			if(g_vCode)
			{
			$.ajax({
       			type: "POST",
        		url: '/etc/api/video_dogecloud_api.php',
				data: { "vcode": g_vCode,"ip":returnCitySN.cip},
				traditional: true,
        		dataType: 'json',
				success: function (msg1){
				
					var Aquality=new Array();
					Aquality[0]={name:'原视频',url:g_vUrl1,type:'normal'}
					for(var i=0;i<msg1.data.stream.length;i++)
						Aquality[i+1]={
							name:msg1.data.stream[i].name,
							url:msg1.data.stream[i].url,
							type:msg1.data.stream[i].format
							};
				
					const dp = new DPlayer({
    			container: document.getElementById('dplayer'),
    			autoplay: false,
    			theme: '#1E90FF',
    			loop: true,
    			lang: 'zh-cn',
    			hotkey: true,
    			preload: 'auto',
    			logo: 'https://cn.yimian.xyz/etc/img/logo/logo_white.png',
    			volume: 0.7,
    			mutex: true,
    			video: { quality: Aquality,
					defaultQuality: 1
    			},
				danmaku: {
					id: g_vId,
					api: 'https://dans.yimian.ac.cn/',
        			bottom: '10%',
					user: fp
					}
				});

			//lstn for recording play time to cookie
			var timeUpdate_count=0;
			dp.on('timeupdate',function dpTimeRecord(){if(g_vId!=234&&g_vId!=0)cookie.set('vTime_'+g_vId,dp.video.currentTime);if(timeUpdate_count++>15){ $.post("/etc/api/video_fp.php",{"fp":fp,"id":g_vId,"seek":dp.video.currentTime,"ip":returnCitySN.cip});timeUpdate_count=0;}});


			//lstn error
			dp.on('error',function dpError(){newVideo(234,1,6);});

			
			
			//record video for usr
			timeUpdate_count=0;
			$.post("/etc/api/video_fp.php",{"fp":fp,"id":g_vId,"seek":0,"ip":returnCitySN.cip});
			
				}
			});
			}
			else
			{
			const dp = new DPlayer({
    			container: document.getElementById('dplayer'),
    			autoplay: false,
    			theme: '#1E90FF',
    			loop: true,
    			lang: 'zh-cn',
    			hotkey: true,
    			preload: 'auto',
    			logo: 'https://cn.yimian.xyz/etc/img/logo/logo_white.png',
    			volume: 0.7,
    			mutex: true,
    			video: {
					url: g_vUrl1
    			},
				danmaku: {
					id: g_vId,
					api: 'https://dans.yimian.ac.cn/',
        			bottom: '10%',
					user: fp
					}
				});

			//lstn for recording play time to cookie
			var timeUpdate_count=0;
			dp.on('timeupdate',function dpTimeRecord(){if(g_vId!=234&&g_vId!=0)cookie.set('vTime_'+g_vId,dp.video.currentTime);if(timeUpdate_count++>15){ $.post("/etc/api/video_fp.php",{"fp":fp,"id":g_vId,"seek":dp.video.currentTime,"ip":returnCitySN.cip});timeUpdate_count=0;}});


			//lstn error
			dp.on('error',function dpError(){newVideo(234,1,6);});

			
			
			//record video for usr
			timeUpdate_count=0;
			$.post("/etc/api/video_fp.php",{"fp":fp,"id":g_vId,"seek":0,"ip":returnCitySN.cip});
			}
		},
        error: function (data,type, err) {
           alert('Can not Get Video!');
        }
  });
