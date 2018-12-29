<?php include '../functions.php'?>
<?php yimian__header("Yimian Test","yimian test","This is the test place of Yimian web.");?>
<?php  js__jquery()?>
<?php yimian__headerEnd();db__pushData(db__connect(),"fp",array("fp"=>"4445544","usr"=>"test"),array("usr"=>"test","video"=>666));?>

<div id="content"><a href="red.html">hhhh</a></div>
<script>$(document).pjax('a', '#content');//alert(fp);</script>
<?php dplayer__element()?>
<?php dplayer__setup()?>
<?php dplayer__add($_GET['id'])?>
<button onClick="nextVideo()">hhh</button>

<?php aplayer__element()?>
<?php aplayer__setup_mini()?>
<?php $rand=rand(0,300);aplayer__netease(808097971,$rand,$rand+10);?>
<?php yimian__footer()?>