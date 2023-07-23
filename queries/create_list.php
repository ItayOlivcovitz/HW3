<?php
session_start();
require_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['list_description']) && isset($_POST['selected_users'])) {
    $listDescription = $_POST['list_description'];
    $selectedUsers = json_decode($_POST['selected_users'], true);
    $sql = "INSERT INTO lists (listName, creationDate) VALUES ('$listDescription', NOW())";
    $conn->query($sql);
    $listID = $conn->insert_id;
    foreach ($selectedUsers as $user) {
        $user = mysqli_real_escape_string($conn, $user);
        $sql = "INSERT INTO userinlists (listID, userID) SELECT $listID, `Id` FROM users WHERE CONCAT(`First Name`, ' ', `Last Name`, ' (', Email, ')') = '$user'";
        $conn->query($sql);
    }
    $response = array('listID' => $listID);
    echo json_encode($response);
}
