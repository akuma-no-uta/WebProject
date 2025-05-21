<?php
include 'db.php';

// Lấy dữ liệu giỏ hàng từ cookie nếu có
$cartItems = [];
if (isset($_COOKIE['cart'])) {
    $cartItems = json_decode($_COOKIE['cart'], true);
}

include '../phpFile/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Food Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Londrina Solid', sans-serif;
    }
  </style>
</head>
<body>

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
                    <h6 class="mb-0 text-muted"><?= count($cartItems) ?> items</h6>
                  </div>
                  <hr class="my-4">

                  <?php if (empty($cartItems)): ?>
                    <div class="alert alert-info">
                      Your cart is empty. <a href="menu.php">Go to menu</a> to add items.
                    </div>
                  <?php else: ?>
                    <?php foreach ($cartItems as $item): ?>
                      <div class="row mb-4 d-flex justify-content-between align-items-center">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                          <img src="<?= htmlspecialchars($item['image']) ?>"
                               class="img-fluid rounded-3" alt="<?= htmlspecialchars($item['name']) ?>">
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <h6 class="text-muted">Item</h6>
                          <h6 class="mb-0"><?= htmlspecialchars($item['name']) ?></h6>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                          <button class="btn btn-link px-2"
                                  onclick="updateQuantity(this, '<?= htmlspecialchars($item['name']) ?>', -1)">
                            <i class="fas fa-minus"></i>
                          </button>

                          <input min="1" name="quantity" value="<?= $item['quantity'] ?>" type="number"
                                 class="form-control form-control-sm" id="qty-<?= htmlspecialchars($item['name']) ?>" />

                          <button class="btn btn-link px-2"
                                  onclick="updateQuantity(this, '<?= htmlspecialchars($item['name']) ?>', 1)">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                          <h6 class="mb-0"><?= number_format($item['price'], 0) ?> VND</h6>
                        </div>
                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                          <a href="#!" class="text-muted" onclick="removeItem('<?= htmlspecialchars($item['name']) ?>')">
                            <i class="fas fa-times"></i>
                          </a>
                        </div>
                      </div>
                      <hr class="my-4">
                    <?php endforeach; ?>
                  <?php endif; ?>

                  <div class="pt-5">
                    <h6 class="mb-0">
                      <a href="menu.php" class="text-body">
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
                    <h5 class="text-uppercase">Items <?= count($cartItems) ?></h5>
                    <h5><?= number_format(array_reduce($cartItems, function($carry, $item) {
                        return $carry + ($item['price'] * $item['quantity']);
                    }, 0), 0) ?> VND</h5>
                  </div>

                  <h5 class="text-uppercase mb-3">Shipping</h5>
                  <div class="mb-4 pb-2">
                    <select class="form-select" id="shipping-method">
                      <option value="0" selected>Select shipping method</option>
                      <option value="5000">Standard - 5,000 VND</option>
                      <option value="10000">Fast - 10,000 VND</option>
                      <option value="20000">Priority - 20,000 VND</option>
                    </select>
                  </div>

                  <h5 class="text-uppercase mb-3">Give code</h5>
                  <div class="mb-5">
                    <input type="text" id="promoCode" class="form-control form-control-lg" placeholder="Enter your code" />
                  </div>

                  <div class="d-flex justify-content-between mb-3">
                    <h5 class="text-uppercase">Total</h5>
                    <h5 id="total-amount"><?= number_format(array_reduce($cartItems, function($carry, $item) {
                        return $carry + ($item['price'] * $item['quantity']);
                    }, 0), 0) ?> VND</h5>
                  </div>

                  <button type="button" class="btn btn-dark btn-block btn-lg" onclick="checkout()">Checkout</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
<script>
    function updateQuantity(button, itemName, change) {
        let cart = Cookies.get('cart') ? JSON.parse(Cookies.get('cart')) : [];
        const itemIndex = cart.findIndex(item => item.name === itemName);
        
        if (itemIndex !== -1) {
            const newQuantity = cart[itemIndex].quantity + change;
            
            if (newQuantity < 1) {
                removeItem(itemName);
                return;
            }
            
            cart[itemIndex].quantity = newQuantity;
            Cookies.set('cart', JSON.stringify(cart), { expires: 7 });
            
            // Update the input field
            document.getElementById(`qty-${itemName}`).value = newQuantity;
            
            // Reload to update totals
            location.reload();
        }
    }
    
    function removeItem(itemName) {
        let cart = Cookies.get('cart') ? JSON.parse(Cookies.get('cart')) : [];
        cart = cart.filter(item => item.name !== itemName);
        Cookies.set('cart', JSON.stringify(cart), { expires: 7 });
        location.reload();
    }
    
    function checkout() {
        alert('Checkout functionality will be implemented here');
        // You can redirect to a checkout page or process the order here
    }
    
    // Calculate total with shipping
    document.getElementById('shipping-method').addEventListener('change', function() {
        const shippingCost = parseInt(this.value) || 0;
        const itemsTotal = <?= array_reduce($cartItems, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0) ?>;
        document.getElementById('total-amount').textContent = (itemsTotal + shippingCost).toLocaleString() + ' VND';
    });
</script>
</body>
</html>

<?php 
include '../phpFile/footer.php';
?>