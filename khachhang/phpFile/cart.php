<?php
include 'db.php';

$items = [];
$sql = "SELECT * FROM products";
$result = $conn->   query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}
include '../phpFile/header.php';

?>

<!DOCTYPE html>
<html lang="en" >
<head>:
  <meta charset="UTF-8">
  <title>Food Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Link đến Bootstrap, Font Awesome, MDB, hoặc các CDN khác -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css"/>
</head>
<body style="font-family:Londrina Solid, sans-serif;">

<section class="h-100 h-custom" style="margin-top: 90px;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px; background-color: #fbf6dc;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0">Food Cart</h1>
                    <h6 class="mb-0 text-muted">3 items</h6>
                  </div>
                  <hr class="my-4">

                  <!-- Repeat for each product -->
                  <?php
                    // Danh sách sản phẩm mẫu
                    $items = [
                      ["image" => "img6.webp", "name" => "Cotton T-shirt", "price" => 44.00],
                      ["image" => "img7.webp", "name" => "Cotton T-shirt", "price" => 44.00],
                    ];

                    foreach ($items as $item): 
                  ?>
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/<?= $item['image'] ?>"
                           class="img-fluid rounded-3" alt="<?= $item['name'] ?>">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <h6 class="text-muted">name</h6>
                      <h6 class="mb-0"><?= $item['name'] ?></h6>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2"
                              onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                        <i class="fas fa-minus"></i>
                      </button>

                      <input min="0" name="quantity" value="1" type="number"
                             class="form-control form-control-sm" />

                      <button class="btn btn-link px-2"
                              onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0">€ <?= number_format($item['price'], 2) ?></h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                    </div>
                  </div>
                  <hr class="my-4">
                  <?php endforeach; ?>

                  <div class="pt-5">
                    <h6 class="mb-0">
                      <a href="#!" class="text-body">
                        <i class="fas fa-long-arrow-alt-left me-2"></i>Back to menu
                      </a>
                    </h6>
                  </div>
                </div>
              </div>

              <!-- Summary Section -->
              <div class="col-lg-4 bg-body-warning">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Items <?= count($items) ?></h5>
                    <h5>€ <?= number_format(array_sum(array_column($items, 'price')), 2) ?></h5>
                  </div>

                  <h5 class="text-uppercase mb-3">Shipping</h5>
                  <div class="mb-4 pb-2">
                    <select class="form-select">
                      <option selected>Open this select menu</option>
                      <option value="1">Standard - €5.00</option>
                      <option value="2">Fast - €10.00</option>
                      <option value="3">Priority - €20.00</option>
                    </select>
                  </div>

                  <h5 class="text-uppercase mb-3">Give code</h5>
                  <div class="mb-5">
                    <input type="text" id="promoCode" class="form-control form-control-lg" placeholder="Enter your code" />
                  </div>

                  <button type="button" class="btn btn-dark btn-block btn-lg">Register</button>

                </div>
              </div>
              <!-- End summary -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- JS scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>
</html>
<?php 
include '../phpFile/footer.php';
?>
