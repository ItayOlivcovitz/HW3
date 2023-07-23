(function ($) {
  // Function to check email
  function checkEmail() {
    var emailValue = $('#email_forgot_password').val();
    if (emailValue.trim() !== '') {
      $.ajax({
        "url": "check_email_for_restore.php",
        "type": "get",
        "dataType": "json",
        "data": { email: emailValue },
        success: function (response) {
          console.log(response);
          console.log(response.message);
          if (response.success) {
            //  alert("Email found");
            window.location = `message.php?email=${emailValue}&key=${response.key}`;
          } else {
            // alert(response.message);
            $(".warning").text(response.message);
            $(".warning").removeClass("d-none");
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log("AJAX request failed: " + textStatus, errorThrown);
          // Optionally, you can show an error message to the user here if needed
        }
      });
    }
  }

  // Bind the form's submit event to trigger the email check
  $('#password_restore').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission behavior
    console.log("Form submitted. Checking email...");
    checkEmail(); // Trigger the email check function
  });

})(jQuery);
