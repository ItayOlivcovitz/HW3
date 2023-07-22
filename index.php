<?php
require_once("db.php");

// Check if Cookie exists and if so go to home.php
if (isset($_COOKIE['Email'])) {
    header("Location: home.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted values
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $sql = "SELECT * FROM users";
    $results = $conn->query($sql);
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            if ($row['Email'] == $email && $row['Password'] == $password) {
                session_start();
                $_SESSION['name'] = $row['Email'];
                $email = $_POST['Email'];

                if (isset($_POST['gridCheck1'])) {
                    // 30 days
                    $expiration = time() + (30 * 24 * 60 * 60); // 30 days * 24 hours * 60 minutes * 60 seconds
                    setcookie('Email', $_POST["Email"], $expiration, '/');
                }

                $_SESSION['logout'] = true;
                header("Location: home.php");
                exit;
            }
        }
        echo '<script>alert("שם משתמש או סיסמא לא נכונים");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskmaster - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="main-body">
    <h1 class="display-4 text-center text-info-emphasis"><b>התחברות</b></h1>
    <main class="bg-info bg-opacity-25 mt-3 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <form class="mt-0 mt-md-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="row pt-5 mb-3 mt-0 mt-md-5">
                            <div class="mt-4"></div>
                            <label for="inputEmail3" class="col-sm-3 col-form-label">אימייל:</label>
                            <div class="col-sm-9 col-md-8">
                                <input type="email" class="form-control" id="inputEmail3" name="Email" required>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">סיסמא:</label>
                            <div class="col-sm-9 col-md-8">
                                <input type="password" class="form-control" id="inputPassword3" name="Password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 col-sm-4 offset-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        זכור אותי?
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-4 offset-sm-2"></div>
                        </div>
                        <div class="row pb-3 justify-content-center">
                            <div class="row col-xl-6 col-lg-7 col-md-9 col-12">
                                <button id="login" type="submit" class="btn border-2 col-5 btn-primary">התחבר</button>
                                <div class="col-2"></div>
                                <button type="reset" class="btn border-2 btn-danger col-5">נקה טופס</button>
                            </div>
                            <div class="row justify-content-center col-11">
                                <button id="signup" type="submit" class="btn border-2 btn-outline-dark mt-2 ms-4 ms-md-0 me-5 me-md-0 mb-1 mb-sm-0 mt-md-4" onclick="window.location.href='sign_up.php'">הרשמה</button>
                                <button id="forgot_password" type="submit" class="btn border-2 btn-outline-dark mt-2 ms-4 ms-md-0 me-5 me-md-0 mb-1 mb-sm-0 mt-md-4" onclick="window.location.href='forgot_password.php'">שכחת סיסמא?</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 mb-3 col-12 order-md-2 mt-3">
                    <img src="task.png" alt="taskmaster" class="img-fluid">
                </div>
            </div>
        </div>
    </main>
    <script src="add_bootstrap.js"></script>
    <script>
        window.onload = function() {
            createNavbar();
            createFooter();
        };
    </script>
</body>

</html>