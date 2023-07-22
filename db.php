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
    `restorekey` VARCHAR(255),
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
    WHERE NOT EXISTS (SELECT * FROM `$tableName`)
    UNION
    SELECT NULL, 'User1', 'User1', 'user1@test.test', 'test123'
    FROM DUAL
    WHERE NOT EXISTS (SELECT * FROM `$tableName`)
    UNION
    SELECT NULL, 'User2', 'User2', 'user2@test.test', 'test123'
    FROM DUAL
    WHERE NOT EXISTS (SELECT * FROM `$tableName`)
    UNION
    SELECT NULL, 'User3', 'User3', 'user3@test.test', 'test123'
    FROM DUAL
    WHERE NOT EXISTS (SELECT * FROM `$tableName`)";
if ($conn->query($insertSql) === TRUE) {
    //  echo "Initial record created successfully";
} else {
    //echo "Error: " . $insertSql . "<br>" . $conn->error;
}

// Create the 'lists' table if it doesn't exist
$tableName = "lists";
$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
`listID` int(11) NOT NULL,
  `listName` varchar(256) NOT NULL,
  `creationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if ($conn->query($sql) === TRUE) {
    // echo "Table created successfully";

} else {
    // echo "Error creating table: " . $conn->error;
}

// Create the 'userinlists' table if it doesn't exist
$tableName = "userinlists";
$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
    `listID` int(11) NOT NULL,
    `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if ($conn->query($sql) === TRUE) {
    // echo "Table created successfully";

} else {
    // echo "Error creating table: " . $conn->error;
}

// Create the 'tasks' table if it doesn't exist
$tableName = "tasks";
$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
    `listID` int(11) NOT NULL,
    `taskID` int(11) NOT NULL,
    `taskDescription` varchar(256) NOT NULL,
    `creationDate` date NOT NULL,
    `userID` int(11) NOT NULL,
    `done` BOOLEAN NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
";

if ($conn->query($sql) === TRUE) {
    // echo "Table created successfully";

} else {
    // echo "Error creating table: " . $conn->error;
}
