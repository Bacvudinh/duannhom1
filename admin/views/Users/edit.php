<!doctype html>
<html lang="vi">

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

                    <!-- Tiêu đề và nút quay lại -->
                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Chỉnh sửa người dùng</h4>
                            <a href="index.php?act=Users" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </div>

                    <!-- Form chỉnh sửa -->
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="index.php?act=updateUser&id=<?= $user->id ?>">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user->NAME) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user->email) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user->phone) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user->address) ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label">Vai trò</label>
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="customer" <?= $user->role === 'customer' ? 'selected' : '' ?>>Customer</option>
                                        <option value="admin" <?= $user->role === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu (bỏ trống nếu không đổi)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="1" <?= $user->status == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                        <option value="0" <?= $user->status == 0 ? 'selected' : '' ?>>Bị khóa</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
