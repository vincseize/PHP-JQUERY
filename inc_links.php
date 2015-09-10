
<?php
$rootDirName =basename(__DIR__);
// $sitename = "zemelattitude2";
$sitename = $rootDirName;
$root = realpath($_SERVER["DOCUMENT_ROOT"])."/".$sitename;
$rootServerPath = dirname(__FILE__);


$directoryBIG = 'admin/upload/server/php/files/';
$directoryLOW = 'admin/upload/server/php/files/thumbnail/';

define('DIRECTORY_BIG', $directoryBIG);
define('DIRECTORY_LOW', $directoryLOW);

define('TITLE_SITE', $sitename);

define('HOMEPATH', 'http://'.$_SERVER['HTTP_HOST'].'/'.$sitename);


/*
$directoryBIG = 'admin/upload/server/php/files/';
$directoryLOW = 'admin/upload/server/php/files/thumbnail/';
$dir = $directoryBIG;

		$files = array();
		$handler = opendir($dir); // open the cwd..also do an err check.
		while(false != ($file = readdir($handler))) {
		        if(($file != ".") and ($file != "..") and ($file != "index.php")) {
			// $files[] = $file; // put in array.

			if(is_file($dir.$file)){
					

							                $tmp = explode(".", $file);
							                // echo $tmp;
							                @$ext = $tmp[1] ;
							                $files[] = $ext; // put in array.



			}


							        }   

		}

$nvillages = count($files);

define('N_VILLAGES', $nvillages);*/

// echo N_VILLAGES;




?>
