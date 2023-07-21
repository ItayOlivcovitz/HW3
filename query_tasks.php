<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("db.php");

if (isset($_GET['listID'])) {
    $listID = intval($_GET['listID']);

    // Get the userID based on the user's email from the 'users' table
    $userEmail = $_SESSION['name'];
    $getUserIDQuery = "SELECT `Id` FROM `users` WHERE `Email` = '$userEmail'";
    $userResult = $conn->query($getUserIDQuery);

    if (!$userResult) {
        die("Error: " . $conn->error);
    }

    // Fetch the user's ID
    $userRow = $userResult->fetch_assoc();
    $userID = $userRow['Id'];

    // Query tasks based on listID and userID
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
    // Handle case when listID is not provided in the URL
}
