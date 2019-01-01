
<?php
include './functions.php';

//fnct of connecting database::()::(database conn)

$conn=db__connect();


$str='';

$count_total=0;
$ip=array();
$hh_ip=array();
$hh_count=0;


echo $time;

$sql = "SELECT * FROM log";

$result = $conn->query($sql);
///禁止非法访问
if ($result->num_rows > 0) {}else{echo "<script>alert('Illegal Visit!');setTimeout(function(){top.location='/404.php';},0)</script>";}

$address=array();

for($i=0;$i<$result->num_rows;$i++)
{
$row = $result->fetch_assoc();


if($row['time']>(time()-86400)){ 
	
		

		if(!in_array($row['ip'],$ip)){
			
		if(!in_array($address,$row['city'])) array_push($address,$row['city']);
		
	
			array_push($ip,$row['ip']);
		
		}
	   if($row['url']=="https://cn.yimian.xyz/") 
	   {
		   $hh_count++;
		   if(!in_array($row['ip'],$hh_ip)) array_push($hh_ip,$row['ip']);
	   }
	
	$count_total++;

	}
}


///统计video ip

$video_count_total=0;
$video_ip=array();


$sql = "SELECT * FROM videolog";

$result = $conn->query($sql);
///禁止非法访问


for($i=0;$i<$result->num_rows;$i++)
{
$row = $result->fetch_assoc();


if($row['time']>(time()-86400)){ 
	

		if(!in_array($row['ip'],$video_ip)){
	
			array_push($video_ip,$row['ip']);
		
		}
	
	$video_count_total++;

	}
}




///统计video ip下观看内容
$video_txt=array();

for($_i=0;$_i<count($video_ip);$_i++)
{
$sql = "SELECT * FROM videolog WHERE ip='$video_ip[$_i]'";

$result = $conn->query($sql);
///禁止非法访问
$video_txt_tmp=array();

for($i=0;$i<$result->num_rows;$i++)
{
$row = $result->fetch_assoc();


if($row['time']>(time()-86400)){ 
	

		if(!in_array($row['video'],$video_txt_tmp)){
			$tmp=$row['video'];
			$time2=$row['time'];
			$time2=date('H:i:s', $time2+28800);
			//$res=db__getData($conn,"video","id",$tmp);
			//$tmp=$res[0]['series']." | ".$res[0]['name'];
			$tmp="$tmp   $time2 ".number_format(($row['seek']/60),2)."分钟";
			array_push($video_txt_tmp,$tmp);	}
}
}

for($i=0;$i<count($video_txt_tmp);$i++)
{
	
$video_txt[$_i]="$video_txt[$_i]$video_txt_tmp[$i]'+xie+'";
}
}


///统计ssr

$ssr_count_total=0;
$ssr_ip=array();
$ssr_tel=array();
$ssr_time=array();

$sql = "SELECT * FROM sms";

$result = $conn->query($sql);
///禁止非法访问


for($i=0;$i<$result->num_rows;$i++)
{
$row = $result->fetch_assoc();


if($row['time']>(time()-86400)){ 
	

		if(!in_array($row['ip'],$ssr_ip)){
	
			array_push($ssr_ip,$row['ip']);
			
			array_push($ssr_tel,$row['tel']);
			
			$time2=$row['time'];
			$time2=date('H:i:s', $time2+28800);
			
			array_push($ssr_time,$time2);
			
			
		}
		
	
	
	
		
		
		
		
	
	$ssr_count_total++;

	}
}

$ssr_name=array();
for($i=0;$i<count($ssr_tel);$i++)
{
	$sql = "SELECT * FROM user where tel='$ssr_tel[$i]'";

$result = $conn->query($sql);
///禁止非法访问
if ($result->num_rows > 0) {}else{}

$row = $result->fetch_assoc();

$ssr_name[$i]=$row['name'];
}


///统计ssr流量
$sql = "SELECT * FROM ssr where port=0";

$result = $conn->query($sql);
///禁止非法访问
if ($result->num_rows > 0) {}else{echo "<script>alert('Illegal Visit!');setTimeout(function(){top.location='/404.php';},0)</script>";}



$row = $result->fetch_assoc();


$logFile_usa= file_get_contents("log/usa/ssr.log");
$logFile_aus= file_get_contents("log/aus/ssr.log");

$logFile_Array=array();
$logFile_Array_usa=array();
$logFile_Array_aus=array();
$logFile_Name=array();

$ssr_limit=$row['passwd'];
$ssr_lift=8990-$ssr_limit;

