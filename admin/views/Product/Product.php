<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Quản lý sản phẩm | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <?php require_once "views/layouts/libs_css.php"; ?>
    <style>
    .product-image {
        width: 80px;
        /* Adjust as needed */
        height: 80px;
        /* Adjust as needed */
        object-fit: cover;
        border-radius: 4px;
    }

    .table-nowrap td {
        white-space: normal;
        /* Allow text to wrap within cells if needed */
    }
    .variant-count-link {
    text-decoration: none;
    color: inherit;
}

.variant-count-link:hover .badge {
    background-color: #0b5ed7 !important;
    transform: scale(1.05);
}

.badge {
    font-size: 0.9em;
    padding: 5px 8px;
    border-radius: 10px;
    transition: all 0.2s ease;
}
    </style>
</head>

<body>

    <div id="layout-wrapper">
        <?php require_once "views/layouts/siderbar.php"; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Danh sách sản phẩm</h4>

                                <div class="d-flex align-items-center gap-md-2">
                                    <form action="index.php" method="get" class="d-flex align-items-center">
                                        <input type="hidden" name="act" value="Product">
                                        <div class="search-box me-2">
                                            <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm..."
                                                name="keyword" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i
                                                class="ri-search-line"></i></button>
                                    </form>
                                    <a href="index.php?act=addProduct" class="btn btn-success"><i
                                            class="ri-add-line align-bottom me-1"></i> Thêm mới</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (isset($_GET['success'])): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php
                                                if ($_GET['success'] == 'add') echo "Thêm sản phẩm thành công!";
                                                if ($_GET['success'] == 'update') echo "Cập nhật sản phẩm thành công!";
                                                if ($_GET['success'] == 'delete') echo "Xóa sản phẩm thành công!";
                                            ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (isset($_GET['error'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php
                                                if ($_GET['error'] == 'notfound') echo "Không tìm thấy sản phẩm.";
                                                if ($_GET['error'] == 'invalidid') echo "ID sản phẩm không hợp lệ.";
                                                if ($_GET['error'] == 'delete_failed') echo "Xóa sản phẩm thất bại.";
                                                if ($_GET['error'] == 'product_not_found') echo "Sản phẩm không tồn tại.";
                                                if ($_GET['error'] == 'invalid_product_id') echo "ID sản phẩm không hợp lệ.";
                                            ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="selectAll">
                                                            <label class="form-check-label" for="selectAll"></label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Biến thể</th>

                                                    <th scope="col" class="text-end">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($listProducts)): ?>
                                                <?php foreach ($listProducts as $product): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="selected[]"
                                                                value="<?= htmlspecialchars($product->id) ?>">
                                                            <label class="form-check-label"></label>
                                                        </div>
                                                    </td>
                                                    <td><?= htmlspecialchars($product->id) ?></td>
                                                    <td>
                                                        <?php if ($product->image): ?>
                                                        <img src="../uploads/product/<?= htmlspecialchars($product->image) ?>"
                                                            alt="<?= htmlspecialchars($product->name) ?>"
                                                            class="product-image">
                                                        <?php else: ?>
                                                        No Image
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($product->name) ?></td>
                                                    <td><?= number_format(htmlspecialchars($product->price), 0, ',', '.') ?>
                                                        VND</td>
                                                    <td><?= htmlspecialchars($product->category_name ?? 'N/A') ?></td>
                                                    <td><?= htmlspecialchars(substr($product->description, 0, 100)) . (strlen($product->description) > 100 ? '...' : '') ?>
                                                    </td>
                                                    <td>
                                                        <?php if($product->status == 1): ?>
                                                        <span class="badge bg-success">Hiển thị</span>
                                                        <?php else: ?>
                                                        <span class="badge bg-danger">Ẩn</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($product->variant_count > 0): ?>
                                                        <a href="index.php?act=productVariants&id=<?= $product->id ?>"
                                                            class="variant-count-link" title="Xem chi tiết biến thể">
                                                            <span
                                                                class="badge bg-primary"><?= $product->variant_count ?></span>
                                                        </a>
                                                        <?php else: ?>
                                                        <span class="badge bg-secondary">0</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="hstack gap-3 flex-wrap justify-content-end">
                                                            <a href="index.php?act=editProduct&id=<?= htmlspecialchars($product->id) ?>"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="ri-pencil-line"></i> Sửa</a>

                                                        </div>
                                                    </td>

                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
    // Select all checkboxes
    document.getElementById('selectAll').onclick = function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    };
    </script>
</body>

</html>