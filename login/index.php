<?php
include '../functions.php';

session_start();

if(isset($_REQUEST['from']))
	$_SESSION['s_from']=$_REQUEST['from'];

yimian__header("Yimian Login","Login,Yimian,hhCandy,User","Page for old user to login or new user to sign up.");
js__jquery();
css__easyVer();
css__cleverLogin();
js__device();
yimian__headerEnd();

echo file_get_contents("../etc/clever-login/index.html");

js__cleverLogin();
yimian__simpleFooter();




