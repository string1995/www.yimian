<?php
include '../functions.php';

yimian__header("Yimian Resume","Yimian,Resume,CV,introduction","Resume of Yimian");

echo "<link href=./static/css/app.121ce650a966130fb0f2ffacb130b3de.css rel=stylesheet>";

yimian__headerEnd();

echo file_get_contents("./index.html");

yimian__simpleFooter();