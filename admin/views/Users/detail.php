<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Chi tiết người dùng | NN Shop</title>
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
        .detail-label {
            font-weight: 600;
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
                        <div class="col-12">
                            <h4 class="mb-3">Chi tiết người dùng</h4>
                            <a href="index.php?act=Users" class="btn btn-secondary mb-3"><i class="ri-arrow-left-line"></i> Quay lại</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($user)): ?>
                                <ul class="list-unstyled">
                                    <li><span class="detail-label">ID:</span> <?= htmlspecialchars($user->id) ?></li>
                                    <li><span class="detail-label">Tên:</span> <?= htmlspecialchars($user->NAME) ?></li>
                                    <li><span class="detail-label">Email:</span> <?= htmlspecialchars($user->email) ?></li>
                                    <li><span class="detail-label">SĐT:</span> <?= htmlspecialchars($user->phone) ?></li>
                                    <li><span class="detail-label">Địa chỉ:</span> <?= htmlspecialchars($user->address) ?></li>
                                    <li><span class="detail-label">Vai trò:</span> <?= htmlspecialchars($user->role) ?></li>
                                    <li>
                                        <span class="detail-label">Trạng thái:</span>
                                        <span class="<?= $user->status == 1 ? 'user-status-active' : 'user-status-inactive' ?>">
                                            <?= $user->status == 1 ? 'Hoạt động' : 'Bị khóa' ?>
                                        </span>
                                    </li>
                                </ul>
                            <?php else: ?>
                                <div class="alert alert-warning">Không tìm thấy thông tin người dùng.</div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>
</body>
</html>