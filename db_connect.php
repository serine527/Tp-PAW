<?php


function db_connect() {
    // Load DB credentials
    $config = require __DIR__ . "/config.php";

    try {
        // Create PDO connection
        $dsn = "mysql:host=" . $config["host"] . ";dbname=" . $config["database"] . ";charset=utf8";
        $pdo = new PDO($dsn, $config["username"], $config["password"], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        return $pdo; 
    } 
    catch (PDOException $e) {

        
        file_put_contents(
            __DIR__ . "/db_errors.log",
            date("Y-m-d H:i:s") . " - " . $e->getMessage() . "\n",
            FILE_APPEND
        );

        return false; // FAILED
    }
}
