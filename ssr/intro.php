<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script>location.href="https://uk.cloud.yimian.xyz/index.php/s/3A5F2ia6kGykEDy";</script>
<title>Yimian SSR</title>
</head>

<body>    <script>//log visit
		
		var url=window.location.pathname+window.location.search;
		var domain= document.domain;

		
	    $.ajax({
        type: "POST",
        url: '/log.php',
        data: { "url": url,
			  	"domain": domain},//使用这种数组方式的，得加下一句才可以，使用传统方式
        traditional: true,
        dataType: 'json',
        error: function (data,type, err) {
           alert('Could not log your visit!');
        }
    });
	</script>
</body>
</html>