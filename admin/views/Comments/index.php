<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Quản lý bình luận | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <?php require_once "views/layouts/libs_css.php"; ?>
    <style>
    .comment-content {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    </style>
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
                                <h4 class="mb-sm-0">Danh sách bình luận</h4>
                                <?php if (isset($_SESSION['success'])): ?>
                                <div id="alert-box" class="alert alert-success alert-dismissible fade show"
                                    role="alert">
                                    <strong><?= $_SESSION['success'] ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <script>
                                setTimeout(function() {
                                    var alertBox = document.getElementById('alert-box');
                                    if (alertBox) alertBox.style.display = 'none';
                                }, 3000);
                                </script>
                                <?php unset($_SESSION['success']); ?>
                                <?php endif; ?>

                                <div class="d-flex align-items-center gap-md-2">
                                    <form action="index.php" method="get" class="d-flex align-items-center">
                                        <input type="hidden" name="act" value="admin_comments">
                                        <div class="search-box me-2">
                                            <input type="text" class="form-control" placeholder="Tìm kiếm bình luận..."
                                                name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i
                                                class="ri-search-line"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (isset($_GET['success'])): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php
                                            if ($_GET['success'] == 'update') echo "Cập nhật bình luận thành công!";
                                            if ($_GET['success'] == 'delete') echo "Xóa bình luận thành công!";
                                            if ($_GET['success'] == 'toggle') echo "Thay đổi trạng thái thành công!";
                                            ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (isset($_GET['error'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php
                                            if ($_GET['error'] == 'notfound') echo "Không tìm thấy bình luận.";
                                            if ($_GET['error'] == 'invalidid') echo "ID bình luận không hợp lệ.";
                                            if ($_GET['error'] == 'delete_failed') echo "Xóa bình luận thất bại.";
                                            ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="selectAll">
                                                            <label class="form-check-label" for="selectAll"></label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Người dùng</th>
                                                    <th scope="col">Sản phẩm</th>
                                                    <th scope="col">Nội dung</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col" class="text-end">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($comments)): ?>
                                                <?php foreach ($comments as $comment): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="selected[]" value="<?= $comment->id ?>">
                                                            <label class="form-check-label"></label>
                                                        </div>
                                                    </td>
                                                    <td><?= $comment->id ?></td>
                                                    <td><?= htmlspecialchars($comment->user_name) ?></td>
                                                    <td><?= htmlspecialchars($comment->product_name) ?></td>
                                                    <td class="comment-content">
                                                        <?= htmlspecialchars($comment->content) ?></td>
                                                    <td>
                                                        <?php if ($comment->status === 1): ?>
                                                        <span class="badge bg-success">Hiển thị</span>
                                                        <?php else: ?>
                                                        <span class="badge bg-secondary">Ẩn</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="hstack gap-3 flex-wrap justify-content-end">
                                                            <a href="index.php?act=admin_comment_edit&id=<?= $comment->id ?>"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="ri-pencil-line"></i> Sửa</a>
                                                            <a href="index.php?act=admin_comment_delete&id=<?= $comment->id ?>"
                                                                onclick="return confirm('Xóa bình luận này?')"
                                                                class="btn btn-sm btn-danger"><i
                                                                    class="ri-delete-bin-line"></i> Xóa</a>
                                                            <?php if ($comment->status === 1): ?>
                                                            <a href="index.php?act=admin_comment_toggle&id=<?= $comment->id ?>&status=0"
                                                                class="btn btn-sm btn-secondary"><i
                                                                    class="ri-eye-off-line"></i> Ẩn</a>
                                                            <?php else: ?>
                                                            <a href="index.php?act=admin_comment_toggle&id=<?= $comment->id ?>&status=1"
                                                                class="btn btn-sm btn-success"><i
                                                                    class="ri-eye-line"></i> Hiện</a>
                                                            <?php endif; ?>



                                                            <!-- <?php if ($comment->status === 1): ?>
                                                                        <a href="index.php?act=admin_comment_toggle&id=<?= $comment->id ?>&new_status=0" class="btn btn-sm btn-secondary">
                                                                            <i class="ri-eye-off-line"></i> Ẩn
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a href="index.php?act=admin_comment_toggle&id=<?= $comment->id ?>&new_status=1" class="btn btn-sm btn-success">
                                                                            <i class="ri-eye-line"></i> Hiện
                                                                        </a>
                                                                    <?php endif; ?> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">Không có bình luận nào.</td>
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