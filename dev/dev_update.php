



<?php  
$name5=$_GET['name5'];
$name="yimian";

$hosttime=date('Y-m-d H:i:s',time());
  
            $mydbhost = "114.116.65.152";  
            $mydbuser = "yimian";  
            $mydbpass = 'Lymian0904@112';  
            $conn = mysqli_connect($mydbhost, $mydbuser, $mydbpass);  
            if(! $conn){  
                die("connect error: " . mysqli_error($conn));  
            }  
            mysqli_select_db( $conn, 'yimian');  

            $sql="UPDATE bug set host='$name', hosttime='$hosttime' where name='$name5'"; 
 
	
	if ($conn->query($sql) === TRUE) {echo "<script>alert('认领成功！请尽快处理！');window.location.href='dev.php'</script>";
   
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
           
            mysqli_close($conn);  
        ?>  