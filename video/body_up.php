<?php
include '../functions.php';

yimian__header("Yimian Video","video,Yimian","This is the page for showing video class.");

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cn.yimian.xyz/video/css/bootstrap.css\">
<link rel=\"stylesheet\" href=\"https://cn.yimian.xyz/video/css/style.css\">";


yimian__headerEnd();

echo file_get_contents("./body_up.html");