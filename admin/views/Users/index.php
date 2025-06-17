<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Quản lý người dùng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require_once "views/layouts/libs_css.php"; ?>
    <style>
        .user-status-active {
            color: green;
            font-weight: 600;
        }

        .user-status-inactive {
            color: red;
            font-weight: 600;
        }

        .table-nowrap td {
            white-space: normal;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php require_once "views/layouts/siderbar.php"; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h4>Danh sách người dùng</h4>
                            <!-- <a href="index.php?act=Users&method=create" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Thêm mới</a> -->
                        </div>
                    </div>
                    <form method="get" action="index.php" class="d-flex mb-3">
                        <input type="hidden" name="act" value="Users">
                        <input type="text" name="keyword" class="form-control me-2" placeholder="Tìm kiếm theo tên hoặc email" value="<?= $_GET['keyword'] ?? '' ?>">
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>

                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php
                            if ($_GET['success'] == 'add') echo "Thêm người dùng thành công!";
                            if ($_GET['success'] == 'update') echo "Cập nhật người dùng thành công!";
                            if ($_GET['success'] == 'toggle') echo "Cập nhật trạng thái thành công!";
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Trạng thái</th>
                                            <th class="text-end">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($users)): ?>
                                            <?php foreach ($users as $user): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($user->id) ?></td>
                                                    <td><?= htmlspecialchars($user->NAME) ?></td>
                                                    <td><?= htmlspecialchars($user->email) ?></td>
                                                    <td><?= htmlspecialchars((string) $user->phone) ?></td>

                                                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                                        title="<?= htmlspecialchars($user->address) ?>">
                                                        <?= htmlspecialchars($user->address) ?>
                                                    </td>

                                                    <td><?= htmlspecialchars($user->role) ?></td>
                                                    <td class="<?= $user->status == 1 ? 'user-status-active' : 'user-status-inactive' ?>">
                                                        <?= $user->status == 1 ? 'Hoạt động' : 'Bị khóa' ?>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <a href="index.php?act=editUser&id=<?= $user->id ?>" class="btn btn-sm btn-warning">
                                                                <i class="ri-pencil-line"></i> Sửa
                                                            </a>
                                                            <a href="index.php?act=toggleStatusUser&id=<?= $user->id ?>"
                                                                class="btn btn-sm btn-secondary"
                                                                onclick="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái người dùng này không?')">
                                                                <?= $user->status == 1 ? 'Khóa' : 'Mở khóa' ?>
                                                            </a>
                                                            <a href="index.php?act=detailUser&id=<?= $user->id ?>" class="btn btn-sm btn-info">
                                                                <i class="ri-eye-line"></i> Xem
                                                            </a>
                                                            <a href="index.php?act=toggleRole&id=<?= $user->id ?>"
                                                                class="btn btn-sm btn-dark"
                                                                onclick="return confirm('Bạn có chắc chắn muốn đổi vai trò người dùng này không?')">
                                                                Đổi quyền
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Không có người dùng nào.</td>
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

    <?php require_once "views/layouts/libs_js.php"; ?>
</body>

</html>