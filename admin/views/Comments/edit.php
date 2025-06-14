<?php
// Đảm bảo biến $comment tồn tại, nếu không thì quay về danh sách
if (!isset($comment)) {
    header("Location: index.php?act=admin_comments&error=notfound");
    exit();
}

$error = $error ?? []; // Đảm bảo biến $error tồn tại
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
                    <center><h1>Sửa bình luận</h1></center>
                    <div class="row mt-4">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row formtitle">
                                        <h2>Sửa thông tin bình luận</h2>
                                    </div>
                                    <div class="row formcontent">
                                        <form action="index.php?act=admin_comment_update" method="post">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($comment->id) ?>">

                                            <div class="mb-3">
                                                <label for="user" class="form-label">Người dùng có ID:</label>
                                                <input type="text" class="form-control" id="user" value="<?= htmlspecialchars($comment->user_id) ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="username" class="form-label">Tên người bình luận:</label>
                                                <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($comment->user_name) ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="product" class="form-label">Sản phẩm có ID:</label>
                                                <input type="text" class="form-control" id="product" value="<?= htmlspecialchars($comment->product_id) ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="content" class="form-label">Nội dung</label>
                                                <textarea
                                                    class="form-control <?= !empty($error['content']) ? 'is-invalid' : '' ?>"
                                                    id="content"
                                                    name="content"
                                                    rows="3"
                                                    ><?= htmlspecialchars($comment->comment ?? '') ?></textarea>
                                                <?php if (!empty($error['content'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= htmlspecialchars($error['content']) ?>
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
                                                <a href="index.php?act=admin_comments" class="btn btn-secondary">Quay lại danh sách</a>
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
