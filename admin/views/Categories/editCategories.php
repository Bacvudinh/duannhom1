<?php
if (!isset($danhMuc)) {
    header("Location: index.php?act=danhmuc&error=notfound");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Sửa danh mục | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <?php require_once "./views/layouts/libs_css.php"; ?>
</head>

<body>
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <center>
                        <h1>Sửa danh mục</h1>
                    </center>
                    <div class="row mt-4">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row formtitle">
                                        <h2>Sửa thông tin danh mục</h2>
                                    </div>
                                    <div class="row formcontent">
                                        <?php if (isset($error)): ?>
                                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                                        <?php endif; ?>
                                        <form action="index.php?act=updateCategory&id=<?= $danhMuc->id ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $danhMuc->id ?>">

                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên loại</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($danhMuc->name) ?>" >
                                            </div>

                                            <!-- Thêm input chọn trạng thái
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Trạng thái hiện tại</label>
                                                <p class="form-control-plaintext ms-2">
                                                  
                                                </p> -->

                                            
                                                <div class="mb-3">
                                                    <label class="form-label">Trạng thái</label>
                                                    <select name="status" class="form-select">
                                                        <option value="1" <?php echo $danhMuc->status == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                                        <option value="0" <?php echo $danhMuc->status == 0 ? 'selected' : '' ?>>Tạm dừng</option>
                                                    </select>
                                                 
                                                </div>

                                            </div>

                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                <a href="index.php?act=Categories" class="btn btn-secondary">Quay lại danh sách</a>
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
    </div>
</body>

</html>