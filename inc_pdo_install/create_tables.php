<?php

    require_once('inc_connect.php');
    require_once('checkIf_database_table.php');

    // sql to create table(s)

    // ---------------------------------------------------------------------------
    $table = 'clients';
    try {
        $sql = "CREATE TABLE $table (
        
        -- // Columns
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL
        -- //

        )";
    
        $pdo->exec($sql);
        echo "<br>-- <font color='green'>Table [ ".$table." ] created successfully</font>";
        }
    catch(PDOException $e)
        {
            $check = tableExists($pdo, $sql, $e->getMessage(), $table);
        }
    // ---------------------------------------------------------------------------
    $table = 'hotels';
    try {
        $sql = "CREATE TABLE $table (
        
        -- // Columns
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL,
        adresse TEXT NOT NULL
        -- //

        )";
    
        $pdo->exec($sql);
        echo "<br>-- <font color='green'>Table [ ".$table." ] created successfully</font>";
        }
    catch(PDOException $e)
        {
            $check = tableExists($pdo, $sql, $e->getMessage(), $table);
        }
    // ---------------------------------------------------------------------------
    $table = 'chambres';
    try {
        $sql = "CREATE TABLE $table (
        
        -- // Columns
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        numero VARCHAR(30) NOT NULL
        -- //

        )";
    
        $pdo->exec($sql);
        echo "<br>-- <font color='green'>Table [ ".$table." ] created successfully</font>";
        }
    catch(PDOException $e)
        {
            $check = tableExists($pdo, $sql, $e->getMessage(), $table);
        }
    // ---------------------------------------------------------------------------
    $table = 'bookings';
    try {
        $sql = "CREATE TABLE $table (
        
        -- // Columns
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        debut VARCHAR(30) NOT NULL,
        fin VARCHAR(30) NOT NULL,
        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        -- //

        )";
    
        $pdo->exec($sql);
        echo "<br>-- <font color='green'>Table [ ".$table." ] created successfully</font>";
        }
    catch(PDOException $e)
        {
            $check = tableExists($pdo, $sql, $e->getMessage(), $table);
        }
    // ---------------------------------------------------------------------------

    // close connection
    $pdo = null;


?>
