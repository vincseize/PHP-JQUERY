<?php

    require_once('conf.php');
    require_once('checkIf_database_table.php');

    try {
        $pdo = new PDO("mysql:host=$servername", $username, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE $dbname";
        // use exec() because no results are returned
        $pdo->exec($sql);
        echo "<font color='green'>Database [ ".$dbname." ] created successfully</font><br>";
        }
    catch(PDOException $e)
        {
            $check = databaseExists($pdo, $sql, $e->getMessage(), $dbname);
        }
    
    $pdo = null;

?>
