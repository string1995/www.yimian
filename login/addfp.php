<?php
$usr=$_GET['key'];

$fp=$_GET['fp'];

$time=time();


           $mydbhost = "114.116.65.152";  
            $mydbuser = "yimian";  
            $mydbpass = 'Lymian0904@112';  
            $conn = mysqli_connect($mydbhost, $mydbuser, $mydbpass);  
            if(! $conn){  
                die("connect error: " . mysqli_error($conn));  
            }  
            mysqli_select_db( $conn, 'yimian');  


$sql = "SELECT * FROM fp where fp='$fp'";
$result = $conn->query($sql);

 
if ($result->num_rows < 1)
{

           $sql="insert INTO fp (fp, videotime,usr) VALUES ('$fp',$time,'$usr')"; 
 
	
	if ($conn->query($sql) === TRUE) {} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}else
{
	            $sql="UPDATE fp SET videotime=$time,usr='$usr' WHERE fp='$fp'"; 
 
	
	if ($conn->query($sql) === TRUE) {} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}}
            mysqli_close($conn);  

