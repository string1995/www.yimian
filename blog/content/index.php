<!DOCTYPE html>
<?php //main function

//get ip
$ip=getip();

//database connect
$conn=database_cnnct();

$id=$_GET['id'];

//get row info form table blog with id
$row=sql_data($conn,'blog','id',$id);


///import row info to php var
$id= $row['id'];
$title= $row['title'];
$class= $row['class'];
$date= $row['date'];
$abstract= $row['abstract'];
$content= $row['content'];
$like= $row['like'];
$share= $row['share'];
$commentCnt= $row['commenttime'];
$comment= $row['comment'];

//trans data to eng vsion
$dateEng=date("H:i:s    j  M, Y",$date);

//remove 0 in front of int var
$id=preg_replace('/^0+/','',$id);
$like=preg_replace('/^0+/','',$like);
$share=preg_replace('/^0+/','',$share);
$commentCnt=preg_replace('/^0+/','',$commentCnt);
	
$comment_array = explode("|||", $comment);

mysqli_close($conn); //close database

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

<html lang="en">
<head>
<meta charset="UTF-8">
<title>Yimian Blog - <?php echo $title?></title>

<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="stylesheet" href="styles/style.css" media="screen" />
<link rel="stylesheet" href="styles/media-queries.css" />
<link rel="stylesheet" href="./flex-slider/flexslider.css" type="text/css" media="screen" />
<link href="styles/prettyPhoto.css" rel="stylesheet" type="text/css" media="screen" />
<link href="styles/tipsy.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" src="./scripts/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="./flex-slider/jquery.flexslider-min.js"></script>
<script src="scripts/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="scripts/jquery.tipsy.js" type="text/javascript"></script>
<script src="scripts/jquery.knob.js" type="text/javascript"></script>
<script type="text/javascript" src="./scripts/jquery.isotope.min.js"></script>
<script type="text/javascript" src="./scripts/jquery.smooth-scroll.min.js"></script>
<script type="text/javascript" src="./scripts/waypoints.min.js"></script>
<script type="text/javascript" src="./scripts/setup.js"></script>


</head>
<body>
<div id="wrap"> 
  <!-- wrapper -->
  <div id="sidebar"> 
    <!-- the  sidebar --> 
    <!-- logo --> 
    <a href="../../index.php" id="logo"> <img src="../images/logo/logo_white.png" alt="Yimian" /></a> 
    <!-- navigation menu -->
    <ul id="navigation">
      <li><a href="#home" class="active"></a></li>
	  <li><a href="../">Recent Blogs</a></li>
	  <li><a href="../tag.php?tag=<?php echo $class?>">Similar Blogs</a></li>
      <li><a href="../../cv/">About Me</a></li>
      <li><a href="../contact.php">Contact Me</a></li>
    </ul>
  </div>
  <div id="container"> 
    <!-- page container -->
    <div class="page" id="home"> 
      <!-- page home -->
   <div class="page_content">
        <div class="gf-slider"> 
          <!-- slider -->
          <ul class="slides">
            <li> <img src="https://obs-410c.obs.myhwclouds.com/html/cn/www/blog/images/blog/<?php echo $id;?>.jpg" alt="<?php echo $title?>" />
              <p class="flex-caption"><?php echo $abstract?></p>
            </li>
          </ul>
        </div>
        <div class="space"> </div>
        <div class="clear"> </div>
        <!-- services -->
      </div>
    </div>
    <div class="page" id="about"> 
      <!-- page about -->
      <h3 class="page_title"><?php echo $title?></h3>
      <div class="page_content">
		<p><b> Last Edited: <?php echo $dateEng?> UTC</b></p>
        <p> <?php echo $abstract?></p>
       <?php echo $content;?>
        <div class="clear"> </div>
      </div>
    </div>
    <div class="page" id="contact"> 
      <!-- page contact -->
      <h3 class="page_title"> Comments</h3>
	  <div class="page_content">
	
		  
	<?php
		  
	
		  for($i=1;$i<count($comment_array);$i+=4)
{
			  
		  echo '<p>Comment At &nbsp;'.date("H:i:s    j  M, Y",$comment_array[$i+2]).' UTC</p>
	     <blockquote>'.$comment_array[$i+3].'
          <p><br/> <small>by <b>'.$comment_array[$i].'</b>  <a href="mailto:'.$comment_array[$i+1].'?subject=About Your Comment on '.$title.', Yimian Blog&body=Dear '.$comment_array[$i].': ">('.$comment_array[$i+1].')</a></small></p>
        </blockquote><br/>';
		  
}	
		  
	if(count($comment_array)<2){echo 'No Comment Yet!';}
		  
		  ?>
	  </div>
		
	  <h3 class="page_title">Add Comments</h3>
      <div class="page_content">
        <fieldset id="contact_form">
          <div id="msgs"> </div>
          <form id="cform" name="cform" method="post" action="">
			<input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="text" id="name" name="name" value="Full Name*" onFocus="if(this.value == 'Full Name*') this.value = ''"
                            onblur="if(this.value == '') this.value = 'Full Name*'" />
            <input type="text" id="email" name="email" value="Email Address*" onFocus="if(this.value == 'Email Address*') this.value = ''"
                            onblur="if(this.value == '') this.value = 'Email Address*'" />
            <textarea id="msg" name="message" onFocus="if(this.value == 'Your Message*') this.value = ''"
                            onblur="if(this.value == '') this.value = 'Your Message*'">Your Message*</textarea>
            <button id="submit" class="button"> Add Your Comment</button>
          </form>
        </fieldset>
        <div class="clear"> </div>
        <ul class="social_icons">
          <li><a href="https://github.com/string1995" id="fb" original-title="Find Me on Github"> <img src="images/github.png" alt="Github" /></a></li>
          <li><a href="https://twitter.com/lymian0904" id="tw" original-title="Follow Me on Twitter"> <img src="images/twitter.png" alt="Twitter" /></a></li>
          <li><a href="https://www.linkedin.com/in/yimian/" id="ld" original-title="Find Me on LinkedIn"> <img src="images/linkedin.png" alt="LinkedIn" /></a></li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p> Copyright &copy; 2018.Yimian LIU All Rights Reserved.</p>
    </div>
  </div>
</div>
<a class="gotop" href="#top">Top</a>
    <script>//log visit
		
		var url=window.location.pathname+window.location.search;
		var domain= document.domain;

		
	    $.ajax({
        type: "POST",
        url: '/log.php',
        data: { "url": url,
			  	"domain": domain},//使用这种数组方式的，得加下一句才可以，使用传统方式
        traditional: true,
        dataType: 'json',
        error: function (data,type, err) {
           alert('Could not log your visit!');
        }
    });
	</script>

</body>
</html>
