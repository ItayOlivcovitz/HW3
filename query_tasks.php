<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("db.php");
if (isset($_GET['listID'])) {
    $listID = intval($_GET['listID']);
    $userEmail = $_SESSION['name'];
    $getUserIDQuery = "SELECT `Id` FROM `users` WHERE `Email` = '$userEmail'";
    $userResult = $conn->query($getUserIDQuery);

    if (!$userResult) {
        die("Error: " . $conn->error);
    }
    $userRow = $userResult->fetch_assoc();
    $userID = $userRow['Id'];
    $query = "SELECT * FROM `tasks` WHERE `listID` = $listID AND `userID` = $userID";
    $result = $conn->query($query);
    if (!$result) {
        die("Error: " . $conn->error);
    }
    $tasks = array();
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
} else {
}
function getUserFullNameByEmail($email)
{
    global $conn;
    $sql = "SELECT CONCAT(`First Name`, ' ', `Last Name`) AS full_name FROM `users` WHERE `Email` = '$email'";
    $result = $conn->query($sql);
    if (!$result || $result->num_rows === 0) {
        return "Unknown User";
    }
    $row = $result->fetch_assoc();
    return $row['full_name'];
}
