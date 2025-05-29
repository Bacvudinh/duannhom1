<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Chỉnh sửa sản phẩm | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/layouts/libs_css.php"; ?>
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
                                <h4 class="mb-sm-0">Chỉnh sửa sản phẩm</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php?act=Product">Sản phẩm</a></li> <li class="breadcrumb-item active">Chỉnh sửa</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    // Hiển thị lỗi từ controller (nếu có)
                                    // Kiểm tra isset($error) và !empty($error)
                                    if (isset($error) && !empty($error)): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul class="mb-0">
                                                <?php foreach ($error as $msg): ?>
                                                    <li><?= htmlspecialchars($msg) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (isset($product)): // Đảm bảo $product tồn tại trước khi hiển thị form ?>
                                        <form action="index.php?act=updateProduct&id=<?= htmlspecialchars($product->id) ?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="current_image" value="<?= htmlspecialchars($product->image ?? '') ?>">

                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="productName" name="name" placeholder="Nhập tên sản phẩm"
                                                    value="<?= htmlspecialchars($_POST['name'] ?? $product->name ?? '') ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="productPrice" class="form-label">Giá sản phẩm <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="productPrice" name="price" placeholder="Nhập giá sản phẩm" min="0" step="0.01"
                                                    value="<?= htmlspecialchars($_POST['price'] ?? $product->price ?? '') ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="productCategory" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                                <select class="form-select" id="productCategory" name="category_id" required>
                                                    <option value="">-- Chọn danh mục --</option>
                                                    <?php if (!empty($listCategories)): ?>
                                                        <?php foreach ($listCategories as $category): ?>
                                                            <option value="<?= htmlspecialchars($category->id) ?>"
                                                                <?php
                                                                // Logic để chọn danh mục: ưu tiên $_POST['category_id'] nếu có lỗi,
                                                                // ngược lại dùng category_id từ $product.
                                                                // Sử dụng '?? null' để tránh lỗi khi các biến này không tồn tại
                                                                $selected_category_id = $_POST['category_id'] ?? ($product->category_id ?? null);
                                                                echo ($selected_category_id == $category->id) ? 'selected' : '';
                                                                ?>>
                                                                <?= htmlspecialchars($category->name) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="productDescription" class="form-label">Mô tả sản phẩm</label>
                                                <textarea class="form-control" id="productDescription" name="description" rows="5" placeholder="Nhập mô tả sản phẩm"><?= htmlspecialchars($_POST['description'] ?? $product->description ?? '') ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="productImage" class="form-label">Ảnh sản phẩm</label>
                                                <?php if (!empty($product->image)): // Kiểm tra !empty($product->image) ?>
                                                    <div class="mb-2">
                                                        <img src="../uploads/product/<?= htmlspecialchars($product->image) ?>" alt="Ảnh hiện tại" style="max-width: 150px; height: auto; border-radius: 4px;">

                                                        <small class="d-block text-muted">Ảnh hiện tại</small>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="mb-2 text-muted">Chưa có ảnh.</div>
                                                <?php endif; ?>
                                                <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
                                                <small class="text-muted">Chọn ảnh mới để thay thế ảnh hiện tại (nếu có).</small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productStatus" class="form-label">Trạng thái</label>
                                                <select class="form-select" id="productStatus" name="status">
                                                    <option value="1" <?= (isset($_POST['status']) && $_POST['status'] == 1) || (!isset($_POST['status']) && $product->status == 1) ? 'selected' : '' ?>>Hiển thị</option>
                                                    <option value="0" <?= (isset($_POST['status']) && $_POST['status'] == 0) || (!isset($_POST['status']) && $product->status == 0) ? 'selected' : '' ?>>Ẩn</option>
                                                </select>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                                                <a href="index.php?act=Product" class="btn btn-secondary">Hủy</a>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <div class="alert alert-warning">Không tìm thấy sản phẩm để chỉnh sửa. Vui lòng kiểm tra lại ID sản phẩm.</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
    
    <?php require_once "views/layouts/libs_js.php"; ?>
</body>

</html>