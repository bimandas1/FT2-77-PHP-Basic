<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- jQuerry CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    table,
    th,
    td {
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- Require Navbar -->
  <?php require_once __DIR__ . '/components/navbar.php'; ?>

  <!-- Show cart details -->
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Photo</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col"> Add/Remove </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cartDetails as $item) : ?>
        <tr>
          <td> <?= $item['name'] ?> </td>
          <td> <img src="/public//assests//product_images//<?= $item['photo'] ?>" alt="item_photo" style="width: 100px"> </td>
          <td> <?= $item['price'] ?> </td>
          <td class="item-quantity"> <?= $item['quantity'] ?> </td>
          <td>
            <button data-id="<?= $item['id'] ?>" type="button" class="btn btn-primary update-cart"> + </button>
            <button data-id="<?= $item['id'] ?>" type="button" class="btn btn-danger update-cart remove-from-cart"> - </button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Total price -->
  <table class="table table-striped table-bordered table-success">
    <thead>
      <tr>
        <th scope="col"> Total : </th>
        <th scope="col"> Rs. <span class="total-amount"> <?= $totalAmount ?> </span> </th>
        <th scope="col">
          <button id="btn-buy" type="button" class="btn btn-success"> BUY </button>
        </th>
      </tr>
    </thead>
  </table>

</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- jQuerry -->
<script src="/public//script//cart_view_script.js"></script>

</html>
