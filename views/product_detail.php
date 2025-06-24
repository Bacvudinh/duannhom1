  <?php
    require_once './views/layout/header.php'; // Header
    ?>
  <style>
/* General Styling */
  </style>
  <div class="page-banner-section section">
      <div class="container">
          <ul class="breadcrumb">
              <li><a href="index.html">Home</a></li>
              <li>Product Details</li>
          </ul>
      </div>
  </div>
  <!-- Page Banner Section End -->

  <!-- Product Details Section Start -->
  <div class="product-details-section section section-padding">
      <div class="container">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
          <!-- Single Product Top Area Start -->
          <div class="row row-cols-1 row-cols-md-2 g-4">
              <!-- Product Image Start -->
              <div class="col">
                  <div class="single-product-image">

                      <!-- Product Image Slider Start -->
                      <div class="product-image-slider swiper">
                          <!-- Product Badge Start -->
                          <div class="single-product-badge-left">
                              <span class="single-product-badge-new">new</span>
                          </div>

                          <!-- Product Badge End -->
                          <div class="swiper-wrapper">
                              <div class="swiper-slide image-zoom"><img src="uploads/product/<?= $product->image ?>"
                                      alt="Signature Blend Roast 11"></div>
                              <div class="swiper-slide image-zoom"><img src="uploads/product/<?= $product->image ?>"
                                      alt="Signature Blend Roast Coffee"></div>
                              <div class="swiper-slide image-zoom"><img src="uploads/product/<?= $product->image ?>"
                                      alt="Signature Blend Roast Coffee"></div>
                              <div class="swiper-slide image-zoom"><img src="uploads/product/<?= $product->image ?>"
                                      alt="Signature Blend Roast Coffee"></div>
                          </div>
                          <div class="swiper-pagination d-none"></div>
                          <div class="swiper-button-prev d-none"></div>
                          <div class="swiper-button-next d-none"></div>
                      </div>
                      <!-- Product Image Slider End -->

                      <!-- Product Thumbnail Carousel Start -->
                      <div class="product-thumb-carousel swiper">
                          <div class="swiper-wrapper">
                              <div class="swiper-slide"><img src="uploads/product/<?= $product->image ?>"
                                      alt="Signature Blend Roast Coffee"></div>
                              <div class="swiper-slide image-zoom"><img src="uploads/product/<?= $product->image ?>"
                                      alt="Signature Blend Roast Coffee"></div>
                              <div class="swiper-slide image-zoom"><img src="uploads/product/<?= $product->image ?>"
                                      alt="Signature Blend Roast Coffee"></div>
                              <div class="swiper-slide image-zoom"><img src="uploads/product/<?= $product->image ?>"
                                      alt="Signature Blend Roast Coffee"></div>
                          </div>
                          <div class="swiper-pagination d-none"></div>
                          <div class="swiper-button-prev"></div>
                          <div class="swiper-button-next"></div>
                      </div>
                      <!-- Product Thumbnail Carousel End -->

                  </div>
              </div>
              <!-- Product Image End -->

              <!-- Product Content Start -->
              <div class="col mb-6">
                  <div class="single-product-content">
                      <h1 class="single-product-title"><?= htmlspecialchars($product->name) ?></h1>
                      <div class="single-product-price">

                          <span id="dynamic-price"><?= number_format($productVariants[0]->price, 0, ',', '.') ?>
                              VNĐ</span>


                      </div>
                      <script>
                      document.addEventListener("DOMContentLoaded", function() {
                          const sizeRadios = document.querySelectorAll('input[name="size"]');
                          const priceDisplay = document.getElementById('dynamic-price');

                          sizeRadios.forEach(radio => {
                              radio.addEventListener('change', function() {
                                  const newPrice = this.getAttribute('data-price');

                                  priceDisplay.textContent = `${parseFloat(newPrice).toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            })}`;

                              });
                          });
                      });
                      </script>
                      <script>
                      document.addEventListener("DOMContentLoaded", function() {
                          const sizeRadios = document.querySelectorAll('input[name="size"]');
                          const priceDisplay = document.getElementById('dynamic-price');

                          sizeRadios.forEach(radio => {
                              radio.addEventListener('change', function() {
                                  const newPrice = this.getAttribute('data-price');
                                  const formatted = new Intl.NumberFormat('vi-VN').format(
                                      newPrice);
                                  priceDisplay.textContent = `${formatted} VNĐ`;
                              });
                          });
                      });
                      </script>




                      <ul class="single-product-meta">
                          <li><span class="label">Danh mục :</span> <span
                                  class="value"><?= htmlspecialchars($product->category_name) ?></span></li>
                      </ul>
                      <div class="single-product-text">

                          <p><?= htmlspecialchars($product->description) ?></p>
                      </div>

                      <ul class="single-product-variations">
                          <li><span class="label">Size :</span>
                              <div class="value">
                                  <div class="single-product-variation-size-wrap">
                                      <?php foreach ($productVariants as $index => $variant): ?>
                                      <div class="single-product-variation-size-item">
                                          <input type="radio" name="size" id="size-<?= $index ?>"
                                              value="<?= $variant->size ?>" data-price="<?= $variant->price ?>"
                                              <?= $index === 0 ? 'checked' : '' ?>>
                                          <label for="size-<?= $index ?>"><?= strtoupper($variant->size) ?></label>
                                      </div>
                                      <?php endforeach; ?>
                                  </div>
                              </div>
                          </li>
                      </ul>

                      <div class="single-product-additional-information">

                      </div>
                      <?php if (!empty($_SESSION['add_to_cart_error'])): ?>
                      <div class="alert alert-danger mt-3">
                          <?= $_SESSION['add_to_cart_error'] ?>
                      </div>
                      <?php unset($_SESSION['add_to_cart_error']); ?>
                      <?php endif; ?>
                      <!-- Hiển thị thông báo lỗi nếu có -->
                      <?php if (!empty($_SESSION['add_to_cart_error'])): ?>
                      <div class="alert alert-danger mt-3">
                          <?= $_SESSION['add_to_cart_error'] ?>
                      </div>
                      <?php unset($_SESSION['add_to_cart_error']); ?>
                      <?php endif; ?>

                      <!-- ✅ Hiển thị thông báo thành công nếu thêm vào giỏ hàng -->
                      <?php if (!empty($_SESSION['add_to_cart_success'])): ?>
                      <div class="alert alert-success mt-3" id="addToCartSuccess">
                          <?= $_SESSION['add_to_cart_success'] ?>
                      </div>
                      <?php unset($_SESSION['add_to_cart_success']); ?>
                      <?php endif; ?>

                      <!-- ✅ Script tự động ẩn thông báo sau 3 giây -->
                      <script>
                      document.addEventListener("DOMContentLoaded", function() {
                          const alertBox = document.getElementById("addToCartSuccess");
                          if (alertBox) {
                              setTimeout(() => {
                                  alertBox.style.opacity = "0";
                                  setTimeout(() => alertBox.style.display = "none",
                                      300); // ẩn hẳn sau hiệu ứng mờ
                              }, 3000);
                          }
                      });
                      </script>

                      <div class="single-product-actions-item">
                          <?php if (isset($_SESSION['add_to_cart_error'])): ?>
                          <div class="alert alert-danger mt-2">
                              <?= htmlspecialchars($_SESSION['add_to_cart_error']) ?>
                          </div>
                          <?php unset($_SESSION['add_to_cart_error']); ?>
                          <?php endif; ?>

                          <form action="index.php?act=addToCart" method="post"
                              class="d-flex align-items-center gap-3 mt-3">
                              <input type="hidden" name="product_id" value="<?= $product->id ?>">
                              <input type="hidden" name="size" id="selected-size"
                                  value="<?= $productVariants[0]->size ?>">

                              <div class="quantity-wrapper">
                                  <input type="number" name="quantity" value="1" class="form-control form-control-sm"
                                      style="width: 70px; border-radius: 6px;">
                              </div>

                              <button type="submit" class="btn btn-primary d-flex align-items-center gap-2"
                                  style="border-radius: 6px; padding: 10px 20px; font-weight: 500;">
                                  <i class="sli-bag"></i> Thêm vào giỏ hàng
                              </button>
                          </form>
                      </div>

                  </div>
              </div>

              <!-- Product Content End -->

          </div>
          <!-- Single Product Top Area End -->

          <!-- Single Product Bottom (Description) Area Start -->
          <div class="single-product-description-area">
              <div class="nav single-product-description-area-nav">

                  <button class="active" data-bs-toggle="tab" data-bs-target="#product-description">Description</button>
                  <button data-bs-toggle="tab" data-bs-target="#product-comments">Comments</button>


              </div>

          </div>


          <div class="tab-content">
              <!-- Description Start -->
              <div class="tab-pane fade show active" id="product-description">
                  <div class="single-product-description">
                      <p><?= htmlspecialchars($product->description) ?></p>
                  </div>
              </div>
              <!-- Description End -->

              <!-- Comments Start -->
              <div class="tab-pane fade" id="product-comments">

                  <div class="block-title-2">
                      <h4 class="title">Comments (2)</h4>
                  </div>

                  <!-- Comment List Start -->

                  <li>
                      <h3>Bình luận</h3>


                      <!-- Form thêm bình luận mới -->
                      <?php if (isset($_SESSION['user'])): ?>
                      <form action="index.php?act=addComment&product_id=<?= $product->id ?>" method="post" class="mb-4">
                          <div class="mb-3">
                              <textarea name="comment" rows="4" class="form-control"
                                  placeholder="Nhập bình luận của bạn..." required></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                              <i class="fas fa-paper-plane"></i> Gửi bình luận
                          </button>
                      </form>

                      <?php else: ?>
                      <p>Vui lòng <a href="index.php?act=loginForm">đăng nhập</a> để bình luận.</p>
                      <?php endif; ?>

                      <!-- Danh sách bình luận -->
                      <ul>
                          <?php foreach ($comments as $comment): ?>
                          <?php if (!$comment['parent_id']): // chỉ hiển thị comment cha 
                                ?>
                          <li>
                              <strong><?= htmlspecialchars($comment['user_name']) ?></strong>:
                              <?= htmlspecialchars($comment['comment']) ?>
                              <br>
                              <small><?= $comment['created_at'] ?></small>

                              <!-- Nếu là người gửi thì có quyền xóa -->
                              <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] === $comment['user_id']): ?>
                              <form
                                  action="index.php?act=deleteComment&id=<?= $comment['id'] ?>&product_id=<?= $product->id ?>"
                                  method="post" style="display: inline;">
                                  <button type="submit"
                                      class="btn btn-danger btn-sm d-inline-flex align-items-center gap-1"
                                      onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')">
                                      <i class="fas fa-trash-alt"></i> Xóa
                                  </button>
                              </form>

                              <?php endif; ?>

                              <!-- Nút trả lời -->
                              <?php if (isset($_SESSION['user'])): ?>
                              <button type="button"
                                  class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1 mt-2"
                                  onclick="document.getElementById('reply-form-<?= $comment['id'] ?>').style.display='block';">
                                  <i class="fas fa-reply"></i> Trả lời
                              </button>

                              <form id="reply-form-<?= $comment['id'] ?>" style="display:none; margin-top: 10px;"
                                  method="post" action="index.php?act=addComment&product_id=<?= $product->id ?>">
                                  <div class="mb-2">
                                      <textarea name="comment" rows="3" class="form-control"
                                          placeholder="Nhập phản hồi..." required></textarea>
                                  </div>
                                  <input type="hidden" name="parent_id" value="<?= $comment['id'] ?>">
                                  <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center gap-2">
                                      <i class="fas fa-paper-plane"></i> Gửi trả lời
                                  </button>
                              </form>

                              <?php endif; ?>

                              <!-- Danh sách trả lời -->
                              <ul style="margin-left: 20px;">
                                  <?php foreach ($comments as $reply): ?>
                                  <?php if ($reply['parent_id'] == $comment['id']): ?>
                                  <li>
                                      <strong><?= htmlspecialchars($reply['user_name']) ?></strong>:
                                      <?= htmlspecialchars($reply['comment']) ?>
                                      <br>
                                      <small><?= $reply['created_at'] ?></small>

                                      <!-- Nếu là người gửi thì có quyền xóa -->
                                      <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] === $reply['user_id']): ?>
                                      <form
                                          action="index.php?act=deleteComment&id=<?= $reply['id'] ?>&product_id=<?= $product->id ?>"
                                          method="post" style="display: inline;">
                                          <button type="submit"
                                              class="btn btn-danger btn-sm d-inline-flex align-items-center gap-1"
                                              onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')">
                                              <i class="fas fa-trash-alt"></i> Xóa
                                          </button>
                                      </form>
                                      <?php endif; ?>


                                  </li>
                                  <?php endif; ?>
                                  <?php endforeach; ?>
                              </ul>
                          </li>
                          <?php endif; ?>
                          <?php endforeach; ?>
                      </ul>



                      <ul class="comment-list">
                  </li>
                  </ul>
                  <!-- Comment List End -->




                  <!-- Size Chart Start -->

                  <!-- Size Chart End -->

                  <!-- Shipping Policy Start -->

                  <!-- Shipping Policy End -->

              </div>
          </div>
          <!-- Single Product Bottom (Description) Area End -->

      </div>
  </div>
  <!-- Product Details Section End -->

  <!-- Product Section Start -->
  <div class="h1-product-section section section-padding pt-0">
      <div class="container">
          <div class="section-title section-title-center">
              <p class="title">POPULAR ITEM</p>
              <h2 class="sub-title">Related Products</h2>

          </div>


          <div class="product-carousel swiper">

              <div class="swiper-wrapper">


                  <?php foreach ($relatedProducts as $item): ?>
                  <div class="swiper-slide">
                      <div class="product">

                          <div class="product-thumb">
                              <a href="index.php?act=product_detail&id=<?= $item->id ?> class=" product-image">
                                  <img loading="lazy" src="uploads/product/<?= $item->image ?>"
                                      alt="<?= htmlspecialchars($item->name) ?>" width="268" height="306">
                              </a>

                              <!-- Badge right -->
                              <div class="product-badge-right">

                              </div>


                          </div>

                          <div class="product-content">
                              <h5 class="product-title">
                                  <a
                                      href="index.php?action=product-detail&id=<?= $item->id ?>"><?= htmlspecialchars($item->name) ?></a>
                              </h5>
                              <div class="product-price">



                                  <?= number_format($item->price, 0, ',', '.') ?> VNĐ

                              </div>
                              <div class="product-rating">
                                  <span class="product-rating-bg">
                                      <span class="product-rating-active" style="width: 80%;"></span>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <?php endforeach; ?>
              </div>

          </div>

          <div class="swiper-pagination d-md-none"></div>
          <div class="swiper-button-prev d-none d-md-flex"></div>
          <div class="swiper-button-next d-none d-md-flex"></div>
      </div>

  </div>

  </div>
  <!-- Product Section End -->

  <!-- Product Section Start -->

  <!-- Product Section End -->
  </div>
  <script>
document.addEventListener("DOMContentLoaded", function() {
    const radios = document.querySelectorAll('input[name="size"]');
    const hiddenSize = document.getElementById('selected-size');

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            hiddenSize.value = this.value;
        });
    });
});
  </script>