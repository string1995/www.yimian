<?php
include './functions.php';

session_start();

db__pushData(db__connect(),"error",array("code"=>404,"time"=>time(),"fp"=>$_SESSION['s_fp'],"from"=>$_SERVER['HTTP_REFERER']));

echo file_get_contents("./etc/lovely-404/404.html");