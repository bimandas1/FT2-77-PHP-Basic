$('#searched-posts').hide();

// Add Post.
$(document).on('click', '#add-post-btn', addPost);

// Load more posts.
$(document).on('click', '#load-more-btn', loadPosts);

// Search post
$(document).on('keyup', '#search-post', searchPosts);

function addPost() {
  let fd = new FormData();
  // Append input text.
  let text = $("#post-text-input").val();
  fd.append('text', text);
  // Append input media file.
  mediaFile = $("#post-media-input")[0].files[0];
  fd.append('media', mediaFile);

  if(text === '' && mediaFile === undefined) {
    showAlertMessage('Atleast one field (text or media) mut be filled to add a post');
  }
  else {
    $.ajax({
      url: 'application/controllers/add_post.php',
      type: 'POST',
      data: fd,
      contentType: false,
      processData: false,
      success: function(data) {
        if(data == '1') {
          showAlertMessage('Post uploaded successfully.');
        }
      else {
        showAlertMessage("Your post didn't uploaded ! Try again.");
      }
      }
    });
  }
}

function loadPosts() {
  // Get the id of the last post.
  let lastPostId = $('.feed-block:last').attr('id') || 1000000;

  $.ajax({
    url: 'application/controllers/fetch_posts.php',
    type: 'POST',
    data: {
      last_post_id: lastPostId
    },
    success: function(data) {
      if(data == '0') {
        showAlertMessage('No more post is available');
      }
      else {
        $('#feeds-posts').append(data);
      }
    }
  });
}

function searchPosts() {
  let searchKeys = $('#search-post').val();
  if(searchKeys === '') {
    $('#searched-posts').hide();
    $('#feeds-posts').show();
    $('#load-more-btn').show();
  }
  else {
    $('#feeds-posts').hide();
    $('#load-more-btn').hide();
    $('#searched-posts').show();

    $.ajax({
      url: 'application/controllers/fetch_searched_posts.php',
      type: 'POST',
      data: {
        'search-keys': searchKeys
      },
      success: function(data) {
        if(data == '0') {
          $('#searched-posts').html("<p style='text-align:center; color:Red; font-size: 26px; font-weight:600;'> No mtached post </p>");
        }
        else {
          $('#searched-posts').html(data);
        }
      },
      error: function() {
        showAlertMessage("Error !")
      }
    });
  }
}

// Alert message in UI
function showAlertMessage(msg) {
  $('.alert-box').css({'display': 'block'});
  $('#alert-message').text(msg);
  setTimeout(function() {
    $('.alert-box').css({ 'display': 'none' });
  }, 7000);
}
