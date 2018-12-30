<?php
include './functions.php';

$fp=$_REQUEST['fp'];
$ip=$_REQUEST['ip'];
$from=$_SERVER['HTTP_REFERER'];
$domain=$_SERVER['HTTP_HOST'];

session_start();

$_SESSION['s_fp']=$fp;
$_SESSION['s_ip']=$ip;

db__pushData(db__connect(),"log",array("fp"=>$fp,"ip"=>$ip,"domain"=>$domain,"url"=>$from,"time"=>time()));

//echo json_encode(array("fp"=>$fp,"ip"=>$ip,"domain"=>$domain,"url"=>$from,"time"=>time()));

