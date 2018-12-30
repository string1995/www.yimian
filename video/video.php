<?php
include '../functions.php';

if(!isset($_REQUEST['id'])) header("Location: https://cn.yimian.xyz/404.php");

yimian__header("Yimian Video","video,Yimian","This is the page for playing a video.");

js__jquery();

yimian__headerEnd();

dplayer__element();

echo "
<script>
var is_next=1;
</script>";

dplayer__setup();
dplayer__add($_REQUEST['id']);


echo "
<script>
$(\"#next\").on(\"click\",function (){nextVideo();});
</script>";

yimian__footer();
