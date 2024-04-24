// By default hide OTP input form.
$('#otp-input-box').hide();

// Register form submit.
$(document).on('submit', '#form-user-data-for-register', function submitUserData(e) {
  e.preventDefault();
  // Password & reenter-password not matched.
  if ($("input[name='password']").val() !== $("input[name='reenter-password']").val()) {
    showAlertMessage('Re-enetered password not matched');
  }
  // Send data through AJAX.
  else {
    showAlertMessage("Sending OTP to your mail.");

    $.post('/register', $('#form-user-data-for-register').serialize(), function(data) {
      if (data == '1') {
        $('#user-data-input-box').hide();
        $('#otp-input-box').show();
      }
      else {
        showAlertMessage(data);
      }
    });
  }
});

// OTP submit.
$(document).on('submit', '#form-submit-otp', function(e) {
  e.preventDefault();
  $.post('/register', $('#form-submit-otp').serialize(), function(data) {
    $('#user-data-input-box').show();
    $('#otp-input-box').hide();
    showAlertMessage(data);
  })
});
