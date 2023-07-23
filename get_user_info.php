<?php
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) {
  $user_email = $_GET['email'];
  $tableName = "users";
  $sql = "SELECT CONCAT(`First Name`, ' ', `Last Name`, ' (', Email, ')') AS `user_info` FROM `$tableName` WHERE Email = '$user_email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response = array('user_info' => $row['user_info']);
    echo json_encode($response);
  } else {
    echo json_encode(array());
  }
}
