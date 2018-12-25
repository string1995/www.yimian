<?php include '../functions.php'?>
<?php yimian__header("Yimian Test","yimian test","This is the test place of Yimian web.");?>
<?php  js__jquery()?>
<?php yimian__headerEnd()?>
<div id="content"></div>
<script>$(document).pjax('a', '#content');</script>
<?php aplayer__element()?>
<?php aplayer__setup_mini()?>
<?php $rand=rand(0,300);aplayer__netease(808097971,$rand,$rand+10);?>
<?php yimian__footer()?>