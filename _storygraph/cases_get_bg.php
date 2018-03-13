<?php
// Start the session
// session_start();

// require('../inc/inc.php');

$auth_cases_ext = array("jpg", "jpeg", "png", "gif");

function getCasesThumb($pattern) {

    $subPatterns = explode('/**/', $pattern);

    // Get sub dirs
    $dirs = glob(array_shift($subPatterns) . '/*', GLOB_ONLYDIR);

    // Get files in the current dir
    $files = glob($pattern);
    
    foreach ($dirs as $dir) {
        // echo $dir;
        $subDirList = getCasesThumb($dir . '/**/' . implode('/**/', $subPatterns));
        //$file = basename($subDirList);
        // $chunks = explode('/', $subDirList);
        // $file = end($chunks);
        // echo $file."<br>";
        //$files = array_merge($files, $subDirList);
        $files = array_merge($files, $subDirList);
    }

    $array_thumbs= array();
    foreach ($files as $file) {
        // $value = $value * 2;
        //echo $file."<br>";
        $chunks = explode('/', $file);
        $filename = end($chunks);
        //$filemtime = filemtime($file);
        //."?". filemtime($path_case."/thumbs/".$asset."_".$number."_bg.".$ext);
        $number = explode('_', $filename)[1];
        $array_thumbs[$number] = $filename."?".filemtime($file);
    }

    // return $files;
    // $json = json_encode($array_thumbs);
    // print_r($json);
    return $array_thumbs;
}

// require('../inc/fcts.php');

// $files = getCasesThumb("../**/thumbs/case_*_bg.*");
$files = getCasesThumb("__projects/1_aufildeleau/cases/**/thumbs/case_*_bg.*");
// print_r($files);
echo json_encode($files);
//echo $files;
//exit();

?>
