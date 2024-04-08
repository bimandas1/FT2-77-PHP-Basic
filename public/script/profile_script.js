// Update User data
$(document).on('click', '#update-user-info', function() {
  $.ajax({
    url: 'application/controllers/update_user_data.php',
    type: 'POST',
    data: {
      task: 'update user info',
      fname: $("input[name='fname']").val(),
      lname: $("input[name='lname']").val(),
    },
    success: function(data) {
      alert(data);
    },
    error: function() {
      alert("Error !");
    }
  });
});


// Update user password
$(document).on('click', '#update-user-password', function () {
  current_password = $("input[name='current-password']").val();
  new_password = $("input[name='new-password']").val();
  reenter_new_password = $("input[name='reenter-new-password']").val();

  if(new_password !== reenter_new_password) {
    alert("Conform passsword doesn't match");
  }
  else {
    $.ajax({
      url: 'application/controllers/update_user_data.php',
      type: 'POST',
      data: {
        task: 'update user password',
        'current-password': current_password,
        'new-password': new_password,
      },
      success: function (data) {
        alert(data);
      },
      error: function () {
        alert("Error !");
      }
    });
  }
});
