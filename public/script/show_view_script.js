// Search products
$(document).on('click', '#btn-search', function(e) {
  e.preventDefault();
  let searchKeywords = $('#input-saerch').val();
  if(searchKeywords !== '') {
    $.post('/search-items', {'search-keywords': searchKeywords}, function(data) {
      $('.products').html(data);
    });
  }
});

// Add to cart
$(document).on('click', '.btn-add-to-cart', function(e) {
  e.preventDefault();
  // Fetch product id.
  let productId = $(this).attr('data-id');
  
  $.post('/edit-cart',
    {task: 'update-cart', 'product-id': productId, change: 1},
    function(data) {
      alert(data);
    });
});
