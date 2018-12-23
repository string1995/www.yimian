

<?php //用户基础信息获取
$servername = "114.116.65.152";
$username = "yimian";
$password = "Lymian0904@112";
$dbname = "yimian";

?>

<?php  
$name5=$_POST['name5'];
$name="yimian";
$endtime=date('Y-m-d H:i:s',time());

$conn = new mysqli($servername, $username, $password, $dbname);
            $sql="UPDATE bug set endtime='$endtime' where name='$name5'"; 


	if ($conn->query($sql) === TRUE) {echo "<script>alert('记录已提交！世界因你而更美好！');window.location.href='dev.php'</script>";
   
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
           
            mysqli_close($conn);  
        ?>  