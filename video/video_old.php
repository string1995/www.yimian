<?php 
$id=$_GET['id'];

$conn=database_cnnct();

//get row info form table blog with id



$sql = "SELECT * FROM videoRedirect";


$result = $conn->query($sql);


$sql3 = "SELECT * FROM videoToUrl";

$result2 = $conn->query($sql3);
?>


<?php //declear function


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


//fnct of connecting database::()::(database conn)
function database_cnnct ()
{
$servername = "114.116.65.152";
$username = "yimian";
$password = "Lymian0904@112";
$dbname = "yimian";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	

if ($conn->connect_error) 
{
    die("连接失败: " . $conn->connect_error);
} 

return ($conn);
}


//fnct of get table row number::(data_cnnct var,table name) ::(row number)
function sql_rowNum($conn,$tableSql)
{
$row_count = $conn->query("SELECT COUNT(*) FROM $tableSql");   
list($row_num) = $row_count->fetch_row(); 
return ($row_num);
}

//fnct of getting row data from database::(data_cnnct var, table name,column name, column value)::(row info)
function sql_data($conn,$table,$clmnName="",$value)
{
$sql = "SELECT * FROM $table where $clmnName=$value";

$result = $conn->query($sql);
///禁止非法访问
if ($result->num_rows > 0) {}else{echo "<script>alert('Illegal Visit!');setTimeout(function(){top.location='/404.php';},0)</script>";}

$row = $result->fetch_assoc();

return ($row);

}

function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Yimian Video</title>
		
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<style type="text/css">body{margin:0;padding:0px;font-family:"Microsoft YaHei",YaHei,"微软雅黑",SimHei,"黑体";font-size:14px}</style>
		
<?php
echo "<script> var rdrctId1 = new Array();var rdrctId2 = new Array();var urlId = new Array();var urlUrl = new Array();";
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {	

		$tmp_id1=$row['id'];
		$tmp_id2=$row['toid'];
		echo "rdrctId1.push($tmp_id1);rdrctId2.push($tmp_id2);";
		
	}}
if ($result2->num_rows > 0) {
    // 输出数据
    while($row1 = $result2->fetch_assoc()) {	

		$url_id=$row1['id'];
		$url_url=$row1['url'];
		echo "urlId.push($url_id);urlUrl.push(\"$url_url\");";
		
	}}
		
