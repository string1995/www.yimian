<?php

//fnct of connecting database::()::(database conn)

$servername = "114.116.65.152";
$username = "yimian";
$password = "Lymian0904@112";
$dbname = "yimian";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	

if ($conn->connect_error) 
{
    die("连接失败: " . $conn->connect_error);
} 


$sql = "SELECT * FROM ssr where port=0";

$result = $conn->query($sql);
///禁止非法访问
if ($result->num_rows > 0) {}else{echo "<script>alert('Illegal Visit!');setTimeout(function(){top.location='/404.php';},0)</script>";}



$row = $result->fetch_assoc();


$logFile= file_get_contents("log/ssr.log");

$logFile_Array=array();
$logFile_Name=array();

$ssr_limit=$row['passwd'];

for($i=8889;$i<=$ssr_limit;$i++)
{
$file_tmp=substr($logFile,strrpos($logFile,"TCP/$i:"),70);

$logFile_Array[$i]=substr($file_tmp,strpos($file_tmp,"s,")+3,strpos($file_tmp,"bytes")-1-(strpos($file_tmp,"s,")+3));

$logFile_Array[$i]+=0;
if($logFile_Array[$i]!=0)
{
$sql = "SELECT * FROM user where ssr='$i'";

$result = $conn->query($sql);
///禁止非法访问

$row = $result->fetch_assoc();
	
$logFile_Name[$i]=$row['name'];
}
$logFile_Array[$i]= number_format($logFile_Array[$i]/(1025*1025),2);
}



