<?php

include '../../functions.php';

$id= $_REQUEST[id];
$fp= $_REQUEST[fp];
$seek= $_REQUEST[seek];
$ip= $_REQUEST[ip];

$conn=db__connect();

if(!db__rowNum($conn,"fp","fp",$fp)) 
db__pushData($conn,"fp",array("fp"=>$fp,"videoseek"=>$seek,"video"=>$id,"ip"=>$ip,"videotime"=>time()));
else
db__pushData($conn,"fp",array("fp"=>$fp,"videoseek"=>$seek,"video"=>$id,"ip"=>$ip,"videotime"=>time()),array("fp"=>$fp));


db__pushData($conn,"videolog",array("ip"=>$ip,"fp"=>$fp,"seek"=>$seek,"video"=>$id,"time"=>time()),array("fp"=>$fp,"video"=>$id));

header('Content-type: text/json');

die();