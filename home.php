<?php
session_start();
$_SESSION['name'];
if (!isset($_COOKIE['Email'])) {
  if (!isset($_SESSION['name'])) {
    header("Location: index.php");
  }
}
?>
  
  
<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taskmaster - Homepage</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="main-body">
  <h1 class="display-4 text-center text-info-emphasis"><b>כל הרשימות שלי</b></h1>
  <main class="bg-info bg-opacity-25 mt-3 mb-5 pb-2 pt-3">
    <div class="container mb-5">
      <table class="table table-striped border border-info border-1 mb-5">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">כותרת</th>
            <th scope="col">תאריך יצירה</th>
            <th scope="col">משתמשים</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>תרגילי בית</td>
            <td>15.10.2022</td>
            <td>איתי אוליבקוביץ', ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>מטלות בית</td>
            <td>02.09.2021</td>
            <td>ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>מחויבויות לחיים</td>
            <td>01.01.2023</td>
            <td>איתי אוליבקוביץ'</td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td>נוכחות במלגה</td>
            <td>15.10.2022</td>
            <td>ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">5</th>
            <td>מועדי מבחנים</td>
            <td>01.11.2022</td>
            <td>איתי אוליבקוביץ', ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">6</th>
            <td>מטלות לעל האש</td>
            <td>03.02.2023</td>
            <td>איתי אוליבקוביץ', ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">7</th>
            <td>מטלות בית</td>
            <td>03.10.2021</td>
            <td>איתי אוליבקוביץ'</td>
          </tr>
          <tr>
            <th scope="row">8</th>
            <td>עבודות כיתה</td>
            <td>28.02.2023</td>
            <td>איתי אוליבקוביץ', ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">9</th>
            <td>ציוד למסע כומתה</td>
            <td>03.03.2022</td>
            <td>איתי אוליבקוביץ', ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">10</th>
            <td>ציוד ליום הולדת של נדב</td>
            <td>03.02.2023</td>
            <td>איתי אוליבקוביץ', ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">11</th>
            <td>חתונה</td>
            <td>24.12.2022</td>
            <td> ליאור פוקין</td>
          </tr>
          <tr>
            <th scope="row">12</th>
            <td>בר מצווה של יניב</td>
            <td>04.04.2023</td>
            <td>איתי אוליבקוביץ', ליאור פוקין</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
  <script>
    const rows = document.querySelectorAll("tr");

    for (let i = 1; i < rows.length; i++) {
      rows[i].classList.add("clickable");
      rows[i].addEventListener("click", function() {
        window.location.href = "list.php";
      });
    }
  </script>
  <script src="add_bootstrap.js"></script>
  <script>
    window.onload = function() {
      createLoggedNavbar();
      createLoggedFooter();
    };
  </script>
</body>

</html>