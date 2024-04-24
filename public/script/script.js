// Show alert message.
function showAlertMessage(msg) {
  $('#alert-by-js').css({ 'display': 'block' });
  setTimeout(function () {
    $('#alert-by-js').css({ 'display': 'none' });
  }, 5000);
  $('#alert-message').text(msg);
}
