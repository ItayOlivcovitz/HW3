<?php
require_once("../db.php");
function fetchUsernames()
{
    $user_email = $_SESSION['name'];
    global $conn, $dbName;
    $conn->select_db($dbName);
    $tableName = "users";
    $sql = "SELECT CONCAT(`First Name`, ' ', `Last Name`, ' (', Email, ')') AS `user_info` FROM `$tableName` WHERE Email != '$user_email'";
    $result = $conn->query($sql);
    $usernames = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usernames[] = $row["user_info"];
        }
    }
    return $usernames;
}
