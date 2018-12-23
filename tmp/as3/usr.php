<?php

           $mydbhost = "114.116.65.152";  
            $mydbuser = "yimian";  
            $mydbpass = 'Lymian0904@112';   
            $conn = mysqli_connect($mydbhost, $mydbuser, $mydbpass);  
            if(! $conn){  
                die("connect error: " . mysqli_error($conn));  
            }  
            mysqli_select_db( $conn, 'yimian');  

$sql = "SELECT * FROM as2";
$result = $conn->query($sql);
   while($row = $result->fetch_assoc()) {

	   echo $row['usr'];
	   echo "
";
		
    }
?>