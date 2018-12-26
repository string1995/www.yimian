<?php

include '../../functions.php';

$id= $_REQUEST[id];

$conn=db__connect();
$result=db__getData($conn,"videotourl","id",$id);

header('Content-type: text/json');

if(count($result))
echo json_encode(array(id=>$result[0]['id'],url=>$result[0]['url'],hint=>$result[0]['hint']));
else json_encode(array(id=>0));
die();