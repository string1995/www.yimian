<?php

$AccessKey = "caa81f2271eeeb10";
$SecretKey = "91e74d006107bee0ea9ba99f5e657853";
	

 echo api__dogecloud("pch5","7119902f856c85a0","49.64.195.241",$AccessKey,$SecretKey);



//fnct for dogecloud API
function api__dogecloud($platform,$vcode,$ip,$AccessKey,$SecretKey){
	
	$url="https://api.dogecloud.com/video/streams.json?platform=$platform&vcode=$vcode&ip=$ip";
	
	$str="/video/streams.json?platform=pch5&vcode=7119902f856c85a0&ip=49.64.195.241"."\n";

	$str  = hash_hmac("sha1", $str, $SecretKey);
	
    $headerArray =array("Host:api.dogecloud.com","Authorization: TOKEN ".$AccessKey.":".$str);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
    $output = curl_exec($ch);
	if($errno = curl_errno($ch)) {
    	$error_message = curl_strerror($errno);
		echo "cURL error ({$errno}):\n {$error_message}";
	}

    curl_close($ch);
	
    return $output;
}

