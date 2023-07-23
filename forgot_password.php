<?php
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskmaster - forgot password</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="main-body">
    <h1 class="display-4 text-center text-info-emphasis"><b>שחזור סיסמה</b></h1>

    <main class="bg-info bg-opacity-25 mt-3 mb-5">
        <div class="container">
            <div class="row ">
                <div class="col-md-4 mb-2 col-12 order-md-1 ">
                    <div class="mt-2"></div>
                    <img src="utils/forgotPassword.jpg" alt="taskmaster" class="img-fluid">
                </div>
                <form class="col-md-8 col-12 mt-5" id="password_restore" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <div class="row g-3 mt-2">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="mb-3 text-center" for="email"> נא למלא את המייל שאיתו נרשמת לאתר לצורך שחזור סיסמא <br><span class="warning text-danger d-none">כתובת האימייל אינה קיימת</span> </label>
                                <input type="email" class="form-control" id="email_forgot_password" name="email" placeholder="אנא הכניסו פרטי אימייל" required>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <div class="row mb-3 me-md-1 me-1">
                            <div class="col-xl-2 col-md-2 ms-2 ms-md-4 ms-lg-4 ms-xl-5"></div>
                        </div>
                        <div class="col-xl-2 col-md-2 ms-2 ms-md-4 ms-lg-4 ms-xl-5"></div>
                    </div>
                </form>
            </div>


        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts.js"></script>
    <script src="add_bootstrap.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        window.onload = function() {
            createNavbar();
            createFooter();
        };
    </script>
</body>

</html>