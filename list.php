<?php
session_start();
$_SESSION['name'];
if (!isset($_COOKIE['Email'])) {
  if (!isset($_SESSION['name'])) {
    header("Location: index.php");
  }
}

require_once("db.php");
require_once("get_task_users.php");
require_once("query_tasks.php");
$userFullName = getUserFullNameByEmail($_SESSION['name']);
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

?>

<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <title>Taskmaster - <?php echo $userFullName; ?>'s list</title>
  <style>
    .custom-autocomplete {
      position: absolute;
      z-index: 9999;
      background-color: white;
      border: 1px solid #ccc;
      max-height: 200px;
      overflow-y: auto;
    }
  </style>

  <script>
    // Function to move row to the bottom of the table
    function moveRowToBottom(row) {
      var table = row.closest('table');
      row.appendTo(table.find('tbody'));
    }

    // Function to move row to the top of the table
    function moveRowToTop(row) {
      var table = row.closest('table');
      row.prependTo(table.find('tbody'));
    }

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
  </script>

  <script>
    jQuery(document).ready(function($) {
      <?php
      // Fetch the listID from GET method
      $listID = $_GET['listID'] ?? 0;

      // Fetch usernames based on listID and userEmail
      $usernames = fetchTaskUsernamesByListID($listID, $_SESSION['name']);
      ?>

      var usernames = <?php echo json_encode($usernames); ?>;
      $("#autocomplete-input-tasks").autocomplete({
        source: usernames,
      }).autocomplete("widget").addClass("custom-autocomplete");
    });
  </script>

  <script>
    $(document).ready(function() {
      <?php
      // Fetch the listID from GET method
      $listID = $_GET['listID'] ?? 0;

      // Fetch usernames based on listID and userEmail
      $usernames = fetchTaskUsernamesByListID($listID, $_SESSION['name']);
      ?>

      var usernames = <?php echo json_encode($usernames); ?>;
      $("#autocomplete-input-tasks").autocomplete({
        source: usernames,
      }).autocomplete("widget").addClass("custom-autocomplete");

      // Add the following script block to handle checkbox and row click events
      $('.table tbody input[type="checkbox"]').on('change', function() {
        var taskID = $(this).closest('tr').data('taskid');
        var isDone = $(this).is(':checked') ? 1 : 0;
        updateTaskStatus(taskID, isDone);
      });

      $('.table tbody tr').on('click', function() {
        var checkbox = $(this).find('input[type="checkbox"]');
        var taskID = $(this).data('taskid');
        var isDone = checkbox.is(':checked') ? 1 : 0;
        updateTaskStatus(taskID, isDone);
      });

      function updateTaskStatus(taskID, isDone) {
        $.ajax({
          type: "POST",
          url: "update_task_status.php",
          data: {
            listID: <?php echo $listID; ?>,
            taskID: taskID,
            done: isDone
          },
          success: function(response) {
            console.log("Task status updated successfully.");
          },
          error: function() {
            alert("An error occurred while updating the task status. Please try again later.");
          }
        });
      }

      // ... Your existing scripts and closing body tag ...
    });
  </script>

</head>

