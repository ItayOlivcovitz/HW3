<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["taskID"]) && isset($_POST["listID"])) {
        $taskID = intval($_POST["taskID"]);
        $listID = intval($_POST["listID"]);
        require_once("db.php");

        // Perform the actual deletion
        $query = "DELETE FROM tasks WHERE taskID = $taskID AND listID = $listID";
        $result = $conn->query($query);

        if ($result) {
            // Optionally, you can perform additional actions or return a success message
            echo "Task deleted successfully";
        } else {
            // Handle the deletion error
            echo "Error deleting the task: " . $conn->error; // Add error message
        }
    } else {
        echo "Invalid request";
    }
}
