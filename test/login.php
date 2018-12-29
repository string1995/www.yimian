<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>用户登录</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>

    <meta name="Keywords" content="网站关键词">
    <meta name="Description" content="网站介绍">
    <link rel="stylesheet" type="text/css" href="https://cdn.yimian.ac.cn/clever-login/clever-login.css" />
	<link type="text/css" rel="stylesheet" href="https://cdn.yimian.ac.cn/easyVer/easyVer.min.css">
    <script src="https://cdn.bootcss.com/device.js/0.2.7/device.min.js"></script>
</head>
<body>
<script type="text/javascript">if(device.mobile()){document.body.style.zoom="0.8";}</script>
<div id="site-landing"></div>
<div class="wrap">
    <div class="wpn">
        <div class="form-data pos">
            <a href="https://www.yimian.xyz"><img src="https://cn.yimian.xyz/etc/img/logo/logo.png" class="head-logo"></a>
			
                <form name="form">
                    <p class="p-input pos">
                        <label for="tel">手机号</label>
                        <input type="number" id="tel" autocomplete="off" name="tel">
                        <span class="tel-warn tel-err hide"><em></em><i class="icon-warn"></i></span>
                    </p>
                    <p class="p-input pos" id="sendcode">
                        <label for="veri-code">输入验证码</label>
                        <input type="number" id="veri-code" name="code">
                        <a href="javascript:;" class="send">发送验证码</a>
                        <span class="time hide"><em>120</em>s</span>
                        <span class="error hide"><em></em><i class="icon-warn" style="margin-left: 5px"></i></span>
                    </p>

                <div class="reg_checkboxline pos">
                    <span class="z"><i class="icon-ok-sign boxcol" nullmsg=""></i></span>
                    <input type="hidden" name="agree" value="1">
                    <div class="Validform_checktip"></div>
                    <p>朕要霸占此设备 x_x  <a href="javascript:alert('为了保护你的隐私，小站目前仅支持一台设备绑定一个账号Σ(･ω･ﾉ)ﾉ')">好迷茫，戳我~</a></p>
                </div>

			    </form>
			      <button class="lang-btn log-btn" >登录/注册</button>

            <p class="right">Powered by <a href="https://hhcandy.me">hhCandy</a>© 2018</p>
        </div>
    </div>
</div>
<div class="verBox"></div>

<script type="text/javascript" src="https://cdn.yimian.ac.cn/clever-login/polygonizr.min.js"></script>
<script type="text/javascript">$('#site-landing').polygonizr();</script>
<script type="text/javascript" src="https://cdn.yimian.ac.cn/clever-login/clever-login.min.js"></script>
<script type="text/javascript" src="https://cdn.yimian.ac.cn/easyVer/easyVer.min.js"></script>
<script type="text/javascript" src="https://cdn.yimian.ac.cn/fp/fp.js"></script>

</body>
</html>