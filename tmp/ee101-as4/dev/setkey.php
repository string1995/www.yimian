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
<?php

if($_GET['key']=='0'){setcookie("usr",15, time()-15);echo "<script>alert('Logout Successfully!!');window.location.href='index.php'</script>";exit();}


if($_GET['usr']=='yimian'&&$_GET['fp']==$fpphp&&$_GET['key']==md5('3235af318e9145c2a05f4ee256688ad3'.$fpphp)) {$usr='yimian';}

if($_GET['usr']=='jiangnan'&&$_GET['fp']==$fpphp&&$_GET['key']==md5('68e2c9e27b302551ca0146584246b247'.$fpphp)) {$usr=$_GET['usr'];}

if($_GET['usr']=='jingyu'&&$_GET['fp']==$fpphp&&$_GET['key']==md5('a2c0bfd8ceb816a8041231e2bca2095f'.$fpphp)) {$usr=$_GET['usr'];}

if($_GET['usr']=='tongxin'&&$_GET['fp']==$fpphp&&$_GET['key']==md5('a3dcb4d229de6fde0db5686dee47145d'.$fpphp)) {$usr=$_GET['usr'];}

if($_GET['usr']=='xiaotian'&&$_GET['fp']==$fpphp&&$_GET['key']==md5('ae602124432b40a706f965f5c8332094'.$fpphp)) {$usr=$_GET['usr'];}

if(isset($usr))
{
setcookie("fp",md5('15'.$fpphp), time()+3600*24*50);
setcookie("usr",$usr, time()+3600*24*50);
}else
{
echo "<script>alert('Password is Wrong!!');window.location.href='index.php';</script>";exit();
}

if(1) echo"<script>alert('Authority Confirmed!');window.location.href='dev.php'</script>";
else echo "<script>alert('ERROR!!')</script>";
?>
<html>
<head>
<meta charset="utf-8">
<title>setkey</title>
</head>

<body>
</body>
</html>