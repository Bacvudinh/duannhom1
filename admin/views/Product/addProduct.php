<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

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

                    <!-- Tiêu đề -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Thêm sản phẩm mới</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                                        <li class="breadcrumb-item active">Thêm mới</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (isset($error) && !empty($error)): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            <?php foreach ($error as $msg): ?>
                                            <li><?= htmlspecialchars($msg) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <div id="variant-error" class="alert alert-danger d-none"></div>
                                    <?php endif; ?>

                                    <!-- Hidden size template để tái sử dụng -->
                                    <select id="size-options-template" style="display:none;">
                                        <option value="">-- Chọn size --</option>
                                        <?php foreach ($sizes as $size): ?>
                                        <option value="<?= $size->name ?>"><?= htmlspecialchars($size->name) ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- Form chính -->
                                    <form action="index.php?act=saveProduct" method="post"
                                        enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="productName" class="form-label">Tên sản phẩm <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="productName" name="name"
                                                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" >
                                        </div>

                                        <div class="mb-3">
                                            <label for="productPrice" class="form-label">Giá sản phẩm <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="productPrice" name="price"
                                                value="<?= htmlspecialchars($_POST['price'] ?? '') ?>" min="0"
                                                step="0.01" >
                                        </div>

                                        <div class="mb-3">
                                            <label for="productCategory" class="form-label">Danh mục <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="productCategory" name="category_id"
                                                >
                                                <option value="">-- Chọn danh mục --</option>
                                                <?php foreach ($listCategories as $category): ?>
                                                <option value="<?= $category->id ?>"
                                                    <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category->id) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($category->name) ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productDescription" class="form-label">Mô tả sản phẩm</label>
                                            <textarea class="form-control" id="productDescription" name="description"
                                                rows="5"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productImage" class="form-label">Ảnh sản phẩm</label>
                                            <input type="file" class="form-control" id="productImage" name="image"
                                                accept="image/*">
                                            <small class="text-muted">Chọn ảnh (JPG, PNG, GIF).</small>
                                        </div>

                                        <!-- Biến thể -->
                                      <!-- Biến thể -->
<div class="mb-3">
    <label class="form-label">Biến thể sản phẩm (Size + Giá)</label>

    <!-- ✅ Thông báo lỗi -->
    <div id="variant-error" class="alert alert-danger d-none"></div>

    <div id="variants-container">
        <div class="variant-item row mb-2">
            <div class="col-md-5">
                <select class="form-select size-select" name="size_id[]" required>
                    <option value="">-- Chọn size --</option>
                    <?php foreach ($sizes as $size): ?>
                    <option value="<?= $size->name ?>"><?= htmlspecialchars($size->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5">
                <input type="number" class="form-control" name="variant_price[]" placeholder="Giá" min="0" step="0.01" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-variant">Xóa</button>
            </div>
        </div>
    </div>
    <button type="button" id="add-variant" class="btn btn-sm btn-success mt-2">Thêm biến thể</button>
    <div class="text-end">
    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    <a href="index.php?act=Product" class="btn btn-secondary">Hủy</a>
</div>
</div>

<!-- JS xử lý biến thể -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('variants-container');
    const addBtn = document.getElementById('add-variant');
    const sizeTemplate = document.getElementById('size-options-template');
    const errorDiv = document.getElementById('variant-error');

    addBtn.addEventListener('click', function () {
        errorDiv.classList.add('d-none'); // Ẩn lỗi trước khi kiểm tra

        const currentVariants = document.querySelectorAll('.variant-item');
        for (const item of currentVariants) {
            const select = item.querySelector('.size-select');
            const priceInput = item.querySelector('input[name="variant_price[]"]');
            const price = parseFloat(priceInput.value);

            if (
                select.value === '' ||
                priceInput.value.trim() === '' ||
                isNaN(price) ||
                price <= 0
            ) {
                errorDiv.textContent = 'Vui lòng chọn size và nhập giá hợp lệ (> 0) cho tất cả biến thể trước khi thêm mới.';
                errorDiv.classList.remove('d-none');
                return;
            }
        }

        // Thêm biến thể mới
        const newVariant = document.createElement('div');
        newVariant.className = 'variant-item row mb-2';
        const options = sizeTemplate.innerHTML;

        newVariant.innerHTML = `
            <div class="col-md-5">
                <select class="form-select size-select" name="size_id[]" required>
                    ${options}
                </select>
            </div>
            <div class="col-md-5">
                <input type="number" class="form-control" name="variant_price[]" placeholder="Giá" min="0" step="0.01" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-variant">Xóa</button>
            </div>
        `;
        container.appendChild(newVariant);
        updateDisabledOptions();
    });

    container.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-variant')) {
            if (container.children.length > 1) {
                e.target.closest('.variant-item').remove();
                updateDisabledOptions();
            } else {
                errorDiv.textContent = 'Phải có ít nhất một biến thể.';
                errorDiv.classList.remove('d-none');
            }
        }
    });

    container.addEventListener('change', function (e) {
        if (e.target.classList.contains('size-select')) {
            updateDisabledOptions();
        }
    });

    function updateDisabledOptions() {
        const allSelects = document.querySelectorAll('.size-select');
        const selected = Array.from(allSelects).map(s => s.value).filter(v => v !== '');
        allSelects.forEach(select => {
            const current = select.value;
            Array.from(select.options).forEach(opt => {
                if (opt.value !== '' && opt.value !== current) {
                    opt.disabled = selected.includes(opt.value);
                } else {
                    opt.disabled = false;
                }
            });
        });
    }
});
</script>

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