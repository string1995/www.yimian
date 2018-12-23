<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<title>Yimian Mailer</title>
	<script>
			
	    $.ajax({
        type: "POST",
        url: 'https://mail.yimian.xyz/mail.php',
        data: { "to": "lymian0904@hotmail.com",
    		   "subject": "test77",
			   "message": "SSR TEST",
			   "from": "mail@liu.yimian.xyz"
			  },
        traditional: true,
        dataType: 'json',
		success: function(msg){
			alert(msg.text);
		}
    });
	</script>
</head>

<body>
</body>
</html>
