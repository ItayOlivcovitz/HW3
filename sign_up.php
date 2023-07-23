<?php
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $first_name = $_POST['First_Name'];
  $last_name = $_POST['Last_Name'];
  $email = $_POST['Email'];
  $email_validation = $_POST['Email_validation'];

  $password = $_POST['Password'];
  $password_validation = $_POST['Password_validation'];

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
  if (!empty($errors)) {
    $errorString = implode("\n", $errors);
    echo '<script>alert("' . $errorString . '");</script>';
  } else {
    $sql = "INSERT INTO `users`(`Id`, `First Name`, `Last Name`, `Email`, `Password`) 
                VALUES (NULL, '$first_name', '$last_name', '$email', '$password')";

    header("Location: index.php");

    if ($conn->query($sql) === TRUE) {
    } else {
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
          <img src="utils/text.png" alt="taskmaster" class="img-fluid">
        </div>
        <form class="col-md-8 col-12 mt-5" id="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

          <p>כל השדות המסומנים ב-<span class="text-danger h5"><b>*</b></span> הינם שדות חובה</p>
          <div class="row g-3 mt-2">
            <div class="col-md-6 col-12">
              <label for="validationDefault01" class="form-label">שם פרטי:<span class="text-danger h5"><b>*</b></span></label>
              <input type="text" class="form-control" id="First_Name" name="First_Name" required>
              <span id="firstNameMsg" class="text-danger"></span>

            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefault02" class="form-label">שם משפחה:<span class="text-danger h5"><b>*</b></span></label>
              <input type="text" class="form-control" id="Last_Name" name="Last_Name" required>
              <span id="lastNameMsg" class="text-danger"></span>

            </div>
            <div class="col-md-6 col-12">

              <label for="validationDefaultUsername" class="form-label">אימייל:<span class="text-danger h5"><b>*</b></span></label>
              <input type="email" class="form-control" id="Email" name="Email" required oninput="EmailInDB()">
              <span id="emailInDBMsg" class="text-danger"></span>

            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefault03" class="form-label">אימות אימייל:<span class="text-danger h5"><b>*</b></span></label>
              <input type="email" class="form-control" id="inputEmail6" name="Email_validation" oninput="validateEmail()">
              <span id="emailValidationMsg" class="text-danger"></span>

            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefault04" class="form-label">סיסמא:<span class="text-danger h5"><b>*</b></span></label>
              <input type="password" class="form-control" id="inputPassword4" name="Password" required>
              <span id="PasswordMsg" class="text-danger"></span>
            </div>
            <div class="col-md-6 col-12">
              <label for="validationDefault05" class="form-label">אימות סיסמא:<span class="text-danger h5"><b>*</b></span></label>
              <input type="password" class="form-control" id="inputPassword5" name="Password_validation" required oninput="validatePassword()">
              <span id="PasswordValidationMsg" class="text-danger"></span>
            </div>
            <div class="col-6 col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">
                  אני מסכים ל
                  <a id="mylink" href="#">תנאי השימוש</a>
                  <span id="checkboxMsger" class="text-danger h5"><b>*</b><br></span>
                  <span id="checkboxMsg" class="text-danger"></span>
                </label>
              </div>
            </div>
            <div class="col-8"></div>
            <div class="col-2 col-md-4"></div>

            <div class="row mb-3 me-md-1 me-1">
              <button class="btn btn-primary col-12 mb-2 ms-md-4 ms-lg-5 ms-xl-5 col-md-4" type="submit"> הרשמה</button>
              <div class="col-xl-2 col-md-2 ms-2 ms-md-4 ms-lg-4 ms-xl-5"></div>
              <button id="clearAllFields" type="reset" class="btn border-2 btn-danger mb-2 me-md-3 col-12 col-md-4 justify-content-left">נקה טופס</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Function to check email availability
    function EmailInDB(callback) {
      var email = document.getElementById('Email').value;
      var emailInDBMsg = document.getElementById('emailInDBMsg');

      // Call the function to check email availability
      checkEmailAvailability(email, function(isAvailable) {
        if (isAvailable) {
          emailInDBMsg.textContent = "כתובת האימייל פנויה לשימוש";
        } else {
          emailInDBMsg.textContent = "כתובת האימייל הזו כבר תפוסה, אנא נסו אחת אחרת.";
        }
        callback(isAvailable);
      });
    }

    function validateEmail() {
      var email = document.getElementById('Email').value;
      var emailValidation = document.getElementById('inputEmail6').value;
      var emailValidationMsg = document.getElementById('emailValidationMsg');

      // Check if the emails match
      if (email !== emailValidation) {
        emailValidationMsg.textContent = "כתובות האימייל לא תואמות!";
        return false;
      } else {
        emailValidationMsg.textContent = "";
        return true;
      }
    }

    function checkEmailAvailability(email, callback) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "queries/check_email.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var emailInDBMsg = document.getElementById('emailInDBMsg');
          document.getElementById('Email').dataset.available = xhr.responseText.trim();
          callback(xhr.responseText.trim() === "true");
        } else if (xhr.readyState === 4) {
          console.error(xhr.responseText);
          callback(false);
        }
      };
      xhr.send("Email=" + email);
    }

    function validatePassword() {
      var password = document.getElementById('inputPassword4').value;
      var passwordValidation = document.getElementById('inputPassword5').value;
      var passwordValidationMsg = document.getElementById('PasswordValidationMsg');

      if (password !== passwordValidation) {
        passwordValidationMsg.textContent = "הסיסמאות אינן תואמות!";
        return false;
      } else {
        passwordValidationMsg.textContent = "";
        return true;
      }
    }

    function submitForm(event) {
      event.preventDefault();

      var checkboxMsg = document.getElementById('checkboxMsg');
      var checkbox = document.getElementById('invalidCheck2');
      if (!checkbox.checked) {
        checkboxMsg.textContent = "נא לאשר את תנאי השימוש";
      }
      var first_name = document.getElementById('First_Name').value;
      var last_name = document.getElementById('Last_Name').value;
      var email = document.getElementById('Email').value;
      var email_validation = document.getElementById('inputEmail6').value;
      var password = document.getElementById('inputPassword4').value;
      var password_validation = document.getElementById('inputPassword5').value;

      var errors = [];

      if (first_name.trim() === '') {
        errors.push("חובה למלא שם פרטי");
        firstNameMsg.textContent = "חובה למלא שם פרטי";
      }

      if (last_name.trim() === '') {
        errors.push("חובה למלא שם משפחה");
        lastNameMsg.textContent = "חובה למלא שם משפחה";

      }

      if (email.trim() === '') {
        errors.push("חובה למלא כתובת אימייל");
        emailInDBMsg.textContent = "חובה למלא כתובת אימייל";
      } else if (!validateEmail()) {
        errors.push("האימייל בפורמט לא תקין. לדוגמא Israel@israeli.co.il");
        emailInDBMsg.textContent = "האימייל בפורמט לא תקין. לדוגמא Israel@israeli.co.il";
      } else if (email !== email_validation) {
        errors.push("כתובות האימייל לא תואמות");
        emailValidationMsg.textContent = "כתובות האימייל לא תואמות!";
      }

      if (password.trim() === '') {
        errors.push("יש למלא סיסמא");
        PasswordMsg.textContent = "יש למלא סיסמא";

      } else if (password !== password_validation) {
        errors.push("הסיסמאות לא תואמות");
        passwordValidationMsg.textContent = "הסיסמאות לא תואמות";

      }

      if (errors.length > 0) {
        var errorString = errors.join("\n");
      } else {
        var form = document.getElementById('signup-form');
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open(form.method, form.action, true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            window.location.href = "index.php";
          } else if (xhr.readyState === 4) {
            console.error(xhr.responseText);
          }
        };
        xhr.send(formData);
      }
    }
    var emailField = document.getElementById('Email');
    emailField.addEventListener('input', EmailInDB);
    var submitButton = document.querySelector('button[type="submit"]');
    submitButton.addEventListener('click', submitForm);
  </script>
  <script src="add_bootstrap.js"></script>
  <script>
    window.onload = function() {
      createNavbar();
      createFooter();
    };
  </script>
  <script>
    document.getElementById("clearAllFields").addEventListener("click", function() {
      var checkboxMsg = document.getElementById('checkboxMsg');
      checkboxMsg.textContent = "";
      firstNameMsg.textContent = "";
      lastNameMsg.textContent = "";
      emailInDBMsg.textContent = "";
      PasswordMsg.textContent = "";
      passwordValidationMsg.textContent = "";
    });
  </script>
</body>

</html>