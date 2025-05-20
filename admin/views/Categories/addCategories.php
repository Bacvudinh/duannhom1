<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Thêm danh mục | NN Shop</title>
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
                        <h1>Thêm danh mục</h1>
                    </center>
                    <div class="row mt-4">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row formtitle">
                                        <h2>Nhập thông tin danh mục</h2>
                                    </div>
                                    <div class="row formcontent">
                                        <?php if (isset($error)): ?>
                                            <div class="alert alert-danger"><?= $error ?></div>
                                        <?php endif; ?>
                                        <form action="index.php?act=saveCategory" method="post">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên loại</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Thêm mới</button>
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