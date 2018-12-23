
<!DOCTYPE html>

<?php


header('content-type:text/html;charset=utf-8');
$conn=database_cnnct();

$id=$_GET['id'];

//get row info form table blog with id

for($i=1;$i<=4;$i++)
{
$row=sql_data($conn,'video','id',$id++);


///import row info to php var
$id[$i]= $row['id'];
$series[$i]= $row['series'];
$name[$i]= $row['name'];
$type[$i]= $row['type'];
$url1[$i]= $row['url1'];
$url2[$i]= $row['url2'];
$idd[$i]= $row['idd'];

}
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

function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

?>
<html>
    <head>
  <link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Yimian Video</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="index/css/bootstrap.min.css">
        <link rel="stylesheet" href="index/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="index/css/fontAwesome.css">
        <link rel="stylesheet" href="index/css/light-box.css">
        <link rel="stylesheet" href="index/css/owl-carousel.css">
        <link rel="stylesheet" href="index/css/templatemo-style.css">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

        <script src="index/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

<body>






        <div class="page-content">

	<div style="width:auto;height:200px;">
  <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width=auto height=200px 
  poster="MY_VIDEO_POSTER.jpg" data-setup="{}" autoplay>
    <source src="<?php echo $url1[1]?>" type='video/<?php echo $type[1]?>' > 
  </video>
</div>

                       <script language="javascript">

			
						var vList = ['<?php echo $url1[2]?>', '<?php echo $url1[3]?>', '<?php echo $url1[4]?>']; 	var vLen = vList.length; 				
						   var curr = 0; 											
						   var video = document.getElementById("my-video");						
						   var i=new Array();
						   i[0]="<h1><em><?php echo $series[2]?></em><?php echo $name[2]?> </h1>";
						   i[1]="<h1><em><?php echo $series[3]?></em><?php echo $name[3]?> </h1>";
						   i[2]="<h1><em><?php echo $series[4]?></em><?php echo $name[4]?> </h1>";
						   var log=new Array();
						   log[0]="<?php echo $series[2]?>||<?php echo $name[2]?>";
						   log[1]="<?php echo $series[3]?>||<?php echo $name[3]?>";
						   log[2]="<?php echo $series[4]?>||<?php echo $name[4]?>";
			
			video.addEventListener('ended', play);						play();						function play(e) {							video.src = vList[curr];							video.load(); 							video.play();			
																													  	document.getElementById('cntnt').innerHTML = i[curr];	
																													  					$.post("/videolog.php",{
			video: log[curr]
		},
		function(){}
				  );
																													 

																													  curr++;	if(curr >= vLen+1){curr = 0;	 window.location.href='./video.php?id=<?php echo $id;?>';}												
						
										}


			

			
			
			</script>




            <section id="video" class="content-section" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading" id='cntnt'>
							<h1><em><?php echo $series[1]?></em>  <?php echo $name[1]?> </h1>
						
                        </div>

                     </div>

                 </div>
				
                    <div class="col-md-12" style="width= 100%;">
						

						                    </div>
                </div>
            </section>
													<p><a href="<?php echo $url2[1]?>">Download Click Here!</a><br/><br/><a href="./video/list.php?idd=<?php echo $idd[1]?>">Click here to go back~</a></p>
            <section class="footer">
                <p>Copyright &copy; 2018.Yimian LIU. </p>
            </section>
        </div>



    <script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="index/js/vendor/bootstrap.min.js"></script>
    
    <script src="index/js/plugins.js"></script>
    <script src="index/js/main.js"></script>

    <script>
        // Hide Header on on scroll down
        var didScroll;
        var lastScrollTop = 0;
        var delta = 5;
        var navbarHeight = $('header').outerHeight();

        $(window).scroll(function(event){
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        function hasScrolled() {
            var st = $(this).scrollTop();
            
            // Make sure they scroll more than delta
            if(Math.abs(lastScrollTop - st) <= delta)
                return;
            
            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            if (st > lastScrollTop && st > navbarHeight){
                // Scroll Down
                $('header').removeClass('nav-down').addClass('nav-up');
            } else {
                // Scroll Up
                if(st + $(window).height() < $(document).height()) {
                    $('header').removeClass('nav-up').addClass('nav-down');
                }
            }
            
            lastScrollTop = st;
        }
    </script>

    <script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    
  <script src="https://vjs.zencdn.net/7.1.0/video.js"></script>
  <script type="text/javascript"> var player = videojs('video', { fluid: true }, function () {
           console.log('Good to go!');
           this.play(); // if you don't trust autoplay for some reason  
})</script>
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
		
					$.post("/videolog.php",{
			video:"<?php echo $series[1]?>||<?php echo $name[1]?>"
		},
		function(){}
				  );
	</script>

</body>
</html>