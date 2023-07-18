<?php
$servername = "localhost";
$username = "root";
$password = ""; // If you have set a password for your MySQL server, enter it here

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Database name
$dbName = "207745639_208610840"; // Replace with your desired database name

// Create the database if it doesn't exist
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbName`");

// Select the database
$conn->select_db($dbName);

// Create the 'users' table if it doesn't exist
$tableName = "users";
$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
    `Id` INT(255) NOT NULL AUTO_INCREMENT,
    `First Name` VARCHAR(999) NOT NULL,
    `Last Name` VARCHAR(999) NOT NULL,
    `Email` VARCHAR(999) NOT NULL,
    `Password` VARCHAR(999) NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB";

$conn->query($sql); // Execute the table creation query

// Insert additional users if the 'users' table is empty
$additionalUsersSql = "INSERT INTO `$tableName` (`Id`, `First Name`, `Last Name`, `Email`, `Password`)
    SELECT NULL, 'User1', 'User1', 'user1@test.test', 'test123' UNION
    SELECT NULL, 'User2', 'User2', 'user2@test.test', 'test123' UNION
    SELECT NULL, 'User3', 'User3', 'user3@test.test', 'test123'
    FROM DUAL
    WHERE NOT EXISTS (SELECT * FROM `$tableName`)";

$conn->query($additionalUsersSql); // Execute the additional users insertion query

$conn->close(); // Close the database connection
?>