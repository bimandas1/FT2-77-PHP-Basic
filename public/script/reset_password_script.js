// Hide by default.
$('#div-otp-input').hide();
$('#div-new-password-input').hide();

// Submmit user email.
$(document).on('submit', '#form-email-input', function(e) {
  e.preventDefault();
  showAlertMessage("An OTP is being sent to your email.");
  $.post('/reset-password', $('#form-email-input').serialize(), function(data) {
    if(data === '1') {
      $('#div-email-input').hide();
      $('#div-otp-input').show();
    }
    else {
      showAlertMessage(data);
    }
  });
});

// Submit OTP.
$(document).on('submit', '#form-otp-input', function(e) {
  e.preventDefault();
  $.post('/reset-password', $('#form-otp-input').serialize(), function(data) {
    if(data === '1') {
      $('#div-otp-input').hide();
      $('#div-new-password-input').show();
    }
    else {
      $('#div-email-input').show();
      $('#div-otp-input').hide();
      showAlertMessage(data);
    }
  });
});

// Submit new password.
$(document).on('submit', '#form-new-password-input', function(e) {
  e.preventDefault();

  // New password and Reenter new password are not same.
  if($("input[name='new-password']").val() !== $("input[name='reenter-new-password']").val()) {
    showAlertMessage("New password and Reenter new password are not same");
  }
  else {
    $.post('/reset-password', $('#form-new-password-input').serialize(), function(data) {
      $('#div-email-input').show();
      $('#div-new-password-input').hide();
      showAlertMessage(data);
    });
  }
});
