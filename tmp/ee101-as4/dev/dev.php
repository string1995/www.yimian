<!doctype html>

<?php
 function GetBrowser(){
       if(!empty($_SERVER['HTTP_USER_AGENT']))
       {
         $br = $_SERVER['HTTP_USER_AGENT'];
          if (preg_match('/MSIE/i',$br)){    
             $br = 'MSIE';
          }
          elseif (preg_match('/Firefox/i',$br)){
             $br = 'Firefox';
          }elseif (preg_match('/Chrome/i',$br)){
             $br = 'Chrome';
          }elseif (preg_match('/Safari/i',$br)){
             $br = 'Safari';
          }elseif (preg_match('/Opera/i',$br)){
             $br = 'Opera';
          }else {
             $br = 'Other';
          }
             return $br;
          }else{
             return "获取浏览器信息失败！";} 
      }
      ////获得访客浏览器语言
      function GetLang()
      {
           if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
               $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
               $lang = substr($lang,0,5);
                if(preg_match("/zh-cn/i",$lang)){
                   $lang = "简体中文";
                }elseif(preg_match("/zh/i",$lang)){
                   $lang = "繁体中文";
                }else{
                   $lang = "English";
                }
                return $lang; 
           }else{
            return "获取浏览器语言失败！";
            }
      }
       
     //获取客户端操作系统信息包括win10
    function GetOs(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $os = false;
    
        if (preg_match('/win/i', $agent) && strpos($agent, '95'))
        {
            $os = 'Windows 95';
        }
        else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90'))
        {
            $os = 'Windows ME';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent))
        {
            $os = 'Windows 98';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent))
        {
            $os = 'Windows Vista';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent))
        {
            $os = 'Windows 7';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent))
        {
            $os = 'Windows 8';
        }else if(preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent))
        {
            $os = 'Windows 10';#添加win10判断
        }else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent))
        {
            $os = 'Windows XP';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent))
        {
            $os = 'Windows 2000';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent))
        {
            $os = 'Windows NT';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent))
        {
            $os = 'Windows 32';
        }
        else if (preg_match('/linux/i', $agent))
        {
            $os = 'Linux';
        }
        else if (preg_match('/unix/i', $agent))
        {
            $os = 'Unix';
        }
        else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent))
        {
            $os = 'SunOS';
        }
        else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent))
        {
            $os = 'IBM OS/2';
        }
        else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent))
        {
            $os = 'Macintosh';
        }
        else if (preg_match('/PowerPC/i', $agent))
        {
            $os = 'PowerPC';
        }
        else if (preg_match('/AIX/i', $agent))
        {
            $os = 'AIX';
        }
        else if (preg_match('/HPUX/i', $agent))
        {
            $os = 'HPUX';
        }
        else if (preg_match('/NetBSD/i', $agent))
        {
            $os = 'NetBSD';
        }
        else if (preg_match('/BSD/i', $agent))
        {
            $os = 'BSD';
        }
        else if (preg_match('/OSF1/i', $agent))
        {
            $os = 'OSF1';
        }
        else if (preg_match('/IRIX/i', $agent))
        {
            $os = 'IRIX';
        }
        else if (preg_match('/FreeBSD/i', $agent))
        {
            $os = 'FreeBSD';
        }
        else if (preg_match('/teleport/i', $agent))
        {
            $os = 'teleport';
        }
        else if (preg_match('/flashget/i', $agent))
        {
            $os = 'flashget';
        }
        else if (preg_match('/webzip/i', $agent))
        {
            $os = 'webzip';
        }
        else if (preg_match('/offline/i', $agent))
        {
            $os = 'offline';
        }
        else
        {
            $os = '未知操作系统';
        }
        return $os; 
    }

$fpphp=md5(GetBrowser().GetLang().GetOs());


?>



<?php //用户基础信息获取
$name="yimian";
$servername = "114.116.65.152";
$username = "yimian";
$password = "Lymian0904@112";
$dbname = "yimian";
 

if(!isset($_COOKIE['usr'])||!isset($_COOKIE['fp'])) echo "<script>window.location.href='setkey.php?key=0'</script>";


$name=$_COOKIE['usr'];
?>

<?php  if($_COOKIE['fp']!=md5('15'.$fpphp)) echo "<script>window.location.href='setkey.php?key=0'</script>";

$servername = "114.116.65.152";
$username = "yimian";
$password = "Lymian0904@112";
$dbname = "yimian";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$credit=0;

$sql = "SELECT * FROM ee101_as4_functions where host='$name' AND chck=1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 
$credit=$credit+$row['credit'];
 
 }}

?>

<html lang="zh">
<head>
	
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ee101 as4 酒店管理系统 开发</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style1.css">


	

