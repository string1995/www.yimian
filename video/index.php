<?php
include '../functions.php';

yimian__header("Yimian Video","video,Yimian","This is the page for showing video class.");


echo "
<link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.css\">
<link rel=\"stylesheet\" href=\"css/style.css\">";

	

yimian__headerEnd();

echo file_get_contents("./mainlist.html");

echo"
<script src=\"js/bootstrap.min.js\"></script>
<script type=\"text/javascript\">
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
		  
	$('[data-toggle=\"offcanvas\"]').click(function () {
		$('#wrapper').toggleClass('toggled');
	});  
});
</script>";
echo "
<script>
var watching=0;
$.post(\"./fpcheck.php\",{
	fp: fp
},
function(msg){
	if(msg.code==1){document.getElementById(\"p1\").innerHTML='<a href=\"./video.php\">点这里继续上次播放！</a>';}
},\"json\");
</script>";
	
yimian__simpleFooter();
															 
															 