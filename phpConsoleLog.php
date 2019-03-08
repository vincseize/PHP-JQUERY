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
<!-- // usage
# For Array
jsLogs(array("test1", "test2")); # PHP: ["test1","test2"]
# For Object
jsLogs(array("test1"=>array("subtest1", "subtest2"))); #PHP: {"test1":["subtest1","subtest2"]}
# For String
jsLogs("testing string"); #PHP: testing string -->
