
<?php
$color=$_GET['color'];
if($color) {
    $path = $color . '.html';
    include($path);
}
?>