		<script type="text/javascript" src="../video/js/jquery.min.js"></script>     


<form class="mt-3" action="https://ice.xjtlu.edu.cn/login/index.php" method="post" id="login" >

 

                            <input type="hidden" name="username" id="username"
                                class="form-control"
                                value="yimian.liu17"
                                placeholder="Username">


                           <input type="hidden" name="password" id="password" value="lymian$0904@112"
                                class="form-control"
                                placeholder="Password">


                        <button type="submit" class="btn btn-primary btn-block mt-3" id="loginbtn" >Log in</button>
                    </form>

                     <button  class="btn btn-primary btn-block mt-3" onclick="test()" >Log in</button>
<script>	function test(){	
		this.set('Access-Control-Allow-Headers', 'cache-control,content-type,hash-referer,x-requested-with');
		$.post("https://ice.xjtlu.edu.cn/login/index.php",{
			username: "yimian.liu17",
			password: "lymian$0904@112"
		},
		function(msg){alert(msg);

	}
				  );}</script>
