/**
 * Unset the values of input areas on page reload
 * so that userId or Password doesn't present
 * after switching the current page.
 */

function unsetInputValue() {
  var inputId = document.getElementById('id');
  var inputPassword = document.getElementById('password');

  inputId.value = "";
  inputPassword.value = "";

}

window.onload = unsetInputValue;
