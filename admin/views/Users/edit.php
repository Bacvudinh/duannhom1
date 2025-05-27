<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Chỉnh sửa người dùng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require_once "views/layouts/libs_css.php"; ?>
</head>

<body>
    <div id="layout-wrapper">
        <?php require_once "views/layouts/siderbar.php"; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h4>Chỉnh sửa người dùng</h4>
                            <a href="index.php?act=Users" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form action="index.php?act=Users&method=update&id=<?= $user['id'] ?>" method="post" novalidate>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên người dùng</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu <small class="text-muted">(Để trống nếu không đổi)</small></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới nếu muốn đổi">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Vai trò</label>
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="1" <?= $user['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                        <option value="0" <?= $user['status'] == 0 ? 'selected' : '' ?>>Bị khóa</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                <a href="index.php?act=Users" class="btn btn-secondary ms-2">Hủy</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>
</body>
</html>