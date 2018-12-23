<?php

$fp=$_POST['fp'];




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

$return_array = array(id=>0);

header('Content-type: text/json');
echo json_encode($return_array);
die();
}else
{
$row = $result->fetch_assoc();

if(isset( $row['usr']))	
{
	$usr=$row['usr'];
	$sql = "SELECT * FROM fp where usr='$usr'";
	$result = $conn->query($sql);
	
	$usr_videotime=array();
	$usr_videoid=array();
	
	while($row = $result->fetch_assoc())
	{
		array_push($usr_videotime,$row['videotime']);
		array_push($usr_videoid,$row['video']);
	}
	
	$max=0;
	$maxtime=0;
	
	for($i=0;$i<count($usr_videotime);$i++)
	{
		if($usr_videotime[$i]>$maxtime) 
		{
			$maxtime=$usr_videotime[$i];
			$max=$usr_videoid[$i];
		}
	}
	

	
	$return_array = array(id=>$max);
		
	
	
}
else
{
$return_array = array(id=>$row['video']);
}

header('Content-type: text/json');
echo json_encode($return_array);
die();
}
 mysqli_close($conn);  

