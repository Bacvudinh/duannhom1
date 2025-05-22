<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Thêm sản phẩm mới | NN Shop</title>
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
                                <h4 class="mb-sm-0">Thêm sản phẩm mới</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                                        <li class="breadcrumb-item active">Thêm mới</li>
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

                                    <form action="index.php?act=saveProduct" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="productName" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="productName" name="name" placeholder="Nhập tên sản phẩm" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productPrice" class="form-label">Giá sản phẩm <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="productPrice" name="price" placeholder="Nhập giá sản phẩm" min="0" step="0.01" value="<?= htmlspecialchars($_POST['price'] ?? '') ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productCategory" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                            <select class="form-select" id="productCategory" name="category_id" required>
                                                <option value="">-- Chọn danh mục --</option>
                                                <?php if (!empty($listCategories)): ?>
                                                    <?php foreach ($listCategories as $category): ?>
                                                        <option value="<?= htmlspecialchars($category->id) ?>" <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category->id) ? 'selected' : '' ?>>
                                                            <?= htmlspecialchars($category->name) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productDescription" class="form-label">Mô tả sản phẩm</label>
                                            <textarea class="form-control" id="productDescription" name="description" rows="5" placeholder="Nhập mô tả sản phẩm"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productImage" class="form-label">Ảnh sản phẩm</label>
                                            <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
                                            <small class="text-muted">Chọn ảnh cho sản phẩm (định dạng JPG, PNG, GIF).</small>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                                            <a href="index.php?act=Product" class="btn btn-secondary">Hủy</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
      
        </div>
    </div>
    
</body>

</html>