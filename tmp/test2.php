		<script type="text/javascript" src="../video/js/jquery.min.js"></script>     


<form class="mt-3" action="https://ice.xjtlu.edu.cn/login/index.php" method="post" id="login" >
                        <input id="anchor" type="hidden" name="anchor" value="">
                        <script>document.getElementById('anchor').value = location.hash;</script>
                        <div class="form-group">
                            <label for="username" class="sr-only">
                                    Username
                            </label>
                            <input type="hidden" name="username" id="username"
                                class="form-control"
                                value="yimian.liu17"
                                placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="hidden" name="password" id="password" value="lymian$0904@112"
                                class="form-control"
                                placeholder="Password">
                        </div>
                            <div class="rememberpass mt-3">
                                <input type="checkbox" name="rememberusername" id="rememberusername" value="1"  />
                                <label for="rememberusername">Remember username</label>
                            </div>

                        <button type="submit" class="btn btn-primary btn-block mt-3" id="loginbtn">Log in</button>
                    </form>
<script>$("#login").submit();</script>
