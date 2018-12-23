<?php
$file=$_GET['code'];
if(strpos($file,'/')!==false)exit();
$myfile = fopen("code/$file", "r") or die("Unable to open file!");
$content= fread($myfile,filesize("code/$file"));
fclose($myfile);



?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $file?></title>
    <meta charset="utf-8">
     

    <link rel="stylesheet" type="text/css" href="prism.css">
    <script src="prism.js"></script>
</head>
<body>
<h1><?php echo $file?></h1>
<p><a href="code/<?php echo $file?>">Click here to download!</a></p>
<pre>
    <code class="language-c">
  <?php echo $content?>

    </code>
</pre>
 
 
</body>
</html>