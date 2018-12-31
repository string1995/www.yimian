<?php
include '../functions.php';

session_start();

if(isset($_REQUEST['from']))
	$_SESSION['s_from']=$_REQUEST['from'];
if(isset($_COOKIE['fp']))
{
	$res=db__getData(db__connect(),"fp","fp",$_COOKIE['fp']);
	
	if($res[0]['usr']) 
	{
		$result=db__getData(db__connect(),"user","tel",$res[0]['usr']);
		echo "<script>alert('这只设备已被".$result[0]['name']."霸占啦~');window.location.href='https://cn.yimian.xyz/login/goBack.php'</script>";
	}
}

yimian__header("Yimian Login","Login,Yimian,hhCandy,User","Page for old user to login or new user to sign up.");
js__jquery();
css__easyVer();
css__cleverLogin();
js__device();
yimian__headerEnd();

echo file_get_contents("../etc/clever-login/index.html");

js__cleverLogin();
yimian__simpleFooter();




