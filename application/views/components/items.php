<?php foreach ($items as $item) : ?>
  <div class="card">
    <div class="card-photo">
      <img src="public/assests/product_images/<?= $item['photo'] ?>" class="card-img-top">
    </div>
    <div class="card-body">
      <h5 class="card-title"> <?= $item['name'] ?> </h5>
      <p class="card-text"> <?= $item['description'] ?> </p>
      <p class="card-text cart-text-price"> Rs. <?= $item['price'] ?> </p>
      <a data-id="<?= $item['id'] ?>" class="btn-add-to-cart btn btn-primary">Add to Cart</a>
    </div>
  </div>
<?php endforeach; ?>
</div
