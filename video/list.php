<!DOCTYPE html>


<?php
include '../functions.php';

header('content-type:text/html;charset=utf-8');
$conn=db__connect();

$idd=$_GET['idd'];


//get row info form table blog with id
$series= sql_data($conn,'videoIndx','idd',$idd);

$seriesName= $series['series'];

$class= $series['class'];

$sql = "SELECT * FROM video where idd=$idd";


$result = $conn->query($sql);
?>




<?php //declear function



//fnct of get table row number::(data_cnnct var,table name) ::(row number)
function sql_rowNum($conn,$tableSql)
{
$row_count = $conn->query("SELECT COUNT(*) FROM $tableSql");   
list($row_num) = $row_count->fetch_row(); 
return ($row_num);
}

//fnct of getting row data from database::(data_cnnct var, table name,column name, column value)::(row info)
function sql_data($conn,$table,$clmnName,$value)
{
$sql = "SELECT * FROM $table where $clmnName=$value";

$result = $conn->query($sql);
///禁止非法访问
if ($result->num_rows > 0) {}else{echo "<script>alert('Illegal Visit!');setTimeout(function(){top.location='/404.php';},0)</script>";}

$row = $result->fetch_assoc();

return ($row);

}

function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

?>



<?php yimian__header("Yimian Video","video,Yimian","This is the page for show video detail.");?>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">

<?php yimian__headerEnd()?>
	
	<div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="./">
                       Yimian Video
                    </a>
                </li>
                <li>                    <a href="./"><i class="fa fa-fw fa-home"></i>Video Home</a>
                </li>
                <li>
                    <a href="./acg.php?class=1"><i class="fa fa-fw fa-folder"></i> ACG</a>
                </li>
                <li>
                    <a href="./acg.php?class=2"><i class="fa fa-fw fa-file-o"></i> Movies</a>
                </li>
                <li>
                    <a href="./acg.php?class=3"><i class="fa fa-fw fa-cog"></i> Documentary</a>
                </li>
                <li>
                    <a href="./acg.php?class=4"><i class="fa fa-fw fa-cog"></i> TV Play</a>
                </li>

                <li>
                    <a href="../"><i class="fa fa-fw fa-twitter"></i>Back to Yimian Page</a>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
          </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h1 class="page-header"><?php echo $seriesName?></h1>  
                        <p class="lead">Share video with the one you love!</p>
<?php                      
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
		echo '<p><a href="./video.php?id='.$row['id']
		.'">' . $row['name'].'</a></p>';

		
    }
} else {
    echo "404 No Found!";
}?>
						</br></br><p><a href="acg.php?class=<?php echo $class?>">Click here to go back~</a></p>
				</br>

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
		  var trigger = $('.hamburger'),
		      overlay = $('.overlay'),
		     isClosed = false;

		    trigger.click(function () {
		      hamburger_cross();      
		    });

		    function hamburger_cross() {

		      if (isClosed == true) {          
		        overlay.hide();
		        trigger.removeClass('is-open');
		        trigger.addClass('is-closed');
		        isClosed = false;
		      } else {   
		        overlay.show();
		        trigger.removeClass('is-closed');
		        trigger.addClass('is-open');
		        isClosed = true;
		      }
		  }
		  
		  $('[data-toggle="offcanvas"]').click(function () {
		        $('#wrapper').toggleClass('toggled');
		  });  
		});
	</script>

<?php yimian__simpleFooter()?>
	
	