</head>
<body>
	
	<div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       ee101 as4 dev
                    </a>
                </li>
                <li>
                    <a href="dev.php"><i class="fa fa-fw fa-home"></i> 待认领functions</a>
                </li>
                <li>
                    <a href="dev_post.php"><i class="fa fa-fw fa-folder"></i> 已完成的functions</a>
                </li>

				 <li>
                    <a href="dev_insert.php"><i class="fa fa-fw fa-folder"></i> 新建functions</a>
                </li> 
				<?php if($name=='yimian')echo "<li>
                    <a href=\"dev_check.php\"><i class=\"fa fa-fw fa-folder\"></i> 审核functions</a>
                </li>";?>
                <li>                    <a href="setkey.php?key=0"><i class="fa fa-fw fa-folder"></i> logout</a>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
          </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
						<p>你好！<?php echo $name?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 又是美好的一天哦^_^</p>
						<p>说明：我们将程序划分成了四大模块，请挑选一个你喜欢的模块！先到先得！</p>
						<p> 平台开放了新建函数功能（左侧功能栏），你可以通过发布新函数来外包你所负责模块开发中的部分功能！</p>
						<p>开发环境链接：<a href="https://yimian.xyz/file/ee101/as4/ftp/code/main/main.c">https://yimian.xyz/file/ee101/as4/ftp/code/main/main.c</a></p>
						<p>Fundamental函数说明文档：<a href="https://uk.cloud.yimian.xyz/index.php/s/NkZKXDX64AzTRY6">https://uk.cloud.yimian.xyz/index.php/s/NkZKXDX64AzTRY6</a></p>
                        <h1 class="page-header">待认领functions</h1>  <p class="lead">
                        <?php

$sql = "SELECT * FROM ee101_as4_functions where hosttime='0000-00-00 00:00:00'";
$result = $conn->query($sql);

 
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
		echo "<a href=";
		$url="dev_pre.php?name=" . $row['name'];
		$str='"';
		echo "$str";
		echo "$url";
		echo "$str";
		echo ">";
				
        echo " " . $row['name'].  " 难度: ";
		
		for($i=0;$i<$row['credit'];$i++) echo "★ ";
		
		echo "</br> </br>";
		echo "</a>";

		
    }
} else {
    echo "0 结果";
}

?></p>
				
                      <h1 class="page-header">我的待处理项目</h1>
				<p class="lead">
                        <?php
 
$sql = "SELECT * FROM ee101_as4_functions where host='$name' AND chck=0 AND endtime='0000-00-00 00:00:00'";
$result = $conn->query($sql);

 
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
		echo "<a href=";
		$url="dev_finish.php?name=" . $row['name']."&from=0";
		$str='"';
		echo "$str";
		echo "$url";
		echo "$str";
		echo ">";
				
        echo " " . $row['name'].  " 难度: ";
		
		for($i=0;$i<$row['credit'];$i++) echo "★ ";
		
		echo "</br> </br>";
		echo "</a>";

		
    }
} else {
    echo "0 结果";
}

?></p>
						
				
                      <h1 class="page-header">我的待审核项目</h1>
				<p class="lead">
                        <?php
 
$sql = "SELECT * FROM ee101_as4_functions where host='$name'AND chck=0 AND endtime!='0000-00-00 00:00:00'";
$result = $conn->query($sql);

 
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
		echo "<a href=";
		$url="dev_finish.php?name=" . $row['name']."&from=1";
		$str='"';
		echo "$str";
		echo "$url";
		echo "$str";
		echo ">";
				
        echo " " . $row['name'].  " 难度: ";
		
		for($i=0;$i<$row['credit'];$i++) echo "★ ";
		
		echo "</br> </br>";
		echo "</a>";

		
    }
} else {
    echo "0 结果";
}
$conn->close();
					?></p>					</br></br></br></br>
<!--		<p class="lead"></br>添加新的待处理ee101_as4_functions：</p>
		<form action="dev_insert.php" method="POST">		
		<input type="text" name="name" />
			<button type="submit" value="添加">添加</button>
			</form>		-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
		  var trigger = $('.hamburger'),
		      overlay = $('.overlay'),
		     isClosed = false;

		    trigger.click(function () {
		      hamburger_cross();      
		    });

		    function hamburger_cross() {

		      if (isClosed == true) {          
		        overlay.hide();
		        trigger.removeClass('is-open');
		        trigger.addClass('is-closed');
		        isClosed = false;
		      } else {   
		        overlay.show();
		        trigger.removeClass('is-closed');
		        trigger.addClass('is-open');
		        isClosed = true;
		      }
		  }
		  
		  $('[data-toggle="offcanvas"]').click(function () {
		        $('#wrapper').toggleClass('toggled');
		  });  
		});
	</script>
</body>
</html>