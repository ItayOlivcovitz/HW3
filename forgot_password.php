<?php
// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the request is for password recovery
  if (isset($_POST['recover_password'])) {
    $email = $_POST['Email'];

    // Check if the email exists in the database
    // Assuming you have a database connection named $conn
    $sql = "SELECT * FROM `users` WHERE `Email` = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      
    } else {
      
    }
  }
}

// ...
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
  
    </main>
    <h1 class="display-4 text-center text-info-emphasis"><b>שחזור ססמא</b></h1>
  <main class="bg-info bg-opacity-25 mt-3 mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-2 col-12 order-md-1 mt-5">
          <div class="mt-4"></div>
          <img src="forgotPassword.jpg" alt="taskmaster" class="img-fluid">
        </div>
        <form class="col-md-8 col-12 mt-5" id="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

          <p> נא מלא את המייל שאיתו נרשמת לאתר לצורך שחזור סיסמא</p>
          <div class="row g-3 mt-2">
            <div class="col-md-6 col-12">
              <label for="validationDefault01" class="form-label">אימייל:</label>
              <input type="text" class="form-control" id="First_Name" name="First_Name" required>
            </div>
            <div class="row mb-3 me-md-1 me-1">
              <button class="btn btn-primary col-12 mb-2 ms-md-4 ms-lg-5 ms-xl-5 col-md-4" type="submit"> הרשמה</button>
              <div class="col-xl-2 col-md-2 ms-2 ms-md-4 ms-lg-4 ms-xl-5"></div>
           
            </div>
    <script src="add_bootstrap.js"></script>
    <script>
        window.onload = function() {
            createNavbar();
            createFooter();
        };
    </script>
</body>

</html>