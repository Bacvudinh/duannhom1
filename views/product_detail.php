  <?php
    require_once './views/layout/header.php'; // Header
    ?>
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
          <div class="row row-cols-md-2 row-cols-1 mb-n6">
              <!-- Product Image Start -->
              <div class="col mb-6">
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
                                      alt="Signature Blend Roast Coffee"></div>
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
                       <span id="dynamic-price"><?= number_format($productVariants[0]->price) ?> VND</span>
                      </div>
                      <script>
document.addEventListener("DOMContentLoaded", function () {
    const sizeRadios = document.querySelectorAll('input[name="size"]');
    const priceDisplay = document.getElementById('dynamic-price');

    sizeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            const newPrice = this.getAttribute('data-price');
            const formatted = new Intl.NumberFormat('vi-VN').format(newPrice);
            priceDisplay.textContent = `${formatted} VNĐ`;
        });
    });
});


</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const   Radios = document.querySelectorAll('input[name="size"]');
    const priceDisplay = document.getElementById('dynamic-price');

    sizeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            const newPrice = this.getAttribute('data-price');
            const formatted = new Intl.NumberFormat('vi-VN').format(newPrice);
            priceDisplay.textContent = `${formatted} VND`;
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

                      <div class="single-product-actions">
                          <div class="single-product-actions-item">
                            <form action="index.php?act=addToCart" method="post" class="d-flex align-items-center gap-3 mt-3">
    <input type="hidden" name="product_id" value="<?= $product->id ?>">
    
    <!-- ✅ THÊM hidden field để lưu giá trị size được chọn -->
    <input type="hidden" name="size" id="selected-size" value="<?= $productVariants[0]->size ?>">

    <div class="quantity-wrapper">
        <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" style="width: 70px; border-radius: 6px;">
    </div>

    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2" style="border-radius: 6px; padding: 10px 20px; font-weight: 500;">
        <i class="sli-bag"></i> Thêm vào giỏ hàng
    </button>
