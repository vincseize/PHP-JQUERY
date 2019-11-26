<?php

    // Try a select statement against the database
    // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.

    /**
     * Check if a table exists in the current database.
     *
     * @param PDO $pdo PDO instance connected to a database.
     * @param PDO $sql PDO instance query.
     * @param PDO $message PDO error.
     * @param string $table Table to search for.
     * @return bool TRUE if table exists, FALSE if no table found.
     */
    function tableExists($pdo, $sql, $message, $table) {

        try {
            $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
        } catch (Exception $e) {
            // We got an exception == table not found
            return FALSE;
        }

        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        if($result==TRUE){
            echo "<br><font color='blue'>-- Table [ ".$table." ] already exist</font><br>";
        } else {
            echo "<br><font color='red'>".$sql . "<br>" . $message."</font><br>";
        }

        return $result !== FALSE;
    }

    /**
     * Check if a database exists.
     *
     * @param PDO $pdo PDO instance connected to a database.
     * @param PDO $sql PDO instance query.
     * @param PDO $message PDO error.
     * @param string $dbname Database to search for.
     * @return bool TRUE if table exists, FALSE if no table found.
     */
    function databaseExists($pdo, $sql, $message, $dbname) {

        try {
            $result = $pdo->query("SELECT SCHEMA_NAME
            FROM INFORMATION_SCHEMA.SCHEMATA
            WHERE SCHEMA_NAME = '$dbname'");
        } catch (Exception $e) {
            // We got an exception == database not found
            return FALSE;
        }

        // Result is either boolean FALSE (no database found) or PDOStatement Object (database found)
        if($result==TRUE){
            echo "<font color='blue'>-- Database [ ".$dbname." ] already exist</font><br>";
        } else {
            echo "<br><font color='red'>".$sql . "<br>" . $message."</font><br>";
        }

        return $result !== FALSE;
    }

?>