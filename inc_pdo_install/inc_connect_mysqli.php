<?php
    // OLD METHOD, only for php versions : <= 5.3.0

    require_once('conf.php');

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("<font color='red'>Connection failed: " . mysqli_connect_error()."</font>");
    }
    // echo "<font color='green'>Connected successfully</font>";

    // Close connection
    // mysqli_close($conn);

?>