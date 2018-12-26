<?php

include '../../functions.php';

$id= $_REQUEST[id];

$conn=db__connect();
$result=db__getData($conn,"videoredirect","id",$id);

header('Content-type: text/json');

if(count($result))
echo json_encode(array(id=>$result[0]['id'],toid=>$result[0]['toid']));
else json_encode(array(id=>0));
die();