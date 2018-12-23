<!DOCTYPE html>

<?php //main function

//get ip
$ip=getip();

//database connect
$conn=database_cnnct();

//get row number from table
$row_num=sql_rowNum($conn,'blog');

$row_overall=array();


for($i=1;$i<=$row_num;$i++)
{

//get row info form table blog with id
$row=sql_data($conn,'blog','id',$i);

$row_overall[$i-1]= $row;

///import row info to php var
$id[$i]= $row['id'];
$title[$i]= $row['title'];
$class[$i]= $row['class'];
$date[$i]= $row['date'];
$abstract[$i]= $row['abstract'];
$like[$i]= $row['lik'];
$share[$i]= $row['share'];
$click[$i]= $row['click'];
$commentCnt[$i]= $row['commenttime'];

//trans data to eng vsion
$dateEng[$i]=date(" j  M, Y",$date[$i]);
$monthEng[$i]= date(" F Y",$date[$i]);
	
//remove 0 in front of int var
$id[$i]=preg_replace('/^0+/','',$id[$i]);
$like[$i]=preg_replace('/^0+/','',$like[$i]);
$share[$i]=preg_replace('/^0+/','',$share[$i]);
$commentCnt[$i]=preg_replace('/^0+/','',$commentCnt[$i]);
$click[$i]=preg_replace('/^0+/','',$click[$i]);

}

$tag[0]= $class[0];
$tagNum= 1;
for($i=0;$i<count($class);++$i)
{
if(!in_array("$class[$i]", $tag)){$tag[$tagNum++]=$class[$i];}
}


$month[0]= $monthEng[0];
$monthNum= 1;
for($i=0;$i<count($monthEng);$i++)
{
	if(!in_array("$monthEng[$i]",$month)){$month[$monthNum++]=$monthEng[$i];}
}


$row_click=array_orderby($row_overall, 'click', SORT_DESC);


$clickSort= array();
$clickSort=array_column($row_click,'id');


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




<html lang="en">
<head>
<meta charset="UTF-8">
<!-- For IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- For Resposive Device -->
<meta name="viewport" content="width=device-width,initial-scale=1" />
<!-- For Window Tab Color -->
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#2c2c2c">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#2c2c2c">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#2c2c2c">

<title>Yimian Blog</title>

<!-- Main style sheet -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- responsive style sheet -->
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<!-- Theme-Color css -->
<link rel="stylesheet" id="jssDefault" href="css/color.css">


<!-- Fix Internet Explorer ______________________________________-->

<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="vendor/html5shiv.js"></script>
	<script src="vendor/respond.js"></script>
<![endif]-->

	
</head>

<body>
<div class="search-box" id="searchWrapper">
	<div id="close-button"></div>
	<div class="container">
		<form action="#">
			<div class="greeting-text"><span class="greeting"></span></div>
			<div class="input-wrapper">
				<input type="text" placeholder="type your keyword" autofocus>
			</div>
		</form>
	</div>
</div> <!-- /.search-box -->


