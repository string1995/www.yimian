<!DOCTYPE html>
<?php
//if(!isset($_GET['_pjax'])) header("Location: https://cn.yimian.xyz/video/acg.php?class=".$_GET['class']);
?>

<?php
include '../functions.php';
header('content-type:text/html;charset=utf-8');
$conn=db__connect();

$class=$_GET['class'];


//get row info form table blog with id



$sql = "SELECT * FROM videoIndx where class=$class";


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


                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h1 class="page-header"><?php
							if($class==1)echo 'ACG (动漫)';
							if($class==2)echo 'Movies (电影)';
							if($class==3)echo 'Documentary （纪录片)';
							if($class==4)echo 'TV Play （电视剧)';
							?></h1>  
                        <p class="lead">Share video with the one you love!</p>
                       
<?php                      
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
		echo '<h4><a href="./list.php?idd='.$row['idd']
		.'">' . $row['series'].'</a></h4><p>'.$row['comment'].'</p><br/>';

		
    }
} else {
    echo "404 No Found!";
}?>
						
						
											</br></br><p><a href="index.php">Click here to go back~</a></p>
				</br>
                    </div>
                </div>
