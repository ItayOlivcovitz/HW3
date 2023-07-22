<?php
session_start();

if (!isset($_COOKIE['Email'])) {
    if (!isset($_SESSION['name'])) {
        header("Location: index.php");
    }
}

require_once("db.php");

function getUserIDByEmail($email)
{
    global $conn;
    $sql = "SELECT `Id` FROM `users` WHERE `Email` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return null; // Email not found in the database
    }
    $row = $result->fetch_assoc();
    return $row["Id"];
}

function getLoggedInUserID()
{
    if (isset($_SESSION['name'])) {
        global $conn;
        $email = $_SESSION['name'];
        $sql = "SELECT `Id` FROM `users` WHERE `Email` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return null; // Email not found in the database
        }
        $row = $result->fetch_assoc();
        return $row['Id'];
    }

    return null; // User not logged in
}

function getHighestTaskID($listID)
{
    global $conn, $tableName;
    $tableName = "tasks";
    $sql = "SELECT MAX(`taskID`) AS `maxTaskID` FROM `$tableName` WHERE `listID` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $listID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return 1; // No tasks for the given listID, start with taskID = 1
    }
    $row = $result->fetch_assoc();
    return intval($row["maxTaskID"]) + 1; // Increment the highest taskID by 1
}

function getUserFullNameByID($userID)
{
    global $conn;
    $sql = "SELECT CONCAT(`First Name`, ' ', `Last Name`) AS full_name FROM `users` WHERE `Id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return null; // User not found in the database
    }
    $row = $result->fetch_assoc();
    return $row["full_name"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["task_description"]) && isset($_POST["user_responsible"])) {
        $taskDescription = $_POST["task_description"];
        $userResponsibleEmail = $_POST["user_responsible"];
        $listID = $_GET["listID"] ?? 0;
        $creationDate = date("Y-m-d");
        $userResponsibleID = getUserIDByEmail($userResponsibleEmail);
        // Check if $userResponsibleID is null or empty, then use the logged-in user's ID
        if (!$userResponsibleID) {
            $userResponsibleID = getLoggedInUserID();
        }
        if ($userResponsibleID !== null) {
            global $conn, $tableName;
            $newTaskID = getHighestTaskID($listID); // Get the new taskID based on the highest taskID for the given listID
            $sql = "INSERT INTO `$tableName` (`listID`, `taskID`, `taskDescription`, `creationDate`, `userID`, `done`)
                    VALUES (?, ?, ?, ?, ?, FALSE)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisss", $listID, $newTaskID, $taskDescription, $creationDate, $userResponsibleID);
            $stmt->execute();
            $stmt->close();
            $userFullName = getUserFullNameByID($userResponsibleID);
            $taskData = array(
                'taskID' => $newTaskID,
                'taskDescription' => $taskDescription,
                'creationDate' => $creationDate,
                'userID' => $userResponsibleID,
                'userFullName' => $userFullName, // Add the user's full name to the task data
                'done' => false
            );
            echo json_encode($taskData);
            exit;
        }
    }
}
