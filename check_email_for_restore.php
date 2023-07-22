<?php
require_once("db.php");
// Assuming you have already established a database connection
// Retrieve the email address from $_POST
$email = $_GET['email'];
// Validate the email address
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Email address is valid, check if it exists in the database
    $query = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    if ($count > 0) {
        $restoreKey = generateRandomString(18);
        $restoreKey = $conn->real_escape_string($restoreKey);
        $query = "UPDATE users SET restoreKey = '$restoreKey' WHERE email = '$email'";
        if ($conn->query($query)) {
            echo json_encode(array(
                "success" => true,
                "key" => $restoreKey,
                "message" => "Email exists in the database ",
            ));
            die();
        }
    } else {
        echo json_encode(array(
            "success" => false,
            "message" => "Email does not exist in the database",
        ));
        die();
    }
} else {
    // Invalid email address
    echo json_encode(array(
        "success" => false,
        "message" => "Invalid email address",
    ));
    die();
}


function generateRandomString($length = 18)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
