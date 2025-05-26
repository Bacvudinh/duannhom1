<h4>Chi tiết người dùng</h4>
<ul>
    <li><strong>ID:</strong> <?= $user['id'] ?></li>
    <li><strong>Tên:</strong> <?= $user['name'] ?></li>
    <li><strong>Email:</strong> <?= $user['email'] ?></li>
    <li><strong>SĐT:</strong> <?= $user['phone'] ?></li>
    <li><strong>Địa chỉ:</strong> <?= $user['address'] ?></li>
    <li><strong>Vai trò:</strong> <?= $user['role'] ?></li>
    <li><strong>Trạng thái:</strong> <?= $user['status'] == 1 ? 'Hoạt động' : 'Bị khóa' ?></li>
</ul>
<a href="index.php?act=Users" class="btn btn-secondary">Quay lại</a>