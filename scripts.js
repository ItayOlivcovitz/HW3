(function ($) {
  $('#email_forgot_password').on('blur', function () {
    var emailValue = $(this).val();
    if (emailValue.trim() !== '') {
      $.ajax({
        "url": "queries/check_email_for_restore.php",
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
        }
      })
    }
  });
})(jQuery);
