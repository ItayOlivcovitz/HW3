<?php
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['Email'];

  // Check if the email already exists in the database
  $sql = "SELECT COUNT(*) as count FROM `users` WHERE `Email` = '$email'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $count = $row['count'];

  echo $count === '0' ? 'true' : 'false';
}
?>
