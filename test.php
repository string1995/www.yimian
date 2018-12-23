<html>
		<script type="text/javascript" src="./video/js/jquery.min.js"></script>

<script>
function hh()
	{
 $.ajax({
        type: "POST",
        url: 'https://api-cn.faceplusplus.com/facepp/v3/compare',
        data:  {"api_key": "rG-zABnDuu_8uazCcbeNtqTO17Twxfm9",
			   	"api_secret": "WoeTn3G0EyJSZWOVHa_QFCCdpK6eT5iY",
				"image_url1": "https://cn.yimian.xyz/ai/face/yimian/1.jpg",
				"image_url2": "http://home.yimian.xyz:8080/?action=snapshot"
			   
			   },//使用这种数组方式的，得加下一句才可以，使用传统方式
        dataType: 'json',
		success: function(msg){
    var a=document.getElementById("test");
    a.innerHTML=msg.confidence;
		}

    });
	}
	setInterval("hh();",1000);</script>
<body>
	
	<div id="test"></div>
	
	</body>

</html>