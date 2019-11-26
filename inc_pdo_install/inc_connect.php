<?php
    // PDO for php versions : >= 7.0.1

    require_once('conf.php');
    
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "<font color='red'>Connected successfully</font>";
        }
    catch(PDOException $e)
        {
        echo "<font color='red'>Connection failed: " . $e->getMessage()."</font>";
        }

    // Close connection
    // $pdo = null;

?>