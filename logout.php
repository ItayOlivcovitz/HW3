<?php
session_start();
$_SESSION['name'];
session_destroy();
$cookie_name = 'Email';
$expiration = time() - (30 * 24 * 60 * 60 * 2);
setcookie('Email', '', $expiration, '/');
unset($_COOKIE['Email']);
header("Location: index.php");
exit;

// Set the cookie expiration time to a time in the past (e.g., one hour ago)
