<?php
session_start();
$_SESSION['name'];
if (!isset($_COOKIE['Email'])) {
  if (!isset($_SESSION['name'])) {
    header("Location: index.php");
  }
}

require_once("db.php");

function getUserNameByID($userID)
{
  global $conn;
  $sql = "SELECT CONCAT(`First Name`, ' ', `Last Name`) AS full_name FROM `users` WHERE `Id` = $userID";
  $result = $conn->query($sql);

  if (!$result || $result->num_rows === 0) {
    return "Unknown User";
  }

  $row = $result->fetch_assoc();
  return $row['full_name'];
}
include("query_tasks.php");
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
      <div class="row justify-content-center mb-3">
        <button type="button" class="btn border-2 btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addTask">ליצירת משימה חדשה</button>
      </div>
      <div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
        <div class="modal-dialog" dir="rtl">
          <div class="modal-content" dir="rtl">
            <div dir="rtl" class="modal-header">
              <div class="row">
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 dir="rtl" class="modal-title ">יצירת משימה חדשה</h5>
              </div>
            </div>
            <div class="modal-body">
              <form id="create-task-form" action="create_task.php" method="post">
                <div class="mb-3">
                  <label for="task_description" class="col-form-label">שם המשימה:</label>
                  <input type="text" class="form-control" id="task_description">
                </div>
                <div class="mb-3">
                  <label for="autocomplete-input" class="col-form-label">משתמש אחראי:</label>
                  <input type="text" id="autocomplete-input-tasks" class="form-control">
                  <input type="hidden" id="selected-users-tasks" name="selected-users">
                </div>
                <div id="selected-users-container-tasks"> משתמשים שנבחרו: </div>
                <ul id="autocomplete-dropdown-tasks" class="ui-autocomplete"></ul>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">סגור</button>
              <button type="submit" class="btn btn-primary" form="create-list-form">צור משימה חדשה</button>
            </div>
          </div>
        </div>
      </div>
      <table class="table table-striped border border-info border-1">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">כותרת</th>
            <th scope="col">תאריך הוספה</th>
            <th scope="col">משתמש אחראי</th>
            <th scope="col">בוצע</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tasks as $index => $task) : ?>
            <tr>
              <th scope="row"><?php echo $index + 1; ?></th>
              <td><?php echo $task['taskDescription']; ?></td>
              <td><?php echo $task['creationDate']; ?></td>
              <td><?php echo getUserNameByID($task['userID']); ?></td>
              <td><input class="form-check-input" type="checkbox" <?php echo $task['done'] ? 'checked' : ''; ?>></td>
              <td><button class="btn btn-outline-danger border-3 btn-sm" style="font-size: 13px; font-weight: bold;" onclick="confirmDelete(<?php echo $task['taskID']; ?>, <?php echo $listID; ?>)">מחיקה</button></td>
            </tr>
          <?php endforeach; ?>
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
  <script>
    function confirmDelete(taskID, listID) {
      const confirmed = confirm(".האם ברצונך למחוק את המשימה הזו? לאחר מחיקתה לא ניתן יהיה להחזירה");
      if (confirmed) {
        deleteTask(taskID, listID);
      }
    }

    function updateList() {
      // Make an AJAX request to fetch the updated list data
      $.ajax({
        type: "GET",
        url: "query_tasks.php",
        data: {
          listID: <?php echo $listID; ?>
        },
        dataType: "html",
        success: function(response) {
          // Replace the table body with the updated list data
          $(".table tbody").html(response);
        },
        error: function() {
          alert("Error updating the list.");
        }
      });
    }

    function deleteTask(taskID, listID) {
      $.ajax({
        type: "POST",
        url: "delete_task.php",
        data: {
          taskID: taskID,
          listID: listID
        },
        success: function(response) {
          updateList();
        },
        error: function() {
          alert("אירעה שגיאה בעת הניסיון למחוק את המשימה, נא לנסות שוב בעוד מספר דקות.");
        }
      });
    }
  </script>
</body>

</html>