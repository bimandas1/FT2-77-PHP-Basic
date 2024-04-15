// Sign up
$(document).on('submit', '#reset-password-submit-form', function (e) {
  e.preventDefault();
  $.ajax({
    url: 'application/controllers/otp_generate.php',
    data: {
      task: 'reset_password',
      password: $("input[name='password']").val(),
      email: $("input[name='email']").val()
    },
    type: "POST",
    success: function(data) {
      $('.data-input').html(data);
    },
    error: function() {
      alert('An error occured ! Try again.');
    }
  });
});

// OTP submission
$(document).on('click', '#otp-submit-btn', function() {
  $.ajax({
    url: 'application/controllers/validate_otp.php',
    data: {
      otp: $("input[name='otp']").val()
    },
    type: "POST",
    success: function (data) {
      $('.main').html(data);
    }
  });
});

