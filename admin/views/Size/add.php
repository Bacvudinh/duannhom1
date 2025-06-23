<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Thêm size sản phẩm | NN Shop</title>
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
                                <h4 class="mb-sm-0">Thêm size cho sản phẩm</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                                        <li class="breadcrumb-item active">Thêm size</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (isset($error) && !empty($error)): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <ul class="mb-0">
                                            <?php foreach ($error as $msg): ?>
                                            <li><?= htmlspecialchars($msg) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>

                                    <form action="index.php?act=admin_size_save" method="post">


                                        <div class="mb-3">
                                            <label for="size" class="form-label">Tên size</label>
                                            <input type="text"
                                                class="form-control <?= isset($error['size']) ? 'is-invalid' : '' ?>"
                                                name="size" id="size"
                                                value="<?= htmlspecialchars($comment->name ?? '') ?>">
                                            <?php if (!empty($error['size'])): ?>
                                            <div class="invalid-feedback d-block"><?= $error['size'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Trạng thái</label>

                                            <label for="name" class="form-label">Trạng thái</label>
                                            <select name="status" class="form-select">
                                                <option value="1">Hoạt động</option>
                                                <option value="0">Tạm dừng</option>
                                            </select>
                                        </div>


                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Thêm size</button>
                                            <a href="index.php?act=admin_size" class="btn btn-secondary">Quay lại</a>
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