<body class="main-body">
  <h1 class="display-4 text-center text-info-emphasis"><b>הרשימה של <?php echo $userFullName; ?></b></h1>
  <main class="bg-info bg-opacity-25 mt-3 mb-2 pt-3">
    <div class="container">
      <div class="row justify-content-center mb-3">
        <button type="button" class="btn border-2 btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addTask">ליצירת משימה חדשה</button>
      </div>
      <div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
        <div class="modal-dialog" dir="rtl">
          <div class="modal-content" dir="rtl">
            <div dir="rtl" class="modal-header  bg-info bg-opacity-75">
              <div class="row">
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 dir="rtl" class="modal-title text-info-emphasis">יצירת משימה חדשה</h5>
              </div>
            </div>
            <div class="modal-body bg-info bg-opacity-25">
              <form id="create-task-form" action="create_task.php?listID=<?php echo $listID; ?>" method="post">
                <div class="mb-3">
                  <label for="task_description" class="col-form-label text-info-emphasis">שם המשימה:</label>
                  <input type="text" class="form-control" id="task_description" name="task_description" required>
                </div>
                <div class="mb-3">
                  <label for="autocomplete-input-tasks" class="col-form-label text-info-emphasis">משתמש אחראי:</label>
                  <input type="text" id="autocomplete-input-tasks" class="form-control" name="user_responsible">
                </div>
                <div class="mb-3">
                  <label for="null" class="col-form-label text-danger" style="font-weight: bold;">יש לשים לב שאם לא יוגדר משתמש אחראי, המשתמש הנוכחי יוגדר כאחראי.</label>
                </div>
                <input type="hidden" id="task_id" name="task_id">
              </form>
            </div>
            <div class="modal-footer bg-info bg-opacity-50">
              <button id="closeModalButton" type="button" class="btn btn-outline-secondary border-3" style="font-size: 16px; font-weight: bold;" data-bs-dismiss="modal">סגור</button>
              <button id="createTaskButton" type="submit" class="btn btn-outline-primary border-3" style="font-size: 16px; font-weight: bold;" form="create-task-form">צור משימה חדשה</button>
            </div>
          </div>
        </div>
      </div>
      <table id="task-table" class="table table-striped border border-info border-1">
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
            <?php if ($task['done']) : ?>
              <tr class="strikethrough" data-taskid="<?php echo $task['taskID']; ?>">
                <th scope="row"><?php echo $index + 1; ?></th>
                <td><?php echo $task['taskDescription']; ?></td>
                <td><?php echo $task['creationDate']; ?></td>
                <td><?php echo getUserNameByID($task['userID']); ?></td>
                <td><input class="form-check-input task-checkbox" type="checkbox" data-taskid="<?php echo $task['taskID']; ?>" checked></td>
              <?php else : ?>
              <tr data-taskid="<?php echo $task['taskID']; ?>">
                <th scope="row"><?php echo $index + 1; ?></th>
                <td><?php echo $task['taskDescription']; ?></td>
                <td><?php echo $task['creationDate']; ?></td>
                <td><?php echo getUserNameByID($task['userID']); ?></td>
                <td><input class="form-check-input task-checkbox" type="checkbox" data-taskid="<?php echo $task['taskID']; ?>"></td>
              <?php endif; ?>
              <td><button class="btn btn-outline-danger btn-sm border-3" style="font-size: 13px; font-weight: bold;" onclick="confirmDelete(<?php echo $task['taskID']; ?>, <?php echo $listID; ?>)">מחיקה</button></td>
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
      function moveRowToTop(row) {
        var table = row.closest('table');
        row.prependTo(table.find('tbody'));
      }

      // Function to move row to the top of the table
      function moveRowToBottom(row) {
        var table = row.closest('table');
        row.appendTo(table.find('tbody'));
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
  </script>
  <script>
    function deleteTask(taskID, listID) {
      $.ajax({
        type: "POST",
        url: "delete_task.php",
        data: {
          taskID: taskID,
          listID: listID
        },
        success: function(response) {
          // Find the corresponding row using the data-taskid attribute and remove it
          $(`#task-table tr[data-taskid="${taskID}"]`).fadeOut(500, function() {
            $(this).remove(); // Remove the row after fading out
          });
        },
        error: function() {
          alert("An error occurred while trying to delete the task. Please try again later.");
        }
      });
    }
  </script>
  <script>
    function addTaskToList(task, listID) {
      var newRow = $('<tr class="clickable">').attr('data-taskid', task.taskID);
      newRow.append($('<th scope="row">').text(task.taskID)); // Empty row number for now
      newRow.append($('<td>').text(task.taskDescription));
      newRow.append($('<td>').text(task.creationDate));
      newRow.append($('<td>').text(task.userFullName)); // Add the user's full name to the table row
      newRow.append($('<td>').append($('<input class="form-check-input">').attr({
        'type': 'checkbox',
        'checked': task.done
      })));
      newRow.append($('<td>').append($('<button>').addClass('btn btn-outline-danger border-3 btn-sm')
        .css({
          'font-size': '13px',
          'font-weight': 'bold'
        }).text('מחיקה').click(function() {
          confirmDelete(task.taskID, listID);
        })));

      // Append the new row to the table
      $('#task-table tbody').append(newRow);

      // Add event listeners to the new row
      newRow.find('input[type="checkbox"]').on('change', function() {
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

      newRow.on('click', function() {
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
    }
  </script>
  <script>
    function updateList() {
      // Make an AJAX request to fetch the updated list data
      $.ajax({
        type: "GET",
        url: "query_tasks.php",
        data: {
          listID: <?php echo $listID; ?>
        },
        dataType: "json", // Set the expected response data type to JSON
        success: function(tasks) {
          // Clear the existing table rows
          $(".table tbody").empty();

          // Add each task to the list
          tasks.forEach(function(task) {
            addTaskToList(task);
          });
        },
        error: function() {
          alert("Error updating the list.");
        }
      });
    }
  </script>
  <script>
    $(document).ready(function() {
      $('#create-task-form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Serialize the form data
        var formData = $(this).serialize();

        // Make an AJAX request to create the new task
        $.ajax({
          type: "POST",
          url: $(this).attr('action'),
          data: formData,
          dataType: "json", // Set the expected response data type to JSON
          success: function(response) {
            // Clear the form fields
            $("#task_description").val("");
            $("#autocomplete-input-tasks").val("");
            $('#addTask').modal('hide');
            // Add the new task to the list
            addTaskToList(response, <?php echo $listID; ?>); // Pass the listID as an argument
          },
          error: function() {
            alert("An error occurred while creating the task. Please try again later.");
          }
        });
      });
      $('#closeModalButton').click(function() {
        // Clear the form fields
        $("#task_description").val("");
        $("#autocomplete-input-tasks").val("");
      });
    });
  </script>
</body>

</html>