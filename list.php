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
  <link rel="stylesheet" href="style.css">
  <title>Taskmaster - example list</title>
</head>

<body class="main-body">
  <h1 class="display-4 text-center text-info-emphasis"><b>רשימה לדוגמא</b></h1>
  <main class="bg-info bg-opacity-25 mt-3 mb-2 pt-3">
    <div class="container">
      <table class="table table-striped border border-info border-1">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">כותרת</th>
            <th scope="col">תאריך הוספה</th>
            <th scope="col">משתמש אחראי</th>
            <th scope="col">בוצע</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>תרגיל בית 1 פיתוח מערכות מבוססות web</td>
            <td>30.04.2023</td>
            <td>ליאור פוקין</td>
            <td><input class="form-check-input " type="checkbox" id="gridCheck10"></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>תרגיל בית 1 ניתוח מערכות מידע</td>
            <td>28.03.2023</td>
            <td>ליאור פוקין</td>
            <td><input class="form-check-input " type="checkbox" id="gridCheck11"></td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>תרגיל בית 2 ניתוח מערכות מידע</td>
            <td>07.05.2023</td>
            <td>איתי אוליבקוביץ'</td>
            <td><input class="form-check-input " type="checkbox" id="gridCheck12"></td>

          </tr>
          <tr>
            <th scope="row">4</th>
            <td> תרגיל בית 1 OOP</td>
            <td>15.10.2022</td>
            <td>ליאור פוקין</td>
            <td><input class="form-check-input " type="checkbox" id="gridCheck13"></td>
          </tr>
          <tr>
            <th scope="row">5</th>
            <td>תרגיל בית 2 OOP </td>
            <td>01.11.2022</td>
            <td>איתי אוליבקוביץ'</td>
            <td><input class="form-check-input " type="checkbox" id="gridCheck14"></td>
          </tr>
          <tr>
        </tbody>
      </table>
      <div class="row justify-content-center">
        <button id="signup" type="submit" class=" col-12 btn border-2 btn-outline-dark mt-2 mb-5 pe-1 ps-1" onclick="window.location.href='home.php'">חזרה לעמוד הבית</button>
      </div>
    </div>
  </main>
  <script>
    const rows = document.querySelectorAll("tr");

    for (let i = 1; i < rows.length; i++) {
      rows[i].classList.add("clickable");
      rows[i].addEventListener("click", toggleCheckbox);
    }

    function toggleCheckbox() {
      const checkbox = this.querySelector('input[type="checkbox"]');
      checkbox.checked = !checkbox.checked;
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('.table tbody input[type="checkbox"]').on('change', function() {
        var tableRow = $(this).closest('tr');

        if ($(this).is(':checked')) {
          tableRow.addClass('strikethrough');
          moveRowToBottom(tableRow);
          updateRowNumbers();
        } else {
          tableRow.removeClass('strikethrough');
          moveRowToTop(tableRow);
          updateRowNumbers();
        }
      });

      $('.table tbody tr').on('click', function() {
        var checkbox = $(this).find('input[type="checkbox"]');
        var isStrikethrough = $(this).hasClass('strikethrough');

        checkbox.prop('checked', !isStrikethrough);
        $(this).toggleClass('strikethrough', !isStrikethrough);

        if (isStrikethrough) {
          moveRowToTop($(this));
          updateRowNumbers();
        } else {
          moveRowToBottom($(this));
          updateRowNumbers();
        }
      });

      // Check if row has 'strikethrough' class and update the checkbox accordingly
      $('.table tbody tr').each(function() {
        var checkbox = $(this).find('input[type="checkbox"]');
        var isStrikethrough = $(this).hasClass('strikethrough');
        checkbox.prop('checked', isStrikethrough);

        if (isStrikethrough) {
          moveRowToBottom($(this));
        }
      });

      // Function to move row to the bottom of the table
      function moveRowToBottom(row) {
        row.detach().appendTo($('.table tbody'));
      }

      // Function to move row to the top of the table
      function moveRowToTop(row) {
        row.detach().prependTo($('.table tbody'));
      }

      // Function to update row numbers
      function updateRowNumbers() {
        var rowCount = 1;
        $('.table tbody tr').each(function(index) {
          if (!$(this).hasClass('strikethrough')) {
            $(this).find('th').text(rowCount);
            rowCount++;
          } else {
            $(this).find('th').text('');
          }
        });
      }
    });
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