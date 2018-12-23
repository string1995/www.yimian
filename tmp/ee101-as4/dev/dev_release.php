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
?>

<?php //用户基础信息获取
$servername = "114.116.65.152";
$username = "yimian";
$password = "Lymian0904@112";
$dbname = "yimian";

?>

<?php  
$name5=$_POST['name5'];
$code=$_POST['code'];

$endtime=date('Y-m-d H:i:s',time());

$conn = new mysqli($servername, $username, $password, $dbname);
            $sql="UPDATE ee101_as4_functions set hosttime='0000-00-00 00:00:00',endtime='0000-00-00 00:00:00',code='',host='' where name='$name5'"; 


	if ($conn->query($sql) === TRUE) {echo "<script>alert('任务已归还！加油吧少年！');window.location.href='dev.php'</script>";
   
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
           
            mysqli_close($conn);  
        ?>  