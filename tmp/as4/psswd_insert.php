<!doctype html>

<?php
$del=$_GET['del'];
$psswd=$_GET['psswd'];
if($psswd=='') exit();

           $mydbhost = "114.116.65.152";  
            $mydbuser = "yimian";  
            $mydbpass = 'Lymian0904@112';  
            $conn = mysqli_connect($mydbhost, $mydbuser, $mydbpass);  
            if(! $conn){  
                die("connect error: " . mysqli_error($conn));  
            }  
            mysqli_select_db( $conn, 'yimian');  


$sql = "DELETE FROM as4pswd WHERE psswd='$del'";
$result = $conn->query($sql);


$sql = "SELECT * FROM as2pswd where psswd='$psswd'";
$result = $conn->query($sql);

 
if ($result->num_rows < 1)
{

            $sql="insert INTO as2pswd set psswd='$psswd'"; 
 
	
	if ($conn->query($sql) === TRUE) {} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
            mysqli_close($conn);  


?>
<html>
<head>
<meta charset="utf-8">
<title>psswd</title>
</head>

<body>
</body>
</html>