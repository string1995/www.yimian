<?php
include '../../functions.php';

$tel=$_REQUEST['tel'];
$fp=$_REQUEST['fp'];
$ip=$_REQUEST['ip'];

$conn=db__connect();

if(db__rowNum($conn,"user","tel",$tel)) 
{
	echo json_encode(array(code=>0));
	
	$result=db__getData($conn,"user","tel",$tel);
	
	db__pushData($conn,"user",array("count"=>$result[0]['count']+1,"ip"=>$ip),array("tel"=>$tel));
}
else 	
{
	echo json_encode(array(code=>1));
	
	$result=db__getData($conn,"ssr","port",0);
	
	$port=$result[0]['passwd']+1;
	
	db__pushData($conn,"user",array("tel"=>$tel,"time"=>time(),"count"=>1,"ip"=>$ip,"ssr"=>$port));
	
	db__pushData($conn,"ssr",array("passwd"=>$port),array("port"=>0));
}

db__pushData($conn,"fp",array("usr"=>$tel,"fp"=>$fp),array("fp"=>$fp));

die();