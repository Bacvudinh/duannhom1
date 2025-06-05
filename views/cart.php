<?php require_once './views/layout/header.php'; ?>

<div class="page-banner-section section">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li>Shopping Cart</li>
    </ul>
  </div>
</div>

<?php if (!empty($_SESSION['error'])): ?>
  <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="cart-section section section-padding">
  <div class="container">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>

    <?php if (!empty($cartItems)): ?>
      <form action="index.php?act=updateCart" method="post">
        <div class="table-responsive">
          <table class="table cart-table">
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
              <?php $total = 0; ?>
              <?php foreach ($cartItems as $item): ?>
                <?php $subtotal = $item->price * $item->quantity; ?>
                <?php $total += $subtotal; ?>
                <tr>
                  <td><?= htmlspecialchars($item->name) ?></td>
                  <td><img src="uploads/product/<?= htmlspecialchars($item->image) ?>" alt="<?= htmlspecialchars($item->name) ?>" style="width:200px;height:200px;"></td>
                  <td><?= number_format($item->price, 2) ?> VNĐ</td>
                  <td>
                    <input type="number"
                      class="form-control form-control-sm quantity-input"
                      name="quantities[<?= $item->id ?>]"
                      style="width: 80px;"
                      min="1"
                      value="<?= $item->quantity ?>">
                  </td>
                  <td><?= number_format($subtotal, 2) ?> VNĐ</td>
                  <td>
                    <a href="index.php?act=removeFromCart&item_id=<?= $item->id ?>" class="btn btn-danger btn-sm">X</a>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                <td colspan="2"><strong><?= number_format($total, 2) ?> VNĐ</strong></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
          <div>
            <a href="index.php" class="btn btn-secondary">Tiếp tục mua sắm</a>
          </div>
          <div>
            <button type="submit" class="btn btn-primary">Cập nhật giỏ hàng</button>
          </div>
        </div>
      </form>
      <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#checkoutModal">
        Tiến hành thanh toán
      </button>
    <?php else: ?>
      <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
      <a href="index.php" class="btn btn-primary">Quay lại cửa hàng</a>
    <?php endif; ?>
  </div>
</div>

<!-- Modal chọn địa chỉ -->
<?php $user = $_SESSION['user'] ?? null; ?>
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="index.php?act=checkout" method="post" onsubmit="return validateCheckoutForm()">
        <div class="modal-header">
          <h5 class="modal-title" id="checkoutModalLabel">Thông tin người nhận hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" class="form-control" id="email" name="email"
              value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Họ và tên *</label>
            <input type="text" class="form-control" id="name" name="name"
              value="<?= htmlspecialchars($user['NAME'] ?? '') ?>" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại *</label>
            <input type="tel" class="form-control" id="phone" name="phone"
              value="<?= htmlspecialchars($user['phone'] ?? '') ?>" pattern="[0-9]{9,12}" required>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ nhận hàng *</label>
            <textarea class="form-control" id="address" name="address" rows="2" required><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
          </div>

          <div class="mb-3">
            <label for="note" class="form-label">Ghi chú (không bắt buộc)</label>
            <textarea class="form-control" id="note" name="note" rows="2"
              placeholder="Ví dụ: Giao ngoài giờ hành chính, gọi trước khi đến..."></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="confirm_checkout" class="btn btn-primary">Xác nhận và thanh toán</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function validateCheckoutForm() {
    const phone = document.getElementById('phone').value;
    const regex = /^\d{9,12}$/;
    if (!regex.test(phone)) {
      alert("Số điện thoại phải từ 9 đến 12 chữ số.");
      return false;
    }
    return true;
  }
</script>