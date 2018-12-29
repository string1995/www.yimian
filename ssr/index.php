<?php

$login=empty($_COOKIE['login']) ? 0:1;

if($login==1){echo '<script>window.location.href="./intro.php";</script>';}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<style type="text/css">body {zoom:0.8;}</style>
    <title>Yimian SSR</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="网站关键词">
    <meta name="Description" content="网站介绍">
	
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/iconfont.css">
    <link rel="stylesheet" href="./css/reg.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css" /><!--CSS RESET-->	
	<script>
		
		
	if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) { //判断iPhone|iPad|iPod|iOS

  alert('暂不支持iOS，您确定继续？');

} else if (/(Android)/i.test(navigator.userAgent)) {  //判断Android


} else { //pc

};	
		
	var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();

		
	var cookie = {
		set: function(name, value) {
			var Days = 1;
			var exp = new Date();
			exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
			document.cookie = name + '=' + escape(value) + ';expires=' + exp.toGMTString();
		},
		get: function(name) {
			var arr, reg = new RegExp('(^| )' + name + '=([^;]*)(;|$)');
			if(arr = document.cookie.match(reg)) {
				return unescape(arr[2]);
			} else {
				return null;
			}
		},
		del: function(name) {
			var exp = new Date();
			exp.setTime(exp.getTime() - 1);
			var cval = getCookie(name);
			if(cval != null) {
				document.cookie = name + '=' + cval + ';expires=' + exp.toGMTString();
			}
		}
	};
		

	</script>
	
	<style>
	html, body {
		height: 100%;
		width: 100%;
		margin: 0;
		overflow: hidden;
	}
	#site-landing {
		position:relative;
		height: 100%;
		width: 100%;
	   background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);
	}
  </style>
</head>
<body>
<div id="site-landing"></div>
<div class="wrap">
    <div class="wpn">
        <div class="form-data pos">
            <a href=""><img alt="Steel15" src="./img/logo.png" class="head-logo"></a>
			
                <form name="form">
                    <p class="p-input pos">
                        <label for="tel">手机号</label>
                        <input type="number" id="tel" autocomplete="off" name="tel" >
                        <span class="tel-warn tel-err hide"><em></em><i class="icon-warn"></i></span>
                    </p>
                    <p class="p-input pos" id="sendcode">
                        <label for="veri-code">输入验证码</label>
                        <input type="number" id="veri-code" name="code">
                        <a href="javascript:sent()" class="send">发送验证码</a>
                        <span class="time hide"><em>120</em>s</span>
                        <span class="error hide"><em></em><i class="icon-warn" style="margin-left: 5px"></i></span>
                    </p>

                <div class="reg_checkboxline pos">
                    <span class="z"><i class="icon-ok-sign boxcol" nullmsg="请同意!"></i></span>
                    <input type="hidden" name="agree" value="1">
                    <div class="Validform_checktip"></div>
                    <p>我已阅读并接受 <a href="https://uk.cloud.yimian.xyz/index.php/s/ykf8EgzKmj9AXbq" >《Yimian SSR服务协议》</a></p>
                </div>

			    </form>
			      <button class="lang-btn" onClick="next()">下一步</button>

            <p class="right">Powered by Yimian LIU© 2018</p>
        </div>
    </div>
</div>
	
<script src="./js/jquery.js"></script>
<script src="./js/agree.js"></script>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/polygonizr.min.js"></script>
<script src="js/login.js"></script>
<script type="text/javascript">
$('#site-landing').polygonizr();
</script>
	
<script>
	document.getElementById("tel").value =$_GET['tel'];
	function sent()
	{
		var tel=form.tel.value;
	checkPhone(tel);
		if(tel==''){alert('请填写号码！');return false;}
			    $.ajax({
        type: "POST",
        url: '/msg.php',
        data: { "tel": tel,
			  	"tpl": 1,
			   "msg1": "Yimian-SSR",
			   "msg2": "验证码",
			   "msg3": 15
			  },
        traditional: true,
        dataType: 'json',
		success: function(msg){
			if(msg.result==0){}
			if(msg.result!=0){alert('发送失败！错误码：'+msg.errmsg)}
		}
    });
	}
	
	function next(){
		if(form.agree.value!=1){alert('您必须先同意服务协议！');return false;}
		var tel=form.tel.value;
		$.ajax({
			            url: '/phonecheck.php',
			            type: 'post',
			            dataType: 'json',
			            async: true,
			            data: {"tel":form.tel.value,"code":form.code.value},
			            success:function(msg){
							if(msg.status==1){	window.location.href="./login_name.php?tel="+tel;}
							else{alert('验证码错误！')}
						},
			error: function(err){
			alert('验证码错误！');
		}
	})
	}
	
		function checkPhone(phone){
		var status = true;
		if (phone == '') {
			$('.num2-err').removeClass('hide').find("em").text('请输入手机号');
			return false;
		}
		var param = /^1[34578]\d{9}$/;
		if (!param.test(phone)) {
			 globalTip({'msg':'手机号不合法，请重新输入','setTime':3});
			$('.num2-err').removeClass('hide');
			$('.num2-err').text('手机号不合法，请重新输入');
			return false;
		}
	/*	$.ajax({
            url: '/checkPhone',
            type: 'post',
            dataType: 'json',
            async: false,
            data: {phone:phone,type:"login"},
            success:function(data){
                if (data.code == '0') {
                    $('.num2-err').addClass('hide');
                     console.log('aa');
                     return true;
                } else {
                    $('.num2-err').removeClass('hide').text(data.msg);
                     console.log('bb');
					status = false;
					 return false;
                }
            },
            error:function(){
            	status = false;
                 return false;
            }
        });*/
		return status;
	}
	
	
	
	

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
</body>
</html>