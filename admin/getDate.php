<?php
$EndDate = "";
$file = 'EndDate.txt';
if (file_exists($file)) {
        $EndDate = file_get_contents($file);
}


header("Content-type: text/javascript");

/* our multidimentional php array to pass back to javascript via ajax */
/*$arr = array(
        array(
                "first_name" => "Darian",
                "last_name" => "Brown",
                "age" => "28",
                "email" => "darianbr@example.com"
        ),
        array(
                "first_name" => "John",
                "last_name" => "Doe",
                "age" => "47",
                "email" => "john_doe@example.com"
        )
);*/

$arr = array(
        array(
                "endDate" => $EndDate
        )
);



/* encode the array as json. this will output [{"first_name":"Darian","last_name":"Brown","age":"28","email":"darianbr@example.com"},{"first_name":"John","last_name":"Doe","age":"47","email":"john_doe@example.com"}] */
echo json_encode($arr);
?>

