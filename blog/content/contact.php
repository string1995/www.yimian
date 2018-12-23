<?php 

// EDIT THE FOLLOWING LINE BELOW AS REQUIRED


function comment_insert($id,$name,$email,$message)
{

//database connect
	$conn=database_cnnct();
	
	$row=sql_data($conn,'blog','id',$id);
	
	$message_fore= $row['comment'];
	$cnt= $row['commenttime'];
	
	$cnt++;
	
	
	$message= $message_fore.'|||'.$name.'|||'.$email.'|||'.time().'|||'.$message;
	
	
	$sql="UPDATE blog set comment='$message',commenttime='$cnt' where id='$id' ";
	
	if ($conn->query($sql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $conn->error;}
	
}



$send_email_to = "admin@#";

function send_email($name,$email,$id,$email_message)
{
  global $send_email_to;  


  comment_insert($id,$name, $email, $email_message);
  return true;
}

function validate($name,$email,$message,$subject)
{
  $return_array = array();
  $return_array['success'] = '1';
  $return_array['name_msg'] = '';
  $return_array['email_msg'] = '';
  $return_array['message_msg'] = '';
  $return_array['subject'] = '';

 if($email == '')
  {
    $return_array['success'] = '0';
    $return_array['email_msg'] = 'email is required';
  }
  else
  {
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email)) {
      $return_array['success'] = '0';
      $return_array['email_msg'] = 'enter valid email.';  
    }
  }

  if($name == '')
  {
    $return_array['success'] = '0';
    $return_array['name_msg'] = 'name is required';
  }
  else
  {

  }


  
  if($message == '')
  {
    $return_array['success'] = '0';
    $return_array['message_msg'] = 'message is required';
  }
  else
  {
    if (strlen($message) < 2) {
      $return_array['success'] = '0';
      $return_array['message_msg'] = 'enter valid message.';
    }
  }
  return $return_array;
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$id= $_POST['id'];

$return_array = validate($name,$email,$message,$subject);
if($return_array['success'] == '1')
{
  send_email($name,$email,$id,$message);
}

header('Content-type: text/json');
echo json_encode($return_array);
die();

?>

<?php //declear function


//fnct of get usr ip::()::(ip)
function getip() 
{
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
	{
		$ip = getenv("HTTP_CLIENT_IP");
	} 
	else
		if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
		{
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		}
		else
			if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
			{
				$ip = getenv("REMOTE_ADDR");
			} 
			else
				if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
				{
					$ip = $_SERVER['REMOTE_ADDR'];
				} 
				else 
				{
					$ip = "unknown";
				}
return ($ip);
}


//fnct of connecting database::()::(database conn)
function database_cnnct ()
{
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

return ($conn);
}


//fnct of get table row number::(data_cnnct var,table name) ::(row number)
function sql_rowNum($conn,$tableSql)
{
$row_count = $conn->query("SELECT COUNT(*) FROM $tableSql");   
list($row_num) = $row_count->fetch_row(); 
return ($row_num);
}

//fnct of getting row data from database::(data_cnnct var, table name,column name, column value)::(row info)
function sql_data($conn,$table,$clmnName,$value)
{
$sql = "SELECT * FROM $table where $clmnName=$value";

$result = $conn->query($sql);
///禁止非法访问
if ($result->num_rows > 0) {}else{echo "<script>alert('Illegal Visit!');setTimeout(function(){top.location='/404.php';},0)</script>";}

$row = $result->fetch_assoc();

return ($row);

}

?>
