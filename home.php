<?php
session_start();
if (!isset($_COOKIE['Email'])) {
  if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit;
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
        <tbody id="list-table-body">
        </tbody>
      </table>
    </div>
    <div class="container mb-4">
      <div class="row justify-content-center">
        <button type="button" class="btn border-2 btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">ליצירת רשימה חדשה</button>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
      <div class="modal-dialog" dir="rtl">
        <div class="modal-content" dir="rtl">
          <div dir="rtl" class="modal-header bg-info bg-opacity-75">
            <div class="row">
              <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
              <h5 dir="rtl" class="modal-title text-info-emphasis">יצירת רשימה חדשה</h5>
            </div>
          </div>
          <div class="modal-body bg-info bg-opacity-25">
            <form id="create-list-form" action="create_list.php" method="post">
              <div class="mb-3">
                <label for="list_description" class="col-form-label text-info-emphasis">שם הרשימה:</label>
                <input type="text" class="form-control" id="list_description">
              </div>
              <div class="mb-3">
                <label for="autocomplete-input" class="col-form-label text-info-emphasis">משתמשים שותפים:</label>
                <input type="text" id="autocomplete-input" class="form-control">
                <input type="hidden" id="selected-users" name="selected-users">
              </div>
              <div id="selected-users-container" class="text-info-emphasis"> משתמשים שנבחרו: </div>
              <ul id="autocomplete-dropdown" class="ui-autocomplete "></ul>
            </form>
          </div>
          <div class="modal-footer bg-info bg-opacity-50">
            <button id="closeListModalButton" type="button" class="btn btn-outline-secondary border-3" style="font-size: 16px; font-weight: bold;" data-bs-dismiss="modal">סגור</button>
            <button type="submit" class="btn btn-outline-primary border-3" style="font-size: 16px; font-weight: bold;" form="create-list-form">צור רשימה חדשה</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    $(function() {
      <?php
      require_once("get_users.php");
      $usernames = fetchUsernames();
      $user_email = $_SESSION['name'];
      if (!in_array($user_email, $usernames)) {
        $usernames[] = $user_email;
      }
      ?>

      function fetchCurrentUserEmailInfo() {
        $.ajax({
          type: "GET",
          url: "get_user_info.php",
          data: {
            email: "<?php echo $user_email; ?>"
          },
          dataType: "json",
          success: function(response) {
            selectedUsersArray = [];
            if (response.user_info) {
              selectedUsersArray.push(response.user_info);
            }
            $("#selected-users").val(JSON.stringify(selectedUsersArray));
            displaySelectedUsers(selectedUsersArray);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }
      $('#closeListModalButton').click(function() {
        $("#list_description").val("");
        $("#autocomplete-input").val("");
        selectedUsersArray = [];
        $("#selected-users-container").html("משתמשים שנבחרו:");
        $("#selected-users").val("");
        fetchCurrentUserEmailInfo();
      });

      function fetchLists() {
        $.ajax({
          type: "GET",
          url: "fetch_lists.php",
          dataType: "json",
          success: function(response) {
            populateTable(response);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }

      function populateTable(lists) {
        var tableBody = $("#list-table-body");
        tableBody.empty();
        for (var i = 0; i < lists.length; i++) {
          var list = lists[i];
          var listID = i + 1;
          var row = `
              <tr class="clickable" data-listid="${list.listID}">
                <th scope="row">${listID}</th>
                <td>${list.listName}</td>
                <td>${list.creationDate}</td>
                <td>${list.users}</td>
              </tr>
                    `;
          tableBody.append(row);
        }
        tableBody.on("click", ".clickable", function() {
          var listID = $(this).data("listid");
          window.location.href = "list.php?listID=" + listID;
        });
      }
      fetchLists();
      var selectedUsersArray = [];

      function displaySelectedUsers(users) {
        var container = $("#selected-users-container");
        container.html("משתמשים שנבחרו: <br>" + users.join("<br>"));
      }
      fetchCurrentUserEmailInfo();
      $("#autocomplete-input").autocomplete({
        source: <?php echo json_encode($usernames); ?>,
        appendTo: "#autocomplete-dropdown",
        select: function(event, ui) {
          event.preventDefault();
          var selectedUser = ui.item.value;
          if (selectedUsersArray.indexOf(selectedUser) === -1) {
            selectedUsersArray.push(selectedUser);
            $("#selected-users").val(JSON.stringify(selectedUsersArray));
            $(this).val("");
            displaySelectedUsers(selectedUsersArray);
          } else {
            alert("לא ניתן לבחור באותו משתמש יותר מפעם אחת!");
          }
        }
      });
      $("#create-list-form").submit(function(event) {
        event.preventDefault();
        var listDescription = $("#list_description").val();
        var selectedUsers = $("#selected-users").val();
        $.ajax({
          type: "POST",
          url: "create_list.php",
          data: {
            list_description: listDescription,
            selected_users: selectedUsers
          },
          success: function(response) {
            console.log(response);
            $("#list_description").val("");
            $("#selected-users").val("");
            $("#selected-users-container").html("משתמשים שנבחרו:");
            $("#exampleModal").modal("hide");
            var responseData = JSON.parse(response);
            var listID = responseData.listID;
            console.log("list id is :" + listID);
            if (listID) {
              window.location.href = "list.php?listID=" + listID;
            } else {
              console.error("Error: Unable to get the list ID from the response.");
              console.error(response.listID);
            }
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      });

    });
  </script>
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
  <script>
    document.getElementById("new_list").addEventListener("click", function() {
      var myModal = new bootstrap.Modal(document.getElementById("myModal"));
      myModal.show();
    });
  </script>
</body>

</html>