// Sign up
$(document).on('submit', '#signup-submit-form', function(e) {
  e.preventDefault();

  $.ajax({
    url: 'application/controllers/otp_generate.php',
    data: {
      task: 'register',
      email: $("input[name='email']").val(),
      fname: $("input[name='fname']").val(),
      lname: $("input[name='lname']").val(),
      password: $("input[name='password']").val()
    },
    type: "POST",
    success: function(data) {
      $('.data-input').html(data);
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

