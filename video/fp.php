<?php
$id=$_POST['id'];

$fp=$_POST['fp'];

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

           $sql="insert INTO fp (fp, video,videotime) VALUES ('$fp',$id,$time)"; 
 
	
	if ($conn->query($sql) === TRUE) {} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}else
{
	            $sql="UPDATE fp SET video=$id,videotime=$time WHERE fp='$fp'"; 
 
	
	if ($conn->query($sql) === TRUE) {} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}}
            mysqli_close($conn);  