<div class="main-page-wrapper">
	<!-- ===================================================
		Loading Transition
	==================================================== -->
	<div id="loader-wrapper">
		<div id="loader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>


	<!-- ==================== Style Switcher ==================== -->
	<div class="switcher">
		<!-- Switcher button -->
		<div class="switch-btn">
			<button><i class="fas fa-cog fa-spin"></i></button>
		</div>

		<!-- switcher body -->
		<div class="switch-menu">
			<h5 class="title">Style Switcher</h5>						
			<!-- Theme color changer -->
			<div class="switcher-container">
				<h5>Color Skins</h5>
				<ul id="styleOptions" title="Switch Color" class="clearfix">
					<li><a href="javascript: void(0)" data-theme="color" class="color1"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-2" class="color2"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-3" class="color3"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-4" class="color4"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-5" class="color5"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-6" class="color6"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-7" class="color7"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-8" class="color8"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-9" class="color9"></a></li>
					<li><a href="javascript: void(0)" data-theme="color-10" class="color10"></a></li>
				</ul>
				<h5>Theme Demo</h5>
				<ul class="theme-demo clearfix">
					<li>
						<div class="img-box"><a href="sotto/"><img src="images/home/light.jpg" alt=""></a></div>
						<h6>Light layout</h6>
					</li>
					<li>
						<div class="img-box"><a href="sotto-dark/"><img src="images/home/dark.jpg" alt=""></a></div>
						<h6>Dark layout</h6>
					</li>
				</ul>
			</div>
		</div> <!-- /switch-menu -->
	</div> <!-- /.switcher -->


	<!-- 
	=============================================
		Top Header
	============================================== 
	-->
	<div class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12">
					<div class="news-bell">Recent Post :</div>
					<div class="breaking-news easyTicker">
						<div class="wrapper">
							<div class="list"><a href="content/?id=<?php echo $row_num;?>"><?php echo $title[$row_num];?></a></div>
							<div class="list"><a href="content/?id=<?php echo $row_num-1;?>"><?php echo $title[$row_num-1];?></a></div>
							<div class="list"><a href="content/?id=<?php echo $row_num-2;?>"><?php echo $title[$row_num-2];?></a></div>
						</div> <!-- /.wrapper -->
					</div> <!-- /.breaking-news -->
				</div>
				<div class="col-lg-4 col-12">
					<ul class="social-icon text-right">
						<li class="icon"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li class="icon"><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li class="icon"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
						<li class="icon"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
						<li class="search-button">
							<button class="search" id="search-button"><i class="fas fa-search"></i></button>
						</li>
					</ul>
				</div>
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</div> <!-- /.top-header -->

	

	<!-- 
	=============================================
		Theme Header
	============================================== 
	-->
	<header class="theme-main-header">
		<div class="container">
			<div class="content-holder clearfix">
				<div class="logo"><a href="index.php"><img src="images/logo/logo.png" alt=""></a></div>
				<!-- ============== Menu Warpper ================ -->
				<div class="menu-wrapper">
					<nav id="mega-menu-holder" class="clearfix">
					   <ul class="clearfix">
						  <li><a href="../index.php">Home</a></li>
						  <li><a href="../cv">About me</a></li>
						  <li><a href="contact.php">contact me</a></li>
					   </ul>
					</nav> <!-- /#mega-menu-holder -->
				</div> <!-- /.menu-wrapper -->
			</div> <!-- /.content-holder -->
		</div> <!-- /.container -->
	</header> <!-- /.theme-main-header -->

	
	<!-- 
	=============================================
		Theme Main Banner
	============================================== 
	-->
	<div class="theme-banner-section-one section-margin-bottom">
		<!-- MasterSlider -->
		<div id="P_masterslider" class="master-slider-parent ms-panorama ms-parent-id-30" >
			<!-- MasterSlider Main -->
			<div id="main-slider-one" class="master-slider ms-skin-default" >
				<div class="ms-slide" data-delay="25" data-fill-mode="fill" >
					<img class="ms-layer"
						 src="images/blank.gif"
						 data-src="images/home/panaroma1.jpg"
						 alt=""
						 style=""
						 data-effect="t(false,850,n,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="30200"
						 data-ease="linear"
						 data-parallax="6"
						 data-type="image"
						 data-offset-x="-519"
						 data-offset-y="-1"
						 data-origin="mc"
						 data-position="normal" />
					<div class="ms-layer main-heading"
						 style=""
						 data-effect="t(true,n,20,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="3000"
						 data-delay="400"
						 data-ease="easeOutQuint"
						 data-parallax="60"
						 data-offset-x="115"
						 data-offset-y="-95"
						 data-origin="ml"
						 data-position="normal"
						 data-masked="true"
						 data-mask-width="auto">CODING</div>
					<div class="ms-layer author-layer"
						 style=""
						 data-effect="t(true,n,50,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="5000"
						 data-delay="1500"
						 data-ease="easeOutQuint"
						 data-parallax="120"
						 data-offset-x="120"
						 data-offset-y="24"
						 data-origin="ml"
						 data-position="normal"> Coding to change </div>
					<div class="ms-layer main-text"
						 style=""
						 data-effect="t(true,n,50,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="5000"
						 data-delay="2500"
						 data-ease="easeOutQuint"
						 data-parallax="120"
						 data-offset-x="120"
						 data-offset-y="35"
						 data-origin="ml"
						 data-position="normal"
						 data-masked="true"
						 data-mask-width="auto"></div>
					<div class="ms-layer read-more"
						 style=""
						 data-effect="t(true,n,n,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="5000"
						 data-delay="3500"
						 data-ease="easeOutQuint"
						 data-parallax="80"
						 data-offset-x="120"
						 data-offset-y="90"
						 data-origin="ml"
						 data-position="normal" ><a href="#"> the world!</a></div>
				</div>
				<div class="ms-slide" data-delay="25" data-fill-mode="fill" >
					<img class="ms-layer"
						 src="images/blank.gif"
						 data-src="images/home/panaroma2.jpg"
						 alt=""
						 style=""
						 data-effect="t(false,850,n,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="30000"
						 data-ease="linear"
						 data-parallax="6"
						 data-type="image"
						 data-offset-x="-630"
						 data-offset-y="0"
						 data-origin="mc"
						 data-position="normal" />
					<div class="ms-layer main-heading"
						 style=""
						 data-effect="t(true,n,20,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="3000"
						 data-delay="400"
						 data-ease="easeOutQuint"
						 data-parallax="60"
						 data-offset-x="115"
						 data-offset-y="-95"
						 data-origin="ml"
						 data-position="normal"
						 data-masked="true"
						 data-mask-width="auto">THINKING</div>
					<div class="ms-layer author-layer"
						 style=""
						 data-effect="t(true,n,50,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="5000"
						 data-delay="1500"
						 data-ease="easeOutQuint"
						 data-parallax="120"
						 data-offset-x="120"
						 data-offset-y="24"
						 data-origin="ml"
						 data-position="normal"> Where it all begins?</div>
					<div class="ms-layer main-text"
						 style=""
						 data-effect="t(true,n,50,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="5000"
						 data-delay="2500"
						 data-ease="easeOutQuint"
						 data-parallax="120"
						 data-offset-x="120"
						 data-offset-y="35"
						 data-origin="ml"
						 data-position="normal"
						 data-masked="true"
						 data-mask-width="450"></div>
					<div class="ms-layer read-more"
						 style=""
						 data-effect="t(true,n,n,n,n,n,n,n,n,n,n,n,n,n,n)"
						 data-duration="5000"
						 data-delay="3500"
						 data-ease="easeOutQuint"
						 data-parallax="80"
						 data-offset-x="120"
						 data-offset-y="90"
						 data-origin="ml"
						 data-position="normal" ><a href="#">LIFE? </a></div>
				</div>
			</div> <!-- /#main-slider-one -->
		</div>
	</div> <!-- /.theme-banner-section-one -->
	
	
	
	<!-- 
	=============================================
		Main Blog Post Wrapper
	============================================== 
	-->
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12 blog-grid-style hover-effect-one">
				
				<?php

	$item=$row_num;

	if($item>6){$showItem=6;}else{$showItem=$item;}
	for($i=0;$i<$showItem;$i++)
	{
				echo '
				<div class="single-blog-post">
					<div class="image-box"><img src="images/blog/';echo $id[$item];echo '.jpg" alt="'; echo $title[$item];echo '"></div>
					<div class="post-meta-box bg-box">
						<ul class="author-meta clearfix">
							<li class="tag"><a href="tag.php?tag=';echo $class[$item];echo '">'; echo $class[$item];echo '</a></li>
							<li class="date"><a href="date.php?date=';echo $date[$item];echo '">';echo $dateEng[$item];echo '</a></li>
						</ul>
						<h4 class="title"><a href="./content/?id='; echo $id[$item];echo '">'; echo $title[$item];echo '</a></h4>
						<ul class="share-meta clearfix">
							<li><a href="./content/?id='; echo $id[$item];echo '&#contact"><i class="icon flaticon-comment"></i>Comments' ; if($commentCnt[$item])echo '('; echo $commentCnt[$item];if($commentCnt[$item])echo ')';echo '</a></li>
							<li><a href="javascript:void(0);" onclick="like('.$id[$item].')" ><i class="icon flaticon-like-heart" id="like'.$id[$item].'"></i>Likes ';if($like[$item])echo '(<font id="like_cnt'.$id[$item].'">'.$like[$item].'</font>)';echo '</a></li>
							<li class="share-option">
								<button><i class="icon flaticon-arrows"></i> Share '; if($share[$item])echo '(';echo $share[$item]; if($share[$item])echo ')';echo '</button>
								<ul class="share-icon">
									<li><a href="share.php?name=facebook"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
								</ul>
							</li> <!-- /.share-option -->
						</ul>
						<p>'; echo $abstract[$item];echo '</p>
					</div> <!-- /.post-meta-box -->
				</div> <!-- /.single-blog-post -->' ;$item--;}?>
				
<?php if($showItem>6){	echo '

				<div class="theme-pagination text-center">
					<ul class="clearfix">

						<li><a href="items.php"><p>More Blogs...</p><i class="icon flaticon-right-arrow"></i></a></li>
					</ul>
				</div> <!-- /.theme-pagination -->';
}?>
			</div> <!-- /.col- -->
			<!-- ======================== Theme Sidebar =============================== -->
			<div class="col-lg-4 col-md-7 col-12 theme-main-sidebar">
				<div class="sidebar-box bg-box about-me">
					<h6 class="sidebar-title">About me</h6>
					<img src="images/home/1.jpg" alt="">
					<p>Hi, I am David Walmart. As for now I'm only focusing my attention on enjoyment. I'm being my true self with the values, dreams and goals that I have....</p>
					<div class="clearfix"><img src="images/home/sign.png" alt="" class="signature float-right"></div>
				</div> <!-- /.about-me -->
				<div class="sidebar-box bg-box sidebar-categories">
					<h6 class="sidebar-title">Categories</h6>
					<ul>
		<?php
					for($i=0;$i<count($tag);$i++)
				{		
						echo '<li><a href="tag.php?tag='.$tag[$i].'">'.$tag[$i].'</a></li>';
					}	?>
					</ul>
				</div> <!-- /.sidebar-categories -->
				<div class="sidebar-box bg-box sidebar-trending-post">
					<h6 class="sidebar-title">Trending Post</h6>
<?php	
		for($i=0;$i<4;$i++)			
	{	
				echo	'<div class="single-trending-post clearfix">
						<a href="./content/?id='.$clickSort[$i].'"><img src="images/blog/'.$clickSort[$i].'.jpg" alt="'.$title[$clickSort[$i]].'" class="float-left" ></a>
						<div class="post float-left">
							<h6><a href="./content/?id='.$clickSort[$i].'">'.$title[$clickSort[$i]].' </a></h6>
							<ul>
								<li class="tag">'.$class[$clickSort[$i]].'</li>
								<li class="date">'.$click[$clickSort[$i]].' visits</li>
							</ul>
						</div> <!-- /.post -->
					</div> <!-- /.single-trending-post -->';
		}?>
				</div> <!-- /.sidebar-trending-post -->
				<div class="sidebar-box bg-box sidebar-categories">
					<h6 class="sidebar-title">Archives</h6>
					<ul>
	<?php	for($i=0;$i<count($month);$i++)				
{
		echo '<li><a href="date.php?date='.$month[$i].'">'.$month[$i].'</a></li>';
}?>
					</ul>
				</div> <!-- /.sidebar-categories -->
				<div class="sidebar-box bg-box sidebar-newsletter">
					<h6 class="sidebar-title">Leave your word here</h6>
					<form action="#">
						<input type="text" placeholder="ONLY one word please!" required>
						<button class="theme-button-one">Submit</button>
					</form>
				</div> <!-- /.sidebar-newsletter -->
			</div> <!-- /.theme-main-sidebar -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->


	<!--
	=====================================================
		Footer
	=====================================================
	-->
	<footer class="theme-footer">
		<div class="container">
			<div class="logo"><a href="index.php"><img src="images/logo/logo.png" alt=""></a></div>
			<p class="footer-text">Trying to Make the World A Better Place</p>
			<ul class="social-icon">
				<li class="icon"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
				<li class="icon"><a href="#"><i class="fab fa-twitter"></i></a></li>
				<li class="icon"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
				<li class="icon"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
			</ul>
			<p class="copyright">Copyright &copy; 2018.Yimian LIU All rights reserved.</p>
		</div> <!-- /.container -->
	</footer> <!-- /.theme-footer -->
	

	

	<!-- Scroll Top Button -->
	<button class="scroll-top tran3s">
		<i class="fa fa-angle-up" aria-hidden="true"></i>
	</button>
	


<!-- Optional JavaScript _____________________________  -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- jQuery -->
<script src="vendor/jquery.2.2.3.min.js"></script>
<!-- Popper js -->
<script src="vendor/popper.js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Style-switcher  -->
<script src="vendor/jQuery.style.switcher.min.js"></script>
<!-- jquery-easy-ticker-master -->
<script src="vendor/jquery-easy-ticker-master/jquery.easy-ticker.min.js"></script>
<!-- jquery easing -->
<script src="vendor/jquery.easing.1.3.js"></script>
<!-- Font Awesome -->
<script src="fonts/font-awesome/fontawesome-all.min.js"></script>
<!-- Master Slider -->
<script src="vendor/masterslider/masterslider.min.js"></script>
<!-- menu  -->
<script src="vendor/menu/src/js/jquery.slimmenu.js"></script>
<!-- owl.carousel -->
<script src="vendor/owl-carousel/owl.carousel.min.js"></script>
<!-- Fancybox -->
<script src="vendor/fancybox/dist/jquery.fancybox.min.js"></script>
<!-- Youtube Video -->
<script src="vendor/jquery.fitvids.js"></script>

<!-- Theme js -->
<script src="js/theme.js"></script>
	
<script type="text/javascript">
var Times=new Array();

			function like(i){	
				var like = document.getElementById("like"+i);
				like.setAttribute("class","icon flaticon-like");
				if(Times[i]!=1){
				$.post("count.php", { name: "lik", id:i } );
				Times[i]=1;
				var like_cnt = document.getElementById("like_cnt"+i);
			var int=document.getElementById("like_cnt"+i).innerHTML;
				int++;
            like_cnt.innerHTML = int;
				}

			}</script>

</div> <!-- /.main-page-wrapper -->
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
