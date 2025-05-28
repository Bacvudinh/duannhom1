<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Quản lý danh mục | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
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
                                <h4 class="mb-sm-0">Danh sách danh mục</h4>

                                <div class="d-flex align-items-center gap-md-2">
                                    <form action="index.php?act=Categories" method="get" class="d-flex align-items-center">
                                        <input type="hidden" name="act" value="Categories">
                                        <div class="search-box me-2">
                                            <input type="text" class="form-control" placeholder="Tìm kiếm danh mục..." name="keyword" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i class="ri-search-line"></i></button>
                                    </form>
                                    <a href="index.php?act=addCategories" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Thêm mới</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
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
                                                    <th scope="col">Mã loại</th>
                                                    <th scope="col">Tên loại</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col" class="text-end">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($listDanhMuc) && is_array($listDanhMuc)): ?>
                                                    <?php foreach ($listDanhMuc as $danhMuc): ?>
                                                        <tr>
                                                            <td class="text-center">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="selected[]" value="<?= $danhMuc->id ?>">
                                                                    <label class="form-check-label"></label>
                                                                </div>
                                                            </td>
                                                            <td><?= $danhMuc->id ?></td>
                                                            <td><?= htmlspecialchars($danhMuc->name) ?></td>
                                                            <td>
                                                                <?php if($danhMuc->status == 1): ?>
                                                                    <span class="badge bg-success">Hiển thị</span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-danger">Ẩn</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="hstack gap-3 flex-wrap justify-content-end">
                                                                    <a href="index.php?act=editCategories&id=<?= $danhMuc->id ?>" class="btn btn-sm btn-warning"><i class="ri-pencil-line"></i> Sửa</a>
                                                                    <a href="index.php?act=deleteCategory&id=<?= $danhMuc->id ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i> Xóa</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php elseif (isset($listDanhMuc) && is_object($listDanhMuc) && method_exists($listDanhMuc, 'fetch')): ?>
                                                    <?php while ($danhMuc = $listDanhMuc->fetch(PDO::FETCH_OBJ)): ?>
                                                        <tr>
                                                            <td class="text-center">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="selected[]" value="<?= $danhMuc->id ?>">
                                                                    <label class="form-check-label"></label>
                                                                </div>
                                                            </td>
                                                            <td><?= $danhMuc->id ?></td>
                                                            <td><?= htmlspecialchars($danhMuc->name) ?></td>
                                                            <td>
                                                                <?php if($danhMuc->status == 1): ?>
                                                                    <span class="badge bg-success">Hiển thị</span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-danger">Ẩn</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="hstack gap-3 flex-wrap justify-content-end">
                                                                    <a href="index.php?act=editCategories&id=<?= $danhMuc->id ?>" class="btn btn-sm btn-warning"><i class="ri-pencil-line"></i> Sửa</a>
                                                                    <a href="index.php?act=deleteCategory&id=<?= $danhMuc->id ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i> Xóa</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">Không có danh mục nào.</td>
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