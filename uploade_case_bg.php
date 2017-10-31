<?php
$str =file_get_contents('php://input');
//$dir = 'tmp/cases/';

$url_upload = $_GET['url_upload'];


$ext = $_SERVER['HTTP_X_FILE_TYPE'];
$e = explode("/",$ext);
$ext = $e[1];

$name = $_SERVER['HTTP_X_FILE_NAME'];
$filename = $name.'.'.$ext;

$e = explode("_",$filename);
$dir_case = $e[0].'_'.$e[1];

if (!file_exists($url_upload.$dir_case)) {
    mkdir($url_upload.$dir_case, 0777, true);
}

$path = $url_upload.$dir_case.'/'.$filename;
file_put_contents($path,$str);

// echo $path;

// $myfile = fopen($url_upload."newfile.txt", "w") or die("Unable to open file!");
// $txt = $url_upload."\n";
// fwrite($myfile, $txt);

?>
