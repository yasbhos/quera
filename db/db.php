<?php

$servername = "localhost";
$username = "yasbhos";
$password = "3MnCLFLRcc2nG2k";
$dbname = "quera";

try {
    global $db_conn;
    $db_conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function create_db_tables(): void
{
    global $db_conn;
    $db_conn->exec("
        CREATE TABLE IF NOT EXISTS options (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            option_name TEXT NOT NULL,
            option_value TEXT NOT NULL
        );
    ");

    $db_conn->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL UNIQUE,
            password VARCHAR(40) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE,
            first_name VARCHAR(30) NOT NULL,
            last_name VARCHAR(30) NOT NULL
        )
    ");
}

function close_db_conn(): void
{
    global $db_conn;
    $db_conn = null;
}