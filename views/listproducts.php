<!-- Page Banner Section Start -->
<?php
require_once './views/layout/header.php'; // Header
?>

<div class="page-banner-section section">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li>Shop Grid Left Sidebar</li>
        </ul>
    </div>
</div>
<!-- Page Banner Section End -->

<!-- Product Section Start -->
<div class="shop-product-section section section-padding">
    <div class="container">
        <div class="row flex-lg-row-reverse gy-4">

            <div class="col-lg-9 col-12 mb-8">

                <!-- Shop Top Bar Start -->
                <div class="shop-top-bar">

                    <div class="shop-top-bar-item">
                        <label for="SortBy">Sort by :</label>
                        <select name="SortBy" id="SortBy">
                            <option value="manual">Featured</option>
                            <option value="best-selling">Best Selling</option>
                            <option value="title-ascending">Alphabetically, A-Z</option>
                            <option value="title-descending">Alphabetically, Z-A</option>
                            <option value="price-ascending">Price, low to high</option>
                            <option value="price-descending">Price, high to low</option>
                            <option value="created-descending">Date, new to old</option>
                            <option value="created-ascending">Date, old to new</option>
                        </select>
                    </div>

                    <div class="shop-top-bar-item">
                        <p>Showing 1 - 12 of 25 result</p>
                    </div>

                    <div class="shop-top-bar-item">
                        <form id="paginationLimitForm" method="GET" action="index.php">
                            <input type="hidden" name="act" value="listproducts">
                            <input type="hidden" name="keyword" value="<?= htmlspecialchars($keyword ?? '') ?>">
                            <input type="hidden" name="page" value="1"> <!-- reset về trang 1 mỗi khi thay limit -->

                            <label for="paginateBy">Hiển thị:</label>
                            <select name="limit" id="paginateBy" onchange="document.getElementById('paginationLimitForm').submit();">
                                <?php for ($i = 3; $i <= 20; $i++): ?>
                                    <option value="<?= $i ?>" <?= ($limit == $i ? 'selected' : '') ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </form>

                    </div>

                    <div class="shop-top-bar-item">
                        <div class="nav list-grid-toggle">
                            <button class="active" data-bs-toggle="tab" data-bs-target="#product-grid"><i class="sli-grid"></i></button>
                            <button data-bs-toggle="tab" data-bs-target="#product-list"><i class="sli-menu"></i></button>
                        </div>
                    </div>

                </div>
                <!-- Shop Top Bar End -->

                <!-- Product Tab Start -->
                <div class="tab-content" id="shopProductTabContent">
                    <div class="tab-pane fade show active" id="product-grid">
                        <div class="row row-cols-xl-3 row-cols-sm-2 row-cols-1 gy-4">
                            <?php foreach ($products as $product): ?>
                                <div class="col mb-6">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="index.php?act=product_detail&id=<?= $product->id ?>" class="product-image">
                                                <img src="uploads/product/<?= $product->image ?>" alt="<?= $product->name ?>" width="150">

                                            </a>

                                            <div class="product-badge-left">
                                                <span class="product-badge-new">new</span>
                                            </div>

                                            <div class="product-badge-right">
                                                <span class="product-badge-sale">sale</span>
                                                <span class="product-badge-sale">-15%</span>
                                            </div>

                                            <div class="product-action">
                                                <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                                <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                                <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                                <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                            </div>

                                            <div class="product-variation">
                                                <div class="product-variation-type">
                                                    <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                                    <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                                    <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h5 class="product-title"><a href="product-details.html"><?= htmlspecialchars($product->name) ?></a></h5>
                                            <div class="product-price">
                                                <?php if (!empty($product->discount_price)): ?>
                                                    <del><?= number_format($product->price, 0, ',', '.') ?>đ</del>
                                                    <?= number_format($product->discount_price, 0, ',', '.') ?>đ
                                                <?php else: ?>
                                                    <?= number_format($product->price, 0, ',', '.') ?>đ
                                                <?php endif; ?>
                                            </div>
                                            <div class="product-rating">
                                                <span class="product-rating-bg"><span class="product-rating-active" style="width: 50%;"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-list">
                        <div class="row row-cols-md-1 row-cols-sm-2 row-cols-1 gy-4">

                            <div class="col mb-6">
                                <?php foreach ($products as $product): ?>
                                    <?php echo 'uploads/product/' . $product->image; ?>
                                    <div class="product product-list">
                                        <div class="product-thumb">
                                            <a href="index.php?act=product_detail&id=<?= $product->id ?>" class="product-image">
                                                <img loading="lazy" src="uploads/<?= htmlspecialchars($product->image) ?>" alt="<?= htmlspecialchars($product->name) ?>" width="268" height="306">
                                            </a>

                                            <?php if (!empty($product->is_new)): ?>
                                                <div class="product-badge-left">
                                                    <span class="product-badge-new">new</span>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($product->discount_percent)): ?>
                                                <div class="product-badge-right">
                                                    <span class="product-badge-sale">sale</span>
                                                    <span class="product-badge-sale">-<?= $product->discount_percent ?>%</span>
                                                </div>
                                            <?php endif; ?>

                                            <div class="product-action">
                                                <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                            </div>

                                            <div class="product-variation">
                                                <div class="product-variation-type">
                                                    <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                                    <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                                    <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-content">
                                            <h5 class="product-title">
                                                <a href="index.php?act=product_detail&id=<?= $product->id ?>">
                                                    <?= htmlspecialchars($product->name) ?>
                                                </a>
                                            </h5>

                                            <p class="product-excerpt"><?= htmlspecialchars($product->description ?? '') ?></p>

                                            <div class="product-price">
                                                <?php if (!empty($product->discount_price)): ?>
                                                    <del><?= number_format($product->price, 0, ',', '.') ?>đ</del>
                                                    <?= number_format($product->discount_price, 0, ',', '.') ?>đ
                                                <?php else: ?>
                                                    <?= number_format($product->price, 0, ',', '.') ?>đ
                                                <?php endif; ?>
                                            </div>

                                            <div class="product-rating">
                                                <span class="product-rating-bg">
                                                    <span class="product-rating-active" style="width: <?= isset($product->rating) ? $product->rating * 20 : 80 ?>%;"></span>
                                                </span>
                                            </div>

                                            <div class="product-action position-static">
                                                <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                                <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                                <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Product Tab End -->

                <!-- Shop Bottom Bar Start -->
                <nav aria-label=" Page navigation">
                    <ul class="pagination justify-content-center">

                        <!-- Nút Prev -->
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?act=listproducts&page=<?= $page - 1 ?>&limit=<?= $limit ?>&keyword=<?= urlencode($keyword ?? '') ?>">
                                    <i class="sli-arrow-left"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link"><i class="sli-arrow-left"></i></span>
                            </li>
                        <?php endif; ?>

                        <!-- Các số trang -->
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="index.php?act=listproducts&page=<?= $i ?>&limit=<?= $limit ?>&keyword=<?= urlencode($keyword ?? '') ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <!-- Nút Next -->
                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?act=listproducts&page=<?= $page + 1 ?>&limit=<?= $limit ?>&keyword=<?= urlencode($keyword ?? '') ?>">
                                    <i class="sli-arrow-right"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link"><i class="sli-arrow-right"></i></span>
                            </li>
                        <?php endif; ?>

                    </ul>
                </nav>

                <!-- Shop Bottom Bar End -->

            </div>

            <div class="col-lg-3 col-12 mb-8">
                <div class="accordion" id="accordionSidebar">

                    <!-- Sidebar Price Start -->
                    <hr>
                    <label class="fw-bold">Filter by Price</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="number" class="form-control mb-2" name="min_price" placeholder="Min" value="<?= $_GET['min_price'] ?? '' ?>">
                        </div>
                        <div class="col-6">
                            <input type="number" class="form-control mb-2" name="max_price" placeholder="Max" value="<?= $_GET['max_price'] ?? '' ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-dark w-100">Apply</button>
                    </form>

                    <!-- Sidebar Price End -->

                    <!-- Sidebar Availability Start -->
                    <div class="accordion-item shop-sidebar-item">
                        <button class="shop-sidebar-toggle accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sidebarAvailability">Availability</button>
                        <div id="sidebarAvailability" class="accordion-collapse collapse">
                            <div class="shop-sidebar-body accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="stock" id="in-stock">
                                    <label class="form-check-label" for="in-stock">In stock <span class="ms-auto">(23)</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="stock" id="out-of-stock" checked>
                                    <label class="form-check-label" for="out-of-stock">Out of stock <span class="ms-auto">(12)</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Availability End -->

                    <!-- Sidebar Filter by Category -->
                    <div class="accordion-item shop-sidebar-item">
                        <button class="shop-sidebar-toggle accordion-button" data-bs-toggle="collapse" data-bs-target="#sidebarCategory">Category</button>
                        <div id="sidebarCategory" class="accordion-collapse collapse show">
                            <div class="shop-sidebar-body accordion-body">
                                <form id="filterForm" method="GET" action="index.php">
                                    <input type="hidden" name="act" value="listproducts">
                                    <input type="hidden" name="min_price" value="<?= $_GET['min_price'] ?? '' ?>">
                                    <input type="hidden" name="max_price" value="<?= $_GET['max_price'] ?? '' ?>">
                                    <input type="hidden" name="limit" value="<?= $_GET['limit'] ?? 5 ?>">

                                    <?php foreach ($categories as $cat): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="category[]" value="<?= $cat->id ?>"
                                                <?= (isset($_GET['category']) && in_array($cat->id, $_GET['category'])) ? 'checked' : '' ?>
                                                onchange="document.getElementById('filterForm').submit();">
                                            <label class="form-check-label"><?= $cat->name ?></label>
                                        </div>
                                    <?php endforeach; ?>

                                </form>

                                <!-- Sidebar Size Start -->
                                <div class="accordion-item shop-sidebar-item">
                                    <button class="shop-sidebar-toggle accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sidebarSize">Size</button>
                                    <div id="sidebarSize" class="accordion-collapse collapse">
                                        <div class="shop-sidebar-body accordion-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" name="size" id="s">
                                                <label class="form-check-label" for="s">S <span class="ms-auto">(8)</span></label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" name="size" id="m">
                                                <label class="form-check-label" for="m">M <span class="ms-auto">(11)</span></label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" name="size" id="l">
                                                <label class="form-check-label" for="l">L <span class="ms-auto">(11)</span></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Sidebar Size End -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Product Section End -->