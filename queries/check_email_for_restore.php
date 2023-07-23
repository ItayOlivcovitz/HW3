<?php
require_once("../db.php");
$email = $_GET['email'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
                "message" => "אימייל קיים במערכת",
            ));
            die();
        }
    } else {
        echo json_encode(array(
            "success" => false,
            "message" => "כתובת אימייל לא קיימת במערכת",
        ));
        die();
    }
} else {
    echo json_encode(array(
        "success" => false,
        "message" => "כתובת אימייל אינה תקינה",
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
