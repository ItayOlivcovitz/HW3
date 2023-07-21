<?php
require_once("db.php");

// Function to fetch usernames
function fetchTaskUsernamesByListID($listID, $userEmail)
{
    global $conn, $dbName;

    // Select the database
    $conn->select_db($dbName);

    $tableName = "users";
    $sql = "SELECT Email FROM $tableName
            INNER JOIN `userinlists` ON `$tableName`.`Id` = `userinlists`.`userID`
            WHERE `$tableName`.`Email` != ? AND `userinlists`.`listID` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $userEmail, $listID);
    $stmt->execute();
    $result = $stmt->get_result();

    $userEmails = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userEmails[] = $row["Email"];
        }
    }

    return $userEmails;
}
