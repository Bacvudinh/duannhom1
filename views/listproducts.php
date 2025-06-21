    <?php require_once './views/layout/header.php'; ?>

    <style>
        
    </style>
    <!-- Page Banner Section -->
    <div class="page-banner-section section">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Shop Grid Left Sidebar</li>
            </ul>
        </div>
    </div>

    <!-- Product Section -->
    <div class="shop-product-section section section-padding">
        <div class="container">
            <div class="row flex-lg-row-reverse gy-4 align-items-start">

                <!-- Product List Column -->
                <div class="col-lg-9 col-12 mb-4">

                    <!-- Shop Top Bar -->
                    <div class="shop-top-bar d-flex flex-wrap justify-content-between align-items-center mb-4">


                        <div class="shop-top-bar-item">
                            <p>Showing 3 - 12 </p>
                        </div>

                        <div class="shop-top-bar-item">
                            <form id="paginationLimitForm" method="GET" action="index.php">
                                <input type="hidden" name="act" value="listproducts">
                                <input type="hidden" name="keyword" value="<?= htmlspecialchars($keyword ?? '') ?>">
                                <input type="hidden" name="page" value="1">
                                <label for="paginateBy">Hiển thị:</label>
                                <select name="limit" id="paginateBy" onchange="this.form.submit();">
                                    <?php for ($i = 3; $i <= 15; $i += 3): ?>
                                    <option value="<?= $i ?>" <?= ($limit == $i ? 'selected' : '') ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </form>
                        </div>

                        <div class="shop-top-bar-item">
                            <div class="nav list-grid-toggle">
                                <button class="active" data-bs-toggle="tab" data-bs-target="#product-grid"><i
                                        class="sli-grid"></i></button>
                                <button data-bs-toggle="tab" data-bs-target="#product-list"><i
                                        class="sli-menu"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Tab View -->
                    <div id="shopProductTabContent">
                        <!-- Grid View -->
                        <div class="tab-pane fade show active" id="product-grid">
                            <div class="row row-cols-xl-3 row-cols-sm-2 row-cols-1 gy-4">
                                <?php foreach ($products as $product): ?>
                                <div class="col mb-4">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="index.php?act=product_detail&id=<?= $product->id ?>"
                                                class="product-image">
                                                <img src="uploads/product/<?= $product->image ?>"
                                                    alt="<?= $product->name ?>" width="150">
                                            </a>
                                            <div class="product-badge-left"><span class="product-badge-new">new</span>
                                            </div>
                                            <div class="product-badge-right"><span
                                                    class="product-badge-sale">-15%</span>
                                            </div>
                                            <!-- <div class="product-action">
                                                <button class="product-action-btn"><i class="sli-bag"></i></button>
                                            </div> -->
                                        </div>
                                        <div class="product-content">
                                            <h5 class="product-title"><a
                                                    href="index.php?act=product_detail&id=<?= $product->id ?>"><?= htmlspecialchars($product->name) ?></a>
                                            </h5>
                                            <div class="product-price">
                                                <?php if (!empty($product->discount_price)): ?>
                                                <del><?= number_format($product->price, 0, ',', '.') ?>đ</del>
                                                <?= number_format($product->discount_price, 0, ',', '.') ?>đ
                                                <?php else: ?>
                                                <?= number_format($product->price, 0, ',', '.') ?>đ
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- List View -->


                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link"
                                    href="index.php?act=listproducts&page=<?= $page - 1 ?>&limit=<?= $limit ?>&keyword=<?= urlencode($keyword ?? '') ?>"><i
                                        class="sli-arrow-left"></i></a></li>
                            <?php else: ?>
                            <li class="page-item disabled"><span class="page-link"><i class="sli-arrow-left"></i></span>
                            </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link"
                                    href="index.php?act=listproducts&page=<?= $i ?>&limit=<?= $limit ?>&keyword=<?= urlencode($keyword ?? '') ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages): ?>
                            <li class="page-item"><a class="page-link"
                                    href="index.php?act=listproducts&page=<?= $page + 1 ?>&limit=<?= $limit ?>&keyword=<?= urlencode($keyword ?? '') ?>"><i
                                        class="sli-arrow-right"></i></a></li>
                            <?php else: ?>
                            <li class="page-item disabled"><span class="page-link"><i
                                        class="sli-arrow-right"></i></span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>

                <!-- Sidebar Filter -->
                <div class="col-lg-3 col-12 mb-4">
                    <form id="filterForm" method="GET" action="index.php">
                        <input type="hidden" name="act" value="listproducts">
                        <input type="hidden" name="limit" value="<?= $_GET['limit'] ?? 6 ?>">

                        <hr>
                        <label class="fw-bold">Filter by Price</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control mb-2" name="min_price" placeholder="Min"
                                    value="<?= $_GET['min_price'] ?? '' ?>">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control mb-2" name="max_price" placeholder="Max"
                                    value="<?= $_GET['max_price'] ?? '' ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-dark w-100 mb-3">Apply</button>




                        <!-- Lọc theo danh mục (Categories) -->
                        <!-- Categories -->
                        <label class="fw-bold mt-3 mb-2">Categories</label>
                        <div class="mb-3">
                            <?php foreach ($categories as $cat): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]"
                                    value="<?= $cat->id ?>"
                                    <?= (isset($_GET['category']) && in_array($cat->id, $_GET['category'])) ? 'checked' : '' ?>
                                    onchange="document.getElementById('filterForm').submit();">
                                <label class="form-check-label"><?= $cat->name ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Sizes -->
                        <label class="fw-bold mt-3 mb-2">Size</label>
                        <div class="mb-3">
                            <?php foreach ($sizes as $size): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="size[]" value="<?= $size->name ?>"
                                    <?= (isset($_GET['size']) && in_array($size->name, $_GET['size'])) ? 'checked' : '' ?>
                                    onchange="document.getElementById('filterForm').submit();">
                                <label class="form-check-label"><?= $size->name ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>