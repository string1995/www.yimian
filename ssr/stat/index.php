<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Yimian SSR</title>
    <style type="text/css">
      *{font-size:14px;border:0;margin:0;padding:0;}
     body{font-family:'微软雅黑'; margin:0 auto;min-width:980px;}
     ul{display:block;margin:0;padding:0;list-style:none;}
     li{display:block;margin:0;padding:0;list-style: none;}
     .legendShow { position: absolute; top: 10px; z-index:999;  }
     .legendShow ul {width: 100%; }
     .legendShow ul li {  width: 100%; text-align: left;  word-wrap: break-word; line-height: 35px; margin-top:10px; margin-left: 10px; list-style:none;}
     .legendShow ul li i.zx { display: inline-block; text-align: center; width: 15px; height: 15px; line-height: 35px;  background: rgb(134, 151, 34);   }
     .legendShow ul li i { display: inline-block;  text-align: center;width: 15px; height: 15px; line-height: 35px;              }
     .legendShow ul li i.zx {  background:  #1d94bc;  }
     .legendShow ul li i.jx {  background:rgb(134, 151, 34);  }
     .legendShow ul li i.ztz {  background:#FFAA25;  }
     .legendShow ul li span { display: inline-block;  line-height: 35px; margin-left:10px;word-wrap: break-word; }
    </style>
    <script src="jquery-1.11.2.min.js"></script>
    <script src="echarts-3.6.js"></script> 
    <script type="text/javascript">
        $(function ()
        {
            $(".legendShow").css({"top":$(window).height()/5-100,"left":50});
            $("#div_pie").height($(window).height());
            $("#div_pie").width($(window).width());
            var chart = echarts.init(document.getElementById('div_pie'), null, {
                renderer: 'canvas'
            }); 
            chart.setOption({
                angleAxis: {
                    axisLabel:
                        {
                            
                               formatter: function (value, index) { return value * 33500 / 100; }
                        }
                },
                radiusAxis: {
                    type: 'category',
                    data: ["2.07%", "15.53%", ""],
                    z: 10
                },
                textStyle: {
                    color: "#104490",
                    fontSize: 16,
                    fontStyle: 900
                },
                polar: {
                },
                series: [
                    {
                        type: 'bar',
                        itemStyle: {
                            normal: {
                                color: '#1d94bc'
                            }
                        },
                        data:
                            [
                            {
                                value: 100 * 3 / 993.6
                            },
                            {
                                value: 100 * 82.2 / 993.6,
                                show: false,
                                itemStyle: {
                                    normal: {
                                        color: 'rgb(134, 151, 34)'
                                    }

                                },
                            },
                            {
                                value: 100,
                                show: false,
                                itemStyle: {
                                    normal: {
                                        color: '#FFAA25'
                                    }
                                }
                            }
                            ],
                        coordinateSystem: 'polar',
                        name: '总计划',
                        stack: 'a'

                    }],
                legend: {
                    legend: {
                        show: true,
                        data: ["总计划"],
                    }
                }
            });

        });
         
    </script>
</head>
<body>
    <div class="legendShow">
        <ul>
            <li><i class="zx"></i><span>朋友捐赠(3.00) 2.07%</span></li>
            <li><i class="jx"></i><span>已使用(82.2) 15.53%</span></li>
            <li><i class="ztz"></i><span>年预算费用(993.6)</span></li>
        </ul>
    </div>
    <div id="div_pie"></div>
</body>
</html>
