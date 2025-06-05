<?php
if (!isset($comment)) {
    header("Location: index.php?act=admin_comments&error=notfound");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Sửa bình luận | NN Shop</title>
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
                        <h1>Sửa size</h1>
                    </center>
                    <div class="row mt-4">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row formtitle">
                                        <h2>Sửa </h2>
                                    </div>
                                    <div class="row formcontent">
                                        <?php if (isset($error)): ?>
                                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <label for="user" class="form-label"> Id số </label>
                                            <input type="text" class="form-control" id="user" name="user" value="<?= htmlspecialchars($comment->id) ?>" readonly>
                                        </div>
                                
                                      
                                        <form action="index.php?act=admin_size_update" method="post">
                                            <input type="hidden" name="id" value="<?= $comment->id ?>">
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Nội dung</label>
                                                <textarea class="form-control" id="content" name="name" rows="3" required><?= htmlspecialchars($comment->name) ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Trạng thái</label>
                                                <select name="status" class="form-select">
                                                    <option value="1" <?= $comment->status === 1 ? 'selected' : 0 ?>>Hiển thị</option>
                                                    <option value="0" <?= $comment->status === 0 ? 'selected' : 1  ?>>Ẩn</option>
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