<?php
include '../../functions.php';


$code=$_REQUEST['code'];
$tel=$_REQUEST['tel'];

//database connect
$conn=db__connect();

//no such code
if(db__rowNum($conn,"sms","val",$code)==0) {echo json_encode(array(code=>-2));die();};


//get row info form table blog with id
$result=db__getData($conn,"sms","val",$code);


$time=$result[0]['time'];

//success
if($time>(time()-130)&&$time<time()&&$tel==$result[0]['tel']){echo json_encode(array(code=>0));}

//code out of time
elseif($tel==$result[0]['tel']){echo json_encode(array(code=>-1));}

//code is of other people
else{json_encode(array(code=>-3));}

die();