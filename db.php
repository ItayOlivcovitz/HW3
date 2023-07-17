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


if ($conn->query($sql) === TRUE) {
    // echo "Table created successfully";

} else {
    // echo "Error creating table: " . $conn->error;
}

// Insert  record if the 'users' table is empty
$insertSql = "INSERT INTO `$tableName` (`Id`, `First Name`, `Last Name`, `Email`, `Password`)
    SELECT NULL, 'Itay', 'Hamelech', 'test@test.test', 'test'
    FROM DUAL
    WHERE NOT EXISTS (SELECT * FROM `$tableName`)";

if ($conn->query($insertSql) === TRUE) {
    //  echo "Initial record created successfully";
} else {
    //echo "Error: " . $insertSql . "<br>" . $conn->error;
}
