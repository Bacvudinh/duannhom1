<!-- Page Banner Section Start -->
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
                        <label for="paginateBy">Show :</label>
                        <select name="paginateBy" id="paginateBy">
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12" selected>12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>


                        </select>
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
                                                <img loading="lazy" src="assets/images/products/product-1.png" alt="<?= htmlspecialchars($product->name) ?>" width="268" height="306">
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
                                                <span class="product-rating-bg"><span class="product-rating-active" style="width: 90%;"></span></span>
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
                <div class="shop-bottom-bar">
                    <ul class="pagination">
                        <li class="disabled"><a href="#prev"><i class="sli-arrow-left"></i></a></li>
                        <li><a class="active" href="#page=1">1</a></li>
                        <li><a href="#page=2">2</a></li>
                        <li><a href="#page=3">3</a></li>
                        <li><a href="#next"><i class="sli-arrow-right"></i></a></li>
                    </ul>
                </div>
                <!-- Shop Bottom Bar End -->

            </div>

            <div class="col-lg-3 col-12 mb-8">
                <div class="accordion" id="accordionSidebar">

                    <!-- Sidebar Price Start -->
                    <div class="accordion-item shop-sidebar-item">
                        <button class="shop-sidebar-toggle accordion-button" data-bs-toggle="collapse" data-bs-target="#sidebarPrice">Price</button>
                        <div id="sidebarPrice" class="accordion-collapse collapse show">
                            <div class="shop-sidebar-body accordion-body">
                                <input type="text" id="price-range" />
                            </div>
                        </div>
                    </div>
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

                    <!-- Sidebar Product Type Start -->
                    <div class="accordion-item shop-sidebar-item">
                        <button class="shop-sidebar-toggle accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sidebarProductType">Product Type</button>
                        <div id="sidebarProductType" class="accordion-collapse collapse">
                            <div class="shop-sidebar-body accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="type" id="type-1">
                                    <label class="form-check-label" for="type-1">Type 1 <span class="ms-auto">(2)</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="type" id="type-2">
                                    <label class="form-check-label" for="type-2">Type 2 <span class="ms-auto">(3)</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="type" id="type-3">
                                    <label class="form-check-label" for="type-3">Type 3 <span class="ms-auto">(2)</span></label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Product Type End -->

                    <!-- Sidebar Brand Start -->
                    <div class="accordion-item shop-sidebar-item">
                        <button class="shop-sidebar-toggle accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sidebarBrand">Brand</button>
                        <div id="sidebarBrand" class="accordion-collapse collapse">
                            <div class="shop-sidebar-body accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="vendor" id="vendor-1">
                                    <label class="form-check-label" for="vendor-1">Vendor 1 <span class="ms-auto">(2)</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="vendor" id="vendor-2">
                                    <label class="form-check-label" for="vendor-2">Vendor 2 <span class="ms-auto">(3)</span></label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Brand End -->

                    <!-- Sidebar Color Start -->
                    <div class="accordion-item shop-sidebar-item">
                        <button class="shop-sidebar-toggle accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sidebarColor">Color</button>
                        <div id="sidebarColor" class="accordion-collapse collapse">
                            <div class="shop-sidebar-body accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="color" id="black">
                                    <label class="form-check-label" for="black">Black <span class="ms-auto">(4)</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="color" id="blue">
                                    <label class="form-check-label" for="blue">Blue <span class="ms-auto">(7)</span></label>
                                </div>




                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Color End -->

                    <!-- Sidebar Material Start -->
                    <div class="accordion-item shop-sidebar-item">
                        <button class="shop-sidebar-toggle accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sidebarMaterial">Material</button>
                        <div id="sidebarMaterial" class="accordion-collapse collapse">
                            <div class="shop-sidebar-body accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="material" id="fiber">
                                    <label class="form-check-label" for="fiber">Fiber <span class="ms-auto">(2)</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="material" id="leather">
                                    <label class="form-check-label" for="leather">Leather <span class="ms-auto">(2)</span></label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Material End -->

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