for($i=8889;$i<=$ssr_limit;$i++)
{

$file_tmp=substr($logFile_usa,strrpos($logFile_usa,"TCP/$i:"),70);

$logFile_Array_usa[$i]=substr($file_tmp,strpos($file_tmp,"s,")+3,strpos($file_tmp,"bytes")-1-(strpos($file_tmp,"s,")+3));

$logFile_Array_usa[$i]+=0;
	
$file_tmp=substr($logFile_aus,strrpos($logFile_aus,"TCP/$i:"),70);

$logFile_Array_aus[$i]=substr($file_tmp,strpos($file_tmp,"s,")+3,strpos($file_tmp,"bytes")-1-(strpos($file_tmp,"s,")+3));

$logFile_Array_aus[$i]+=0;
	
$logFile_Array[$i]=$logFile_Array_usa[$i]+$logFile_Array_aus[$i];
if($logFile_Array[$i]!=0)
{
$sql = "SELECT * FROM user where ssr='$i'";

$result = $conn->query($sql);
///禁止非法访问

$row = $result->fetch_assoc();
	
$logFile_Name[$i]=$row['name'];
}
$logFile_Array[$i]= number_format($logFile_Array[$i]/(1025*1025),2);
}




function getIpInfo($internetIp = '')
{
    try
    {
        //内网IP
        //  A类10.0.0.0～10.255.255.255
        //  B类172.16.0.0～172.31.255.255
        //  C类192.168.0.0～192.168.255.255
        //  ......
        $bLocalIp = !filter_var($internetIp, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
        if($bLocalIp)
            $internetIp = 'myip';//局域网IP

        $requestAPi = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $internetIp;
        $opts       = array(
            'http' => array(
                'method'  => 'GET',
                'timeout' => 1, // 单位秒
            )
        );
        $jsonArr = json_decode( file_get_contents($requestAPi, false, stream_context_create($opts)),
            JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS );

        // 说明断网
        if (!isset($jsonArr) || !isset($jsonArr['code']))
        {
            return false;
        }

        // 0 表示成功
        if ($jsonArr['code'] !== 0)
        {
            return false;
        }

        // 返回的数据结果：
        //  "ip": "223.98.166.115",
        //  "country": "中国",
        //  "area": "",
        //  "region": "山东",
        //  "city": "济南",
        //  "county": "XX",
        //  "isp": "移动",
        //  "country_id": "CN",
        //  "area_id": "",
        //  "region_id": "370000",
        //  "city_id": "370100",
        //  "county_id": "xx",
        //  "isp_id": "100025"
        $data = (array)$jsonArr['data'];
        return $data;
    }
    catch (\Exception $e)
    {

    }

    return false;
}


?>
<html>
<head>
<meta charset="utf-8">

<title>Yimian Logger</title>
<script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script>

	var data='总站统计：\n\n访问人数：<?php echo count($ip);?>\n总访问次数：<?php echo $count_total;?>\n\n访问者：<?php for($i=0;$i<count($ip);$i++){echo $ip[$i];echo ", ";}?>\n\n访问者来源：\n<?php foreach($address as $q) if($q!="")echo $q.", ";?>\n-------------------------\n\nhhCandy 统计：\n\n访问次数：<?php echo $hh_count?>\n\n访问者：<?php foreach($hh_ip as $p) echo $p.", ";?>\n-------------------------\n\nYimian Video 统计：\n\n访问人数：<?php echo count($video_ip);?>\n总访问次数：<?php echo $video_count_total;?>\n\n访问者：\n';
	
	var xie='\n';
	
	<?php for($i=0;$i<count($video_ip);$i++){echo "data=data+'$video_ip[$i]'+xie+'$video_txt[$i]'+xie;";}?>
	
	
	data=data+'-------------------------\nYimian SSR统计：\n\n访问人数：<?php echo count($ssr_ip);?>\n总访问次数：<?php echo $ssr_count_total;?>\n剩余端口数：<?php echo $ssr_lift?>\n\n访问者：\n';
	
		<?php for($i=0;$i<count($ssr_ip);$i++){echo "data=data+'$ssr_ip[$i] $ssr_tel[$i] $ssr_name[$i] $ssr_time[$i]'+xie;";}?>
	
	data=data+'\n历史流量统计：\n';
	
		<?php for($i=8889;$i<$ssr_limit;$i++){if($logFile_Array[$i]!=0.00){
	echo "data=data+'$logFile_Name[$i]：$logFile_Array[$i]MB'+xie;";}}?>
	
var str=data;
	
	/*
	
	
	    $.ajax({
        type: "POST",
        url: 'https://mail.yimian.xyz/log.php',
        data: { "to": "admin@yimian.xyz",
    		   "subject": "<?php echo date("Y-m-d",time());?> 网站日志",
			   "message": data,
			   "from": "root@yimian.xyz",
			   "str": str
			  },
        traditional: true,
        dataType: 'json',
		success: function(msg){
			alert(msg.text);
		}
    });*/
</script>
	</head>
	<body>
		<form name="form" action="https://mail.yimian.xyz/log.php" method="POST">
		
		<input type="hidden" name="message" value="" id="msg"/>
		<input type="hidden" name="str" value="" id="str_"/>
		
		</form>

			<script>
			
			

document.getElementById('msg').value=data;
document.getElementById('str_').value=str;
				
document.form.submit();
			
			</script>
			
			
			
			
			</body>
</html>