<?php include '../functions.php'?>
<?php yimian__header("Yimian Test","yimian test","This is the test place of Yimian web.");?>
<?php  js__jquery()?>
<?php yimian__headerEnd()?>
<div id="content"><a href="red.html">hhhh</a></div>
<script>$(document).pjax('a', '#content');</script>
<?php dplayer__element()?>
<?php dplayer__setup()?>
<?php dplayer__add(1,"https://obs-410c.obs.cn-east-2.myhwclouds.com/video/%E6%9C%AB%E6%97%A5%E6%97%B6%E5%9C%A8%E5%81%9A%E4%BB%80%E4%B9%88%2C%E6%9C%89%E6%B2%A1%E6%9C%89%E7%A9%BA%2C%E5%8F%AF%E4%BB%A5%E6%9D%A5%E6%8B%AF%E6%95%91%E5%90%97/01%E3%80%8C%E5%9C%A8%E5%A4%AA%E9%98%B3%E8%A5%BF%E6%96%9C%E7%9A%84%E8%BF%99%E4%B8%AA%E4%B8%96%E7%95%8C%E9%87%8C%E3%80%8D.mp4")?>
<?php aplayer__element()?>
<?php aplayer__setup_mini()?>
<?php $rand=rand(0,300);aplayer__netease(808097971,$rand,$rand+10);?>
<?php yimian__footer()?>