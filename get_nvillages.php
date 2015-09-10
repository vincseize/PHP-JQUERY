<?php
    require_once("inc_links.php");




$directoryBIG = DIRECTORY_BIG;
$directoryLOW = DIRECTORY_LOW;
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

define('N_VILLAGES', $nvillages);





    ?>