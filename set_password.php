<?php
require_once "db.php";
$key = $_GET["key"];
$email =  $_GET["email"];
$email = $conn->real_escape_string($email);
$key = $conn->real_escape_string($key);
$query = "SELECT COUNT(*) AS count FROM users WHERE email = '$email' AND restorekey = '$key'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count < 1) {
    die("Not a valid email or key");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"];
    $password = $conn->real_escape_string($password);
    $updateQuery = "UPDATE users SET password = '$password' WHERE email = '$email'";
    if ($conn->query($updateQuery)) {
        echo "<script>alert('סיסמא עודכנה בהצלחה'); window.location.href = 'index.php';</script>";
        exit;
    } else {
        echo "Error occurred while updating the password";
    }
}
?>

<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskmaster - Set Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body class="main-body">
    <h1 class="display-4 text-center text-info-emphasis"><b>הגדרת סיסמה חדשה</b></h1>
    <main class="bg-info bg-opacity-25 mt-3 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <form class="mt-0 mt-md-5" action="<?php echo $_SERVER['PHP_SELF'] . '?key=' . $key . '&email=' . $email; ?>" method="POST" onsubmit="return validateForm();">
                        <div class="row pt-5 mb-3 mt-0 mt-md-5">
                            <div class="mt-4"></div>
                            <label for="inputPassword" class="col-sm-3 col-md-2 col-form-label">סיסמה חדשה:</label>
                            <div class="col-sm-9 col-md-8">
                                <br><input type="password" class="form-control" id="inputPassword" name="password" required>
                            </div>
                        </div>
                        <div class="container me-1 me-md-5 ms-1">
                            <div class="row col-md-10 col-12 me-md-5  ms-1">
                                <button type="submit" class="btn border-2 col-md-4 col-5  btn-primary">שחזור ססמא</button>
                                <div class="col-md-1 col-2  ms-md-3 ms-lg-4"></div>
                                <button type="reset" class="btn border-2 col-md-4 col-5 btn-danger ">נקה טופס</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 mb-3 col-12 order-md-2 mt-3">
                    <img src="utils/forgotPassword.jpg" alt="taskmaster" class="img-fluid">
                </div>
            </div>
        </div>
    </main>
    <script>
        function validateForm() {
            var password = document.getElementById("inputPassword").value;
            if (password.trim() === '') {
                alert("יש למלא סיסמה");
                return false;
            }
            return true;
        }
    </script>
    <script src="add_bootstrap.js"></script>
    <script>
        window.onload = function() {
            createNavbar();
            createFooter();
        };
    </script>
</body>

</html>