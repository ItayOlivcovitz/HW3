<?php
require_once("db.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted values
  $first_name = $_POST['First_Name'];
  $last_name = $_POST['Last_Name'];
  $email = $_POST['Email'];
  $email_validation = $_POST['Email_validation'];

  $password = $_POST['Password'];
  $password_validation = $_POST['Password_validation'];

  // Perform basic form validation
  $errors = [];

  if (empty($first_name)) {
    $errors[] = "First name is required";
  }

  if (empty($last_name)) {
    $errors[] = "Last name is required";
  }
  if (empty($email)) {
    $errors[] = "Email name is required";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  }
  if ($email !== $email_validation) {
    $errors[] = "Emails do not match";
  }

  if (empty($password)) {
    $errors[] = "Password is required";
  }
  if ($password !== $password_validation) {
    $errors[] = "Passwords do not match";
  }

  // If there are validation errors, display them to the user
  if (!empty($errors)) {
    $errorString = implode("\n", $errors);
    echo '<script>alert("' . $errorString . '");</script>';
  } else {
    // Validation passed, proceed with inserting data into the database

    // Create the SQL query with proper quoting of string values
    $sql = "INSERT INTO `users`(`Id`, `First Name`, `Last Name`, `Email`, `Password`) 
                VALUES (NULL, '$first_name', '$last_name', '$email', '$password')";

    header("Location: index.php");

    if ($conn->query($sql) === TRUE) {
      // echo "New record created successfully";
    } else {
      //  echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
?>


<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taskmaster - Sign up</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="main-body">
  <h1 class="display-4 text-center text-info-emphasis"><b>הרשמה</b></h1>
  <main class="bg-info bg-opacity-25 mt-3 mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-2 col-12 order-md-1 mt-5">
          <div class="mt-4"></div>
          <img src="text.png" alt="taskmaster" class="img-fluid">
        </div>
        <form class="col-md-8 col-12 mt-5" id="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

          <p>כל השדות המסומנים ב-<span class="text-danger h5"><b>*</b></span> הינם שדות חובה</p>
          <div class="row g-3 mt-2">
            <div class="col-md-6 col-12">
              <label for="validationDefault01" class="form-label">שם פרטי:<span class="text-danger h5"><b>*</b></span></label>
              <input type="text" class="form-control" id="First_Name" name="First_Name" required>
            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefault02" class="form-label">שם משפחה:<span class="text-danger h5"><b>*</b></span></label>
              <input type="text" class="form-control" id="Last_Name" name="Last_Name" required>
            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefaultUsername" class="form-label">אימייל:<span class="text-danger h5"><b>*</b></span></label>
              <div class="input-group">
                <input type="email" class="form-control" id="Email" name="Email" required>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefault03" class="form-label">אימות אימייל:<span class="text-danger h5"><b>*</b></span></label>
              <input type="email" class="form-control" id="inputEmail6" name="Email_validation" required>
            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefault04" class="form-label">סיסמא:<span class="text-danger h5"><b>*</b></span></label>
              <input type="password" class="form-control" id="inputPassword4" name="Password" required>
            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefault05" class="form-label">אימות סיסמא:<span class="text-danger h5"><b>*</b></span></label>
              <input type="password" class="form-control" id="inputPassword5" name="Password_validation" required>
            </div>
            <div class="col-6 col-md-4 ">
              <div class="form-check ">
                <input class="form-check-input " type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">
                  אני מסכים ל
                  <a id="mylink" href="#">תנאי השימוש</a>
                  <span class="text-danger h5"><b>*</b></span></label>
              </div>
            </div>
            <div class="col-8"></div>
            <div class="col-2 col-md-4 "></div>

            <div class="row mb-3 me-md-1 me-1">
              <button class="btn btn-primary col-12 mb-2 ms-md-4 ms-lg-5 ms-xl-5 col-md-4" type="submit"> הרשמה</button>
              <div class="col-xl-2 col-md-2 ms-2 ms-md-4 ms-lg-4 ms-xl-5"></div>
              <button type="reset" class="btn border-2 btn-danger mb-2 me-md-3 col-12 col-md-4 justify-content-left">נקה טופס</button>
            </div>

          </div>
        </form>
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