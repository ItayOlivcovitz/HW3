<?php
session_start();
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['list_description']) && isset($_POST['selected_users'])) {
    // Get the form data
    $listDescription = $_POST['list_description'];
    $selectedUsers = json_decode($_POST['selected_users'], true);

    // Insert the new list into the 'lists' table
    $sql = "INSERT INTO lists (listName, creationDate) VALUES ('$listDescription', NOW())";
    $conn->query($sql);

    // Get the ID of the newly inserted list
    $listID = $conn->insert_id;

    // Insert the users associated with the new list into the 'userinlists' table
    foreach ($selectedUsers as $user) {
        $user = mysqli_real_escape_string($conn, $user);
        $sql = "INSERT INTO userinlists (listID, userID) SELECT $listID, `Id` FROM users WHERE CONCAT(`First Name`, ' ', `Last Name`, ' (', Email, ')') = '$user'";
        $conn->query($sql);
    }

    // Prepare the response with the list ID
    $response = array('listID' => $listID);

    // Send the response back to the AJAX request
    echo json_encode($response);
}