</form>

                              <button class="wishlist-btn" onclick="toggleWishlist(this)">
                                  <i class="fa-regular fa-heart"></i>
                              </button>
                              <script>
                              function toggleWishlist(btn) {
                                  const icon = btn.querySelector('i');
                                  icon.classList.toggle('fa-regular');
                                  icon.classList.toggle('fa-solid');
                              }
                              </script>
                          </div>
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
                  <button data-bs-toggle="tab" data-bs-target="#product-reviews">Reviews</button>
                  <button data-bs-toggle="tab" data-bs-target="#product-size-chart">Size Chart</button>
                  <button data-bs-toggle="tab" data-bs-target="#product-shipping-policy">Shipping Policy</button>
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
                          <form action="index.php?act=addComment&product_id=<?= $product->id ?>" method="post">
                              <textarea name="comment" required></textarea>
                              <button type="submit">Gửi bình luận</button>
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
                                      method="post" style="display:inline;">
                                      <button type="submit"
                                          onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')">Xóa</button>
                                  </form>
                                  <?php endif; ?>

                                  <!-- Nút trả lời -->
                                  <?php if (isset($_SESSION['user'])): ?>
                                  <a href="#"
                                      onclick="document.getElementById('reply-form-<?= $comment['id'] ?>').style.display='block'; return false;">REPLY</a>
                                  <form id="reply-form-<?= $comment['id'] ?>" style="display:none; margin-top: 5px;"
                                      action="index.php?act=addComment&product_id=<?= $product->id ?>" method="post">
                                      <textarea name="comment" required></textarea>
                                      <input type="hidden" name="parent_id" value="<?= $comment['id'] ?>">
                                      <button type="submit">Gửi trả lời</button>
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
                                              method="post" style="display:inline;">
                                              <button type="submit"
                                                  onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')">Xóa</button>
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


                      <!-- Reviews Start -->
                      <div class="tab-pane fade" id="product-reviews">

                          <div class="block-title-2">
                              <h4 class="title">Customer Reviews</h4>

                          </div>

                          <!-- Review List Start -->
                          <div class="review-list">
                              <div class="review-item">
                                  <div class="review-thumb"><img src="assets/images/testimonial/testimonial-1.png"
                                          alt="Edna Watson"></div>
                                  <div class="review-content">
                                      <div class="review-rating">
                                          <span class="review-rating-bg"><span class="review-rating-active"
                                                  style="width: 90%"></span></span>
                                      </div>
                                      <div class="review-meta">
                                          <h5 class="review-name">Edna Watson</h5>
                                          <span class="review-date">November 27, 2023</span>
                                      </div>
                                      <p>Thanks for always keeping your WordPress themes up to date. Your level of
                                          support and dedication is second to none.</p>
                                  </div>
                              </div>
                              <div class="review-item">
                                  <div class="review-thumb"><img src="assets/images/testimonial/testimonial-2.png"
                                          alt="Hester Perkins"></div>
                                  <div class="review-content">
                                      <div class="review-rating">
                                          <span class="review-rating-bg"><span class="review-rating-active"
                                                  style="width: 100%"></span></span>
                                      </div>
                                      <div class="review-meta">
                                          <h5 class="review-name">Hester Perkins</h5>
                                          <span class="review-date">November 27, 2023</span>
                                      </div>
                                      <p>Thanks for always keeping your WordPress themes up to date. Your level of
                                          support and dedication is second to none.</p>
                                  </div>
                              </div>
                          </div>
                          <!-- Review List End -->

                          <div class="block-title-2">
                              <h4 class="title">Write a review</h4>

                          </div>

                          <!-- Review Form Start -->
                          <div class="review-form">
                              <form action="#">
                                  <div class="row g-4">
                                      <div class="col-12">
                                          <label for="review-rating">Rating</label>
                                          <select class="form-field" name="rating" id="review-rating">
                                              <option value="1">One</option>
                                              <option value="2">Two</option>
                                              <option value="3">Three</option>
                                              <option value="4">Four</option>
                                              <option value="5">Five</option>
                                          </select>
                                      </div>
                                      <div class="col-sm-6">
                                          <label for="review-name">Name</label>
                                          <input class="form-field" id="review-name" name="name" type="text"
                                              placeholder="Enter your name">
                                      </div>
                                      <div class="col-sm-6">
                                          <label for="review-email">Email</label>
                                          <input class="form-field" id="review-email" name="email" type="email"
                                              placeholder="john.smith@example.com">
                                      </div>
                                      <div class="col-12">
                                          <label for="review-comment">Body of Review (1500)</label>
                                          <textarea class="form-field" id="review-comment" name="comment"
                                              placeholder="Write your comments here"></textarea>
                                      </div>
                                      <div class="col-12">
                                          <input type="submit" class="btn btn-dark btn-primary-hover rounded-0"
                                              value="Submit Review">
                                      </div>
                                  </div>
                              </form>
                          </div>
                          <!-- Review Form End -->

                      </div>
                      <!-- Reviews End -->

                      <!-- Size Chart Start -->
                      <div class="tab-pane fade" id="product-size-chart">
                          <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                      <td class="cun-name"><span>UK</span></td>
                                      <td>18</td>
                                      <td>20</td>
                                      <td>22</td>
                                      <td>24</td>
                                      <td>26</td>
                                  </tr>
                                  <tr>
                                      <td class="cun-name"><span>European</span></td>
                                      <td>46</td>
                                      <td>48</td>
                                      <td>50</td>
                                      <td>52</td>
                                      <td>54</td>
                                  </tr>
                                  <tr>
                                      <td class="cun-name"><span>usa</span></td>
                                      <td>14</td>
                                      <td>16</td>
                                      <td>18</td>
                                      <td>20</td>
                                      <td>22</td>
                                  </tr>
                                  <tr>
                                      <td class="cun-name"><span>Australia</span></td>
                                      <td>28</td>
                                      <td>10</td>
                                      <td>12</td>
                                      <td>14</td>
                                      <td>16</td>
                                  </tr>
                                  <tr>
                                      <td class="cun-name"><span>Canada</span></td>
                                      <td>24</td>
                                      <td>18</td>
                                      <td>14</td>
                                      <td>42</td>
                                      <td>36</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      <!-- Size Chart End -->

                      <!-- Shipping Policy Start -->
                      <div class="tab-pane fade" id="product-shipping-policy">
                          <div class="block-title-2">
                              <h4 class="title">Shipping policy of our store</h4>

                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                              tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                              quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
                              consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate</p>
                          <ul>
                              <li>1-2 business days (Typically by end of day)</li>
                              <li>30 days money back guaranty</li>
                              <li>24/7 live support</li>
                              <li>odio dignissim qui blandit praesent</li>
                              <li>luptatum zzril delenit augue duis dolore</li>
                              <li>te feugait nulla facilisi.</li>
                          </ul>
                          <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod
                              mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis
                              in iis qui facit eorum</p>
                          <p>claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.
                              Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.
                              Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit
                              litterarum formas humanitatis per</p>
                          <p>seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                              clari, fiant sollemnes in futurum.</p>
                      </div>
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

                                  <div class="product-action">
                                      <button class="product-action-btn" data-tooltip-text="Quick View"
                                          data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i
                                              class="sli-magnifier"></i></button>
                                      <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i
                                              class="sli-heart"></i></button>
                                      <button class="product-action-btn" data-tooltip-text="Compare"><i
                                              class="sli-refresh"></i></button>
                                      <button class="product-action-btn" data-tooltip-text="Add to cart"><i
                                              class="sli-bag"></i></button>
                                  </div>

                                  <!-- Variations giữ nguyên -->
                                  <div class="product-variation">
                                      <div class="product-variation-type">
                                          <button class="product-variation-type-btn"><img loading="lazy"
                                                  src="assets/images/products/variation/type/type-1.jpg" alt="white"
                                                  width="23" height="23"></button>
                                          <button class="product-variation-type-btn"><img loading="lazy"
                                                  src="assets/images/products/variation/type/type-2.jpg" alt="gold"
                                                  width="23" height="23"></button>
                                          <button class="product-variation-type-btn"><img loading="lazy"
                                                  src="assets/images/products/variation/type/type-3.jpg" alt="black"
                                                  width="23" height="23"></button>
                                      </div>
                                  </div>
                              </div>

                              <div class="product-content">
                                  <h5 class="product-title">
                                      <a
                                          href="index.php?action=product-detail&id=<?= $item->id ?>"><?= htmlspecialchars($item->name) ?></a>
                                  </h5>
                                  <div class="product-price">





                                      <?= number_format($item->price) ?>

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
document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[name="size"]');
    const hiddenSize = document.getElementById('selected-size');

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            hiddenSize.value = this.value;
        });
    });
});
</script>
