(function ($) {
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
            window.location = `message.php?email=${emailValue}&key=${response.key}`;
          } else {
            $(".warning").text(response.message);
            $(".warning").removeClass("d-none");
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log("AJAX request failed: " + textStatus, errorThrown);
        }
      });
    }
  }

  $('#password_restore').on('submit', function (e) {
    e.preventDefault();
    console.log("Form submitted. Checking email...");
    checkEmail();
  });

})(jQuery);
