<?php

session_start();

if(isset($_SESSION['s_from'])) header('Location: '.$_SESSION['s_from']);
else header('Location: https://www.yimian.xyz');

unset($_SESSION['g_from']);