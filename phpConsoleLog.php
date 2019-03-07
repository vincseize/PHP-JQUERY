<?php
function jsLogs($data) {
    $html = "";$coll;
    if (is_array($data) || is_object($data)) {$coll = json_encode($data);} 
    else {$coll = $data;}
    $html = "<script>console.log('PHP: ".$coll."');</script>";
    echo($html);
    # exit();
}
?>
