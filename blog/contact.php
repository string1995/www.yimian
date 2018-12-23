﻿<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<!-- For IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- For Resposive Device -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- For Window Tab Color -->
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#2c2c2c">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#2c2c2c">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#2c2c2c">

<title>Contact</title>

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

	<!-- ===================================================
		About Me Wrapper
	==================================================== -->
	<div class="contact-us">
		<div class="back-to-home"><a href="index.php"><i class="flaticon-left-arrow"></i> Back to home</a></div>
		<div class="main-text-wrapper">
			<div class="container">
				<div class="contact-form">
					<h2>Contact</h2>
					<p>You can contact me almost about anything</p>
					<form action="inc/sendemail.php" class="form-validation" autocomplete="off">
						<label>full Name</label>
						<input type="text" placeholder="John Doe" name="name" autofocus>
						<label>Email address</label>
						<input type="email" placeholder="example@gmail.com" name="email">
						<label>Your message</label>
						<textarea placeholder="Message" name="message"></textarea>
						<button class="theme-button-one">Submit</button>
					</form>
				</div> <!-- /.contact-form -->
			</div> <!-- /.container -->
		</div> <!-- /.main-text-wrapper -->
		<!--Contact Form Validation Markup -->
		<!-- Contact alert -->
		<div class="alert-wrapper" id="alert-success">
			<div id="success">
				<button class="closeAlert"><i class="fas fa-window-close"></i></button>
				<div class="wrapper">
					<p>Your message was sent successfully.</p>
				 </div>
			</div>
		</div> <!-- End of .alert_wrapper -->
		<div class="alert-wrapper" id="alert-error">
			<div id="error">
				<button class="closeAlert"><i class="fas fa-window-close"></i></button>
				<div class="wrapper">
					<p>Sorry!Something Went Wrong.</p>
				</div>
			</div>
		</div> <!-- End of .alert_wrapper -->
	</div> <!-- /.contact-us -->

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
<!-- Validation -->
<script type="text/javascript" src="vendor/contact-form/validate.js"></script>
<script type="text/javascript" src="vendor/contact-form/jquery.form.js"></script>

<!-- Theme js -->
<script src="js/theme.js"></script>
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
