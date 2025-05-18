<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>Dashboard | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <?php require_once "layouts/libs_css.php"; ?>
</head>

<body>

    <div id="layout-wrapper">
        <?php
            require_once "layouts/siderbar.php";
        ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <center><h1>Danh sách danh mục</h1></center>
                </div>
                <div class="container mt-4">
        <div class="row formtitle">
           
        </div>
        <div class="row formcontent">
            <div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>Mã loại</th>
                            <th>Tên loại</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listDanhMuc as $danhMuc) { ?>
                            <tr>
                                <td><input type="checkbox" name="" id=""></td>
                                <td><?= $danhMuc['id'] ?></td>
                                <td><?= $danhMuc['name'] ?></td>
                                <td>

                                    <a href="index.php?act=suadm&id=<?= $danhMuc['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn sửa không?')" class="btn btn-warning">
                                        Sửa
                                    </a>

                                    <a href="index.php?act=xoadm&id=<?= $danhMuc['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger">
                                        Xóa
                                    </a>
                                    <a href="index.php?act=adddm" class="btn btn-primary">Thêm</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
            </div>
        </div>
    </div>

</body>

</html>
