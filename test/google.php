<?php
	$url="https://www.google.com";
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    echo curl_exec($ch);
	curl_close($ch);