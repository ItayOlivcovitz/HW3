<?php
require_once("db.php");
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT CONCAT(`First Name`, ' ', `Last Name`) AS fullname FROM `users` WHERE `Email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullName = $row['fullname'];
        echo json_encode(array('fullname' => $fullName));
    } else {
        echo json_encode(array('fullname' => null));
    }
} else {
    echo json_encode(array('fullname' => null));
}
