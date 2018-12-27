<?php

include '../../functions.php';

$id= $_REQUEST[id];

$conn=db__connect();
$result=db__getData($conn,"video","id",$id);

header('Content-type: text/json');
echo json_encode(array(id=>$result[0]['id'],series=>$result[0]['series'],name=>$result[0]['name'],type=>$result[0]['type'],url1=>$result[0]['url1'],url2=>$result[0]['url2'],idd=>$result[0]['idd'],vcode=>$result[0]['vcode']));
die();