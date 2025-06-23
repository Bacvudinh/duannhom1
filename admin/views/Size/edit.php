<?php
if (!isset($comment)) {
    header("Location: index.php?act=admin_sizes&error=notfound");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>Sửa size | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "./views/layouts/libs_css.php"; ?>
</head>

<body>
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <center><h1>Sửa size</h1></center>
                    <div class="row mt-4">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row formtitle"><h2>Thông tin size</h2></div>
                                    <div class="row formcontent">

                                        <form action="index.php?act=admin_size_update" method="post">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($comment->id) ?>">

                                            <div class="mb-3">
                                                <label for="user" class="form-label">ID</label>
                                                <input type="text" class="form-control" id="user" name="user"
                                                       value="<?= htmlspecialchars($comment->id) ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="content" class="form-label">Tên size</label>
                                                <textarea
                                                    class="form-control <?= isset($error['name']) ? 'is-invalid' : '' ?>"
                                                    id="content" name="name" rows="3"><?= htmlspecialchars($comment->name) ?></textarea>
                                                <?php if (!empty($error['name'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= htmlspecialchars($error['name']) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Trạng thái</label>
                                                <select name="status" class="form-select">
                                                    <option value="1" <?= $comment->status == 1 ? 'selected' : '' ?>>Hiển thị</option>
                                                    <option value="0" <?= $comment->status == 0 ? 'selected' : '' ?>>Ẩn</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                <a href="index.php?act=admin_sizes" class="btn btn-secondary">Quay lại danh sách</a>
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

    <?php require_once "./views/layouts/libs_js.php"; ?>
</body>
</html>
