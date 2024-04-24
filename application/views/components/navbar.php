<!-- Bootstrap navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/feeds"> SHOPEX </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active m-2" aria-current="page" href="/profile"> <?= $this->userData['fname'] ?> </a>
        </li>
        <li class="nav-item">
          <!-- <a class="nav-link" href="#">Link</a> -->
          <a class="nav-link" href="<?= $this->userData['is_admin'] ? 'add-new-product' : 'cart' ?>">
            <img class="cart_icon" src="/public//assests//images//<?= $this->userData['is_admin'] ? 'add-new-product_icon.png' : 'cart_icon.jpg' ?>" alt="cart_icon" style="width:45px">
          </a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input id="input-saerch" name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <!-- <button id="btn-clear-search" type="button" class="btn-close m-2" aria-label="Close"></button> -->
        <button id="btn-search" class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <a href="/login" type="button" class="btn btn-outline-danger m-2"> Log Out</a>
    </div>
  </div>
</nav>
