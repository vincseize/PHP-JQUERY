<?php
session_start();

$path_login_ok = 'login_session_ok.php';

$conn = mysqli_connect("localhost","root","","phppot_examples");
    
$message="";
if(!empty($_POST["login"])) {
    $result = mysqli_query($conn,"SELECT * FROM users WHERE user_name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
        $_SESSION["user_id"] = $row['user_id'];
        $message = "Login OK";
    } else {
    $message = "Invalid Username or Password!";
    echo $message;
    // destroy session redirect
    }
} else {

    $message = "Invalid Username or Password!";
    echo $message;
    // destroy session redirect

}


// fake ok redirection
header('Location: '.$path_login_ok);

?>