// Update cart.
$(document).on('click', '.update-cart', function (e) {
  e.preventDefault();
  let currentBtn = $(this);
  // Fetch product id from data-id.
  let productId = $(currentBtn).attr('data-id');
  // If remove item button clicked then change = -1 else +1.
  let change = $(currentBtn).hasClass('remove-from-cart') ? -1 : 1;

  $.post(
    '/edit-cart',
    {task: 'update-cart', 'product-id': productId, change: change},
    function (data) {
      data = JSON.parse(data);
      // Select the quantity cell and modify its value.
      $(currentBtn).parent().parent().find('.item-quantity').text(data['updated_quantity']);
      // Select the total amount cell span and modify its value.
      $('.total-amount').html(data['total_amount']);
    });
});

// Buy items
$(document).on('click', '#btn-buy', function(e) {
  e.preventDefault();
  
  $.post('/buy', function(data) {
    alert(data)
  })
})
