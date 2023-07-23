<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$dbName = "207745639_208610840";
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbName`");
$conn->select_db($dbName);
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
} else {
}

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
} else {
}

$tableName = "lists";
$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
`listID` INT NOT NULL AUTO_INCREMENT,
  `listName` varchar(256) NOT NULL,
  `creationDate` date NOT NULL 
  , PRIMARY KEY (`listID`)) ENGINE=InnoDB";
if ($conn->query($sql) === TRUE) {
} else {
}

$tableName = "userinlists";
$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
    `listID` int(11) NOT NULL,
    `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
if ($conn->query($sql) === TRUE) {
} else {
}

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
} else {
}
