<?php
$str =file_get_contents('php://input');
$dir = 'tmp/cases/';


$ext = $_SERVER['HTTP_X_FILE_TYPE'];
$e = explode("/",$ext);
$ext = $e[1];

$name = $_SERVER['HTTP_X_FILE_NAME'];
$filename = $name.'.'.$ext;

$e = explode("_",$filename);
$dir_case = $e[0].'_'.$e[1];

if (!file_exists($dir.$dir_case)) {
    mkdir($dir.$dir_case, 0777, true);
}

$path = $dir.$dir_case.'/'.$filename;
file_put_contents($path,$str);

echo $path;
?>
