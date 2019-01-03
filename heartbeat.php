<?php
include './functions.php';

	
header("Access-Control-Allow-Origin: *");

$fp=$_REQUEST['fp'];
$ip=$_REQUEST['ip'];
$city=$_REQUEST['city'];
$from=$_SERVER['HTTP_REFERER'];
$domain=$_SERVER['HTTP_HOST'];

$conn=db__connect();

session_start();

$_SESSION['s_fp']=$fp;
$_SESSION['s_ip']=$ip;
setcookie("fp", $fp, time()+3600*24*365*15);

if(!isset($_SESSION['s_usrTel']))
{
	if(db__rowNum($conn,"fp","fp",$fp)) 
	{
		$r_usr=db__getData($conn,"fp","fp",$fp);
		
		if(db__rowNum($conn,"user","tel",$r_usr[0]['usr'])) 
		{
			$res=db__getData($conn,"user","tel",$r_usr[0]['usr']);
		
			$_SESSION['s_usrTel']=$r_usr[0]['usr'];
			$_SESSION['s_usr']=$res[0]['name'];
			$_SESSION['s_ssr']=$res[0]['ssr'];
		}
	}
	else
		db__pushData($conn,"fp",array("fp"=>$fp,"ip"=>$ip));
}

db__pushData($conn,"log",array("city"=>$city,"fp"=>$fp,"ip"=>$ip,"domain"=>$domain,"url"=>$from,"time"=>time()));

//echo json_encode(array("fp"=>$fp,"ip"=>$ip,"domain"=>$domain,"url"=>$from,"time"=>time()));
echo json_encode(array("usr"=>$_SESSION['s_usr'],"tel"=>$_SESSION['s_tel'],"fp"=>$_SESSION['s_fp'],"ip"=>$_SESSION['s_ip']));