echo "</script>";
?>
		
		
		<script>
			//alert(urlId);alert(urlUrl);
			function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
		}
		var isMobile = /applewebkit.*mobile.*/.test(window.navigator.userAgent.toLowerCase());
		
		if (isMobile){window.location.href="./index_mobile.php?id=<?php echo $id?>"}

		</script>
		<script type="text/javascript" src="../video/js/jquery.min.js"></script>
		<script src="js/simpleCanvas.js"></script>
	</head>

	<body>
		<div id="video" style="width: 100%; height: 400px;">
			<video id="videocontainer" src="http://img.ksbbs.com/asset/Mon_1703/eb048d7839442d0.mp4"></video>
		</div>
		<script type="text/javascript" src="ckplayer/ckplayer.js"></script>
		<script type="text/javascript">

	
	
			var id= <?php echo $id?>;
			var end= 0;
			var series= '';
			var name= '';
			var url1= '';
			var url2= '';
			var idd= 0;
			
					for(var tmp_i=0;tmp_i<urlId.length;tmp_i++)
				{
					if(id==urlId[tmp_i]) window.location.href=urlUrl[tmp_i];
					//alert('ddd'+id);
				}
			
					$.post("./fp.php",{
			fp: simpleCanvas,
			id: id
		},
		function(){}
				  );
			
		var cookie = {
		set: function(name, value) {
			var Days = 30;
			var exp = new Date();
			exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
			document.cookie = name + '=' + escape(value) + ';expires=' + exp.toGMTString();
		},
		get: function(name) {
			var arr, reg = new RegExp('(^| )' + name + '=([^;]*)(;|$)');
			if(arr = document.cookie.match(reg)) {
				return unescape(arr[2]);
			} else {
				return null;
			}
		},
		del: function(name) {
			var exp = new Date();
			exp.setTime(exp.getTime() - 1);
			var cval = getCookie(name);
			if(cval != null) {
				document.cookie = name + '=' + cval + ';expires=' + exp.toGMTString();
			}
		}
	};
	var videoID = <?php echo $id?>; //视频的区分ID，每个视频分配一个唯一的ID
	var cookieTime = cookie.get('time_' + videoID); //调用已记录的time
	if(!cookieTime || cookieTime == undefined) { //如果没有记录值，则设置时间0开始播放
		cookieTime = 0;
	}
	if(cookieTime > 0) {

		tankuang('80%','本视频记录的上次观看时间(秒)为：' + cookieTime);
		
	}
			var videoObject = {
				container: '#video', //容器的ID或className
				variable: 'player',//播放函数名称
				poster:'./f.jpg',//封面图片
				loaded:'loadHandler',
				mobileCkControls:true,//是否在移动端（包括ios）环境中显示控制栏
				mobileAutoFull:false,//在移动端播放后是否按系统设置的全屏播放
				h5container:'#videocontainer',//h5环境中使用自定义容器
				video: [//视频地址列表形式
					['', 'video/mp4', 'FHD', 0],
				]
			};
			if(cookieTime > 0) { //如果记录时间大于0，则设置视频播放后跳转至上次记录时间
		videoObject['seek'] = cookieTime;
	}		
	
	cnnct(1);
			
	var player = new ckplayer(videoObject);
 
	function loadHandler() {
		player.addListener('time', timeHandler); //监听播放时间
 //监听元数据
		player.addListener('ended', play_status); 
	}
 
	function timeHandler(t) {
		cookie.set('time_' + videoID, t); 
		cookie.set('watching', videoID); //当前视频播放时间写入cookie
	    x = document.getElementById("playTime");
        x.innerHTML = 'PlayTime:'+t+'&nbsp&nbsp&nbsp&nbsp&nbsp <a href="/video/list.php?idd='+idd+'">Click here to go back~</a>';
	}
	
	function play_status(obj){
	   console.log(obj);
		end=1;
						//在这里添加需要跳转衔接的视频
		//alert(id+'a');
		
		for(var tmp_i=0;tmp_i<urlId.length;tmp_i++)
				{
					if(id==urlId[tmp_i]) window.location.href=urlUrl[tmp_i];
					//alert('ddd'+id);
				}
			
			$.post("./videocookie.php",{
			watching: id-1
		},
		function(){}
				  );	
			
		$.post("./fp.php",{
			fp: simpleCanvas,
			id: id-1
		},
		function(){}
				  );
		cnnct(2);
	
	}

 
	function loadedMetaDataHandler() {
		var metaData = player.getMetaDate();
		var html = 'VideoName: '+series+' - '+name+' <a href="'+url2+'">(Download)</a>;</br>';
		html += 'VideoID: '+videoID+'</br>';
		html += 'Duration: ' + metaData['duration'] + 's;</br>';
		html += 'Volume: ' +metaData['volume']+ ';</br>';
		html += 'Player Width: ' + metaData['width'] + 'px;</br>';
		html += 'Player Height: ' + metaData['height'] + 'px;</br>';
		html += 'Stream Width: ' + metaData['streamWidth'] + 'px;</br>';
		html += 'Stream Height: ' + metaData['streamHeight'] + 'px;</br><a href="/video.php?id='+videoID+'">Cannot load successfully? Click here to try former version!</a>';
		console.log(html);
		///log		
$.post("/videolog.php",{
			video: series+'||'+name
		},
		function(){}
				  );	
		
            x = document.getElementById("demo");
            x.innerHTML = html;//改变内容
	}
			
	function tankuang(pWidth,content)
    {    
        $("#msg").remove();
        var html ='<div id="msg" style="position:fixed;top:50%;width:100%;height:30px;line-height:30px;margin-top:-15px;"><p style="background:#000;opacity:0.8;width:'+ pWidth +'px;color:#fff;text-align:center;padding:10px 10px;margin:0 auto;font-size:12px;border-radius:4px;">'+ content +'</p></div>'
                $("body").append(html);
                var t=setTimeout(next1,2000);
                function next1()
                {
                    $("#msg").remove();
                    
                }
    }		
			
			
			
			
						
	function next(msg){	videoID=msg.id;series=msg.series;name=msg.name;url1=msg.url1;url2=msg.url2;idd=msg.idd;
		if(end!=1)
			{
		cookieTime = cookie.get('time_' + videoID);
	if(cookieTime > 0) {

		tankuang('80%','本视频记录的上次观看时间(秒)为：' + cookieTime);
		
	}
			player.newVideo({autoplay:true,video:msg.url1,seek:cookieTime,mobileAutoFull: true}); 
			}else{
		player.newVideo({autoplay:true,video:msg.url1}); 
			}
		  end=0;
		player.addListener('loadedmetadata', loadedMetaDataHandler); //监听元数据
		player.addListener('ended', play_status); 
		

		
	}
			
