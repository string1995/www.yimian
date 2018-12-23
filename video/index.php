


<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Yimian Video</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="../video/js/jquery.min.js"></script>
<script src="js/simpleCanvas.js"></script>
	


</head>
<body>
	
	<div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="./">
                       Yimian Video
                    </a>
                </li>
                <li>                    <a href="./"><i class="fa fa-fw fa-home"></i>Video Home</a>
                </li>
                <li>
                    <a href="./acg.php?class=1"><i class="fa fa-fw fa-folder"></i> ACG</a>
                </li>
                <li>
                    <a href="./acg.php?class=2"><i class="fa fa-fw fa-file-o"></i> Movies</a>
                </li>
                <li>
                    <a href="./acg.php?class=3"><i class="fa fa-fw fa-cog"></i> Documentary</a>
                </li>
                <li>
                    <a href="./acg.php?class=4"><i class="fa fa-fw fa-cog"></i> TV Play</a>
                </li>
                <li>
                    <a href="../"><i class="fa fa-fw fa-twitter"></i>Back to Yimian Page</a>
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
                        <h1 class="page-header">Yimian Video</h1>  
                        <p class="lead">Share video with the one you love!</p>
                       
                        <h3><a href="./acg.php?class=1">ACG (动漫）</a></h3>
                        
                        <h3><a href="./acg.php?class=2">Movies (电影)</a></h3>
						
                        <h3><a href="./acg.php?class=3">Documentary (纪录片)</a></h3>
						
						<h3><a href="./acg.php?class=4">TV Play (电视剧)</a></h3>
						
						<h3 id="p1"></h3>
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
	<script>
			
	var watching=0;//alert(simpleCanvas);
		$.post("./fpcheck.php",{
			fp: simpleCanvas
		},
		function(msg){watching=msg.id;

	
	//watching = cookie.get('watching');
	if(watching){document.getElementById("p1").innerHTML='<a href="./video.php?auto=1&id='+watching+'">点这里继续上次播放！</a>';}
	}
				  );
	</script>
	
	
</body>
</html>