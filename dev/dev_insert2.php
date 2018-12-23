

<?php //用户基础信息获取
$servername = "114.116.65.152";
$username = "yimian";
$password = "Lymian0904@112";
$dbname = "yimian";
 
?>

<?php  
$name5=$_POST['name5'];
$detail=$_POST['detail'];
$starttime=date('Y-m-d H:i:s',time());
  
            $mydbhost = "114.116.65.152";  
            $mydbuser = "yimian";  
            $mydbpass = 'Lymian0904@112';  
            $conn = mysqli_connect($mydbhost, $mydbuser, $mydbpass);  
            if(! $conn){  
                die("connect error: " . mysqli_error($conn));  
            }  
            mysqli_select_db( $conn, 'yimian');  

            $sql="INSERT INTO bug set  name='$name5',starttime='$starttime',detail='$detail' "; 
 
	
	if ($conn->query($sql) === TRUE) {echo "<script>alert('发布成功！');window.location.href='dev.php'</script>";
   
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
           
            mysqli_close($conn);  
        ?>  