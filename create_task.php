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
        return null;
    }

    $row = $result->fetch_assoc();
    return $row["Id"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["task_description"]) && isset($_POST["user_responsible"])) {
        $taskDescription = $_POST["task_description"];
        $userResponsibleEmail = $_POST["user_responsible"];
        $listID = $_GET["listID"] ?? 0;

        $creationDate = date("Y-m-d");
        $userResponsibleID = getUserIDByEmail($userResponsibleEmail);

        if ($userResponsibleID !== null) {
            global $conn, $dbName, $tableName;

            // Select the database
            $conn->select_db($dbName);

            $tableName = "tasks";
            $sql = "INSERT INTO `$tableName` (`listID`, `taskID`, `taskDescription`, `creationDate`, `userID`, `done`)
                    VALUES (?, NULL, ?, ?, ?, FALSE)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $listID, $taskDescription, $creationDate, $userResponsibleID);
            $stmt->execute();
            $stmt->close();

            header("Location: list.php?listID=" . urlencode($listID));
            exit;
        }
    }
}
?>
<!-- Rest of your HTML code -->