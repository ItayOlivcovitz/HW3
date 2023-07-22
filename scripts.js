(function ($) {
    $('#email_forgot_password').on('blur', function () {
        console.log("Blur event triggered. Checking email...");
      var emailValue = $(this).val();
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
          }
          // להשלים פה את מה שחסר
        })
      }
    });
  })(jQuery);
  