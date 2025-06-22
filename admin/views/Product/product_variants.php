<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Quản lý biến thể | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <?php require_once "views/layouts/libs_css.php"; ?>
    <style>
    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }
    
    .table-nowrap td {
        white-space: normal;
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
    
    .back-to-products {
        margin-right: 10px;
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
                                <h4 class="mb-sm-0">Danh sách biến thể: <?= htmlspecialchars($product->name) ?></h4>

                                <div class="d-flex align-items-center gap-md-2">
                                    <a href="index.php?act=Product" class="btn btn-secondary back-to-products">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i> Quay lại
                                    </a>
                                    <!-- <a href="index.php?act=addVariant&product_id=<?= $product->id ?>" class="btn btn-success">
                                        <i class="ri-add-line align-bottom me-1"></i> Thêm biến thể
                                    </a> -->
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
                                            if ($_GET['success'] == 'add') echo "Thêm biến thể thành công!";
                                            if ($_GET['success'] == 'update') echo "Cập nhật biến thể thành công!";
                                            if ($_GET['success'] == 'delete') echo "Xóa biến thể thành công!";
                                        ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (isset($_GET['error'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php
                                            if ($_GET['error'] == 'notfound') echo "Không tìm thấy biến thể.";
                                            if ($_GET['error'] == 'invalidid') echo "ID biến thể không hợp lệ.";
                                            if ($_GET['error'] == 'delete_failed') echo "Xóa biến thể thất bại.";
                                        ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                                            <label class="form-check-label" for="selectAll"></label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Giá</th>
                                                    <th scope="col">Ngày tạo</th>
                                                    <th scope="col">Ngày cập nhật</th>
                                                    <!-- <th scope="col" class="text-end">Actions</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($variants)): ?>
                                                <?php foreach ($variants as $variant): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="selected[]" value="<?= htmlspecialchars($variant->id) ?>">
                                                            <label class="form-check-label"></label>
                                                        </div>
                                                    </td>
                                                    <td><?= htmlspecialchars($variant->id) ?></td>
                                                    <td><?= htmlspecialchars($variant->size) ?></td>
                                                    <td><?= number_format(htmlspecialchars($variant->price), 0, ',', '.') ?> VND</td>
                                                    <td><?= date('d/m/Y H:i', strtotime($variant->created_at)) ?></td>
                                                    <td><?= date('d/m/Y H:i', strtotime($variant->updated_at)) ?></td>
                                                    <td class="text-end">
                                                        <!-- <div class="hstack gap-3 flex-wrap justify-content-end">
                                                            <a href="index.php?act=editVariant&id=<?= htmlspecialchars($variant->id) ?>&product_id=<?= $product->id ?>" class="btn btn-sm btn-warning">
                                                                <i class="ri-pencil-line"></i> Sửa
                                                            </a>
                                                            <a href="index.php?act=deleteVariant&id=<?= htmlspecialchars($variant->id) ?>&product_id=<?= $product->id ?>" 
                                                               class="btn btn-sm btn-danger" 
                                                               onclick="return confirm('Bạn có chắc muốn xóa biến thể này?')">
                                                                <i class="ri-delete-bin-line"></i> Xóa
                                                            </a>
                                                        </div> -->
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">Sản phẩm này chưa có biến thể nào.</td>
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