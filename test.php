<html>
		<script type="text/javascript" src="./video/js/jquery.min.js"></script>

<script>
function hh(tell)
	{
 $.ajax({
        type: "POST",
        url: 'msg.php',
        data:  {"msg1": "服务器无法访问",
			   	"msg2": "于即日起",
				"msg3": "未知",
				"tel": tell,
				"tpl": 3
			   
			   },//使用这种数组方式的，得加下一句才可以，使用传统方式
        dataType: 'json',
		success: function(msg){
    var a=document.getElementById("test");
    a.innerHTML=a.innerHTML+msg.errmsg;
	
		}

    });
	}
		//hh(18118155257);
	/*hh(13255487806);
	hh(18253823633);
	hh(18995683998);
	hh(18862175736);
	hh(17751127291);
	
	hh(18118155257);
	hh(13026627063);
	hh(18806135995);
	hh(18013102208);
	hh(13371035727);
	hh(18862150816);*/

	</script>
<body>
	
	<div id="test"></div>
	
	</body>

</html>