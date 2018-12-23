<?php
$id=$_POST['watching'];

setcookie("watching",$id, time()+3600*24*150);