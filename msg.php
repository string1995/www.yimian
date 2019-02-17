<?php
header('Access-Control-Allow-Origin:*');

require __DIR__ . "/qcloudsms/src/index.php";

use Qcloud\Sms\SmsSingleSender;
use Qcloud\Sms\SmsMultiSender;
use Qcloud\Sms\SmsVoiceVerifyCodeSender;
use Qcloud\Sms\SmsVoicePromptSender;
use Qcloud\Sms\SmsStatusPuller;
use Qcloud\Sms\SmsMobileStatusPuller;

use Qcloud\Sms\VoiceFileUploader;
use Qcloud\Sms\FileVoiceSender;
use Qcloud\Sms\TtsVoiceSender;

$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];

if($msg3==15){$msg3=substr(microtime(),-6);}



$tel=$_REQUEST['tel'];
$tpl=$_REQUEST['tpl'];

// 短信应用SDK AppID
$appid = 1400146012; // 1400开头

// 短信应用SDK AppKey
$appkey = "9625017dc9604dda8514af6e80911ee6";

// 需要发送短信的手机号码
$phoneNumbers = [$tel];

// 短信模板ID，需要在短信应用中申请
if($tpl==1){
$templateId = 205311;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

// 签名
$smsSign = "Yimian"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

try {
    $ssender = new SmsSingleSender($appid, $appkey);
    $params = [$msg1,$msg2,$msg3];
    $result = $ssender->sendWithParam("86", $phoneNumbers[0], $templateId,
        $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
    $rsp = json_decode($result);
   echo $result;
} catch(\Exception $e) {
    echo var_dump($e);
}
echo "\n";

$conn=database_cnnct();

$ip= getip();

$time=time();

$shu='||';
$cnnct=$msg1.$shu.$msg2.$shu.$msg3.$shu.$result;

$tel=$_POST['tel'];

$sql="INSERT sms set ip='$ip',time=$time,tel='$phoneNumbers[0]',tpl='$tpl',val='$msg3',cnnct='$cnnct' ";
	
	if ($conn->query($sql) === TRUE) {$return_array = array(status=>1);}
}


// 短信模板ID，需要在短信应用中申请
if($tpl==2){
$templateId = 223060;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

// 签名
$smsSign = "Yimian"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

try {
    $ssender = new SmsSingleSender($appid, $appkey);
    $params = [$msg1,$msg2,"VPN",$msg3];
    $result = $ssender->sendWithParam("86", $phoneNumbers[0], $templateId,
        $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
    $rsp = json_decode($result);
   echo $result;
} catch(\Exception $e) {
    echo var_dump($e);
}
echo "\n";

$conn=database_cnnct();

$ip= getip();

$time=time();

$shu='||';
$cnnct=$msg1.$shu.$msg2.$shu.$msg3.$shu.$result;

$tel=$_POST['tel'];

$sql="INSERT sms set ip='$ip',time=$time,tel='$phoneNumbers[0]',tpl='$tpl',val='$msg3',cnnct='$cnnct' ";
	
	if ($conn->query($sql) === TRUE) {$return_array = array(status=>1);}
}

// 短信模板ID，需要在短信应用中申请
if($tpl==3){
$templateId = 244004;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

// 签名
$smsSign = "Yimian"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

try {
    $ssender = new SmsSingleSender($appid, $appkey);
    $params = [$msg1,"VPN"];
    $result = $ssender->sendWithParam("86", $phoneNumbers[0], $templateId,
        $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
    $rsp = json_decode($result);
   echo $result;
} catch(\Exception $e) {
    echo var_dump($e);
}
echo "\n";

$conn=database_cnnct();

$ip= getip();

$time=time();

$shu='||';
$cnnct=$msg1.$shu.$msg2.$shu.$msg3.$shu.$result;

$tel=$_POST['tel'];

$sql="INSERT sms set ip='$ip',time=$time,tel='$phoneNumbers[0]',tpl='$tpl',val='$msg3',cnnct='$cnnct' ";
	
	if ($conn->query($sql) === TRUE) {$return_array = array(status=>1);}
}


// 短信模板ID，需要在短信应用中申请
if($tpl==4){
$templateId = 278516;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

// 签名
$smsSign = "Yimian"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
$params = [];
	
try {
    $ssender = new SmsSingleSender($appid, $appkey);
    $result = $ssender->sendWithParam("86", $phoneNumbers[0], $templateId, $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
    $rsp = json_decode($result);
   echo $result;
} catch(\Exception $e) {
    echo var_dump($e);
}
echo "\n";

$conn=database_cnnct();

$ip= getip();

$time=time();

$shu='||';
$cnnct="加水";

$tel=$_POST['tel'];

$sql="INSERT sms set ip='$ip',time=$time,tel='$phoneNumbers[0]',tpl='$tpl',cnnct='$cnnct' ";
	
	if ($conn->query($sql) === TRUE) {$return_array = array(status=>1);}
}

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

?>
									  
