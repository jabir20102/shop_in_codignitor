<?php

// $myfile = fopen("C:/Users/jabir/Desktop/React-native commands.txt", "r") or die("Unable to open file!");
// echo fread($myfile,filesize("C:/Users/jabir/Desktop/React-native commands.txt"));
// fclose($myfile);

$dir = "C:/Users/jabir/Desktop/";

// // Sort in ascending order - this is default
// $a = scandir($dir);

// foreach ($a as $b) {
// 	$path=$dir."/".$b;
// 	$ext  = (new SplFileInfo($path))->getExtension();
// 	if($ext=='txt'){
// 	$myfile = fopen($path, "r") or die("Unable to open file!");
// echo fread($myfile,filesize($path));
// fclose($myfile);
// echo "<br>..............................<br>";
// }

// }


$path="C:/Users/";
$dirs = array();

// directory handle
$dir = dir($path);

while (false !== ($entry = $dir->read())) {
    if ($entry != '.' && $entry != '..') {
       if (is_dir($path . '/' .$entry)) {
            $dirs[] = $entry; 
       }
    }
}

echo "<pre>"; print_r($dirs); exit;


?>