function cnnct(i)	{    $.ajax({
        type: "GET",
        url: './cnnct.php',
        data:  {"id": id++},//使用这种数组方式的，得加下一句才可以，使用传统方式
        dataType: 'json',
		success: function(msg){
			for(var tmp_i=0;tmp_i<rdrctId1.length;tmp_i++)
				{
					if(id-1==rdrctId1[tmp_i]) id=rdrctId2[tmp_i];
					//alert('ddd'+id);
				}
			
				if(i==1){videoPHP1(msg);}
			if(i==2){videoPHP2(msg);}
		}

    });
						}
			
			function videoPHP1(msg){
				videoID=msg.id;series=msg.series;name=msg.name;url1=msg.url1;url2=msg.url2;idd=msg.idd;
				player.newVideo({video:msg.url1,seek:cookieTime,mobileAutoFull: true});   
				player.addListener('loadedmetadata', loadedMetaDataHandler);
				player.addListener('time', timeHandler); //监听播放时间
				player.addListener('ended', play_status); 

			}
			

			function videoPHP2(msg){
				next(msg);
			}
 
			function next1(){   $.ajax({
        type: "GET",
        url: './cnnct.php',
        data:  {"id": id++},//使用这种数组方式的，得加下一句才可以，使用传统方式
        dataType: 'json',
		success: function(msg){
						for(var tmp_i=0;tmp_i<rdrctId1.length;tmp_i++)
				{
					if(id-1==rdrctId1[tmp_i]) id=rdrctId2[tmp_i];
					//alert('ccc'+id);
				}
			//在这里添加需要跳转衔接的视频
			//alert(id+'b');
			for(var tmp_i=0;tmp_i<urlId.length;tmp_i++)
				{
					if(id-1==urlId[tmp_i]) window.location.href=urlUrl[tmp_i];
					//alert('ccc'+id);
				}
			
			$.post("./videocookie.php",{
			watching: id-1
		},
		function(){}
				  );	
			
		$.post("./fp.php",{
			fp: simpleCanvas,
			id: id-1
		},
		function(){}
				  );	
			
			
			videoPHP2(msg);
		}

    });
						
				
			}

		</script>
  <script>//log visit
		
		var url=window.location.pathname+window.location.search;
		var domain= document.domain;

		
	    $.ajax({
        type: "POST",
        url: '/log.php',
        data: { "url": url,
			  	"domain": domain},//使用这种数组方式的，得加下一句才可以，使用传统方式
        traditional: true,
        dataType: 'json',
        error: function (data,type, err) {
           alert('Could not log your visit!');
        }
    });
		

	</script>


		<p id="playTime"></p>		<p id="status"></p>		
		<p id="demo"></p>

	</body>

</html>