<?php
session_start();
require_once("db.php");
$user_email = $_SESSION['name'];
$query =    "SELECT lists.listID, lists.listName, lists.creationDate, GROUP_CONCAT(' ', users.`First Name`, ' ', users.`Last Name`) AS users
            FROM lists
            LEFT JOIN userinlists ON lists.listID = userinlists.listID
            LEFT JOIN users ON userinlists.userID = users.Id
            WHERE lists.listID IN (
                SELECT lists.listID
                FROM lists
                LEFT JOIN userinlists ON lists.listID = userinlists.listID
                LEFT JOIN users ON userinlists.userID = users.Id
                WHERE users.Email = '$user_email'
            )
            GROUP BY lists.listID";

$result = mysqli_query($conn, $query);

if ($result) {
    $lists = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $lists[] = $row;
    }
    echo json_encode($lists);
} else {
    echo json_encode(array());
}
