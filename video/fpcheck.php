<?php
include '../functions.php';

$fp=$_REQUEST['fp'];

$res=db__getData(db__connect(),"fp","fp",$fp);

if($res[0]['video']) echo json_encode(array("code"=>1));


