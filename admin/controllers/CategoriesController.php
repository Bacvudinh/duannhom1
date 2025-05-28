<?php
require_once "../models/Categories.php";
require_once "../models/Products.php"; // Đảm bảo file Products.php tồn tại

class categoriesController
{
    private $categoryModel;
    private $productModel;

    public function __construct()
    {
        $this->categoryModel = new Categories();
        $this->productModel = new Products();
    }

    public function index()
    {
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $listDanhMuc = $this->categoryModel->searchCategories($keyword);
        } else {
            $listDanhMuc = $this->categoryModel->getAllCategories();
        }
        require_once "./views/Categories/Categories.php";
        $listDanhMuc = $this->categoryModel->getAllCategories();
        require_once "./views/Categories/Categories.php";
    }

    public function add()
    {
        require_once "./views/Categories/addCategories.php";
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
         $status = $_POST['status'];
            if (!empty($name) && isset($_POST['status'])) {
                // Kiểm tra xem tên danh mục có hợp lệ không
                if ($this->categoryModel->addCategory($name ,$status)) {
                    header("Location: index.php?act=Categories&success=add"); // Chuyển hướng về trang danh sách
                    exit();
                } else {
                    $error = "Thêm danh mục thất bại.";
                    require_once "./views/Categories/CategoriesCategories.php";
                }
            } else {
                $error = "Vui lòng nhập tên danh mục.";
                require_once "./views/Categories/CategoriesCategories.php";
            }
        } else {
            header("Location: index.php?act=danhmuc"); // Chuyển hướng về trang danh sách
            exit();
        }
    }

    public function edit($id)
    {
        if (is_numeric($id) && $id > 0) {
            $danhMuc = $this->categoryModel->getCategoryById($id);
            if ($danhMuc) {
                require_once "./views/Categories/editCategories.php";
            } else {
                header("Location: index.php?act=Categories&error=notfound");
                exit();
            }
        } else {
            header("Location: index.php?act=Categories&error=invalidid");
            exit();
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status']; // Mặc định là 0 nếu không có giá trị
            if (!empty($name) && isset($_POST['status'])) {
                // Kiểm tra xem ID có hợp lệ không
                if (is_numeric($id) && $id > 0) {
                    if ($this->categoryModel->updateCategory($id, $name, $status)) {
                        header("Location: index.php?act=Categories&success=update");
                        exit();
                    } else {
                        $error = "Cập nhật danh mục thất bại.";
                        $danhMuc = $this->categoryModel->getCategoryById($id);
                        require_once "./views/Categories/editCategories.php";
                    }
                } else {
                    header("Location: index.php?act=danhmuc&error=invalidid");
                    exit();
                }
            } else {
                $error = "Vui lòng nhập tên danh mục.";
                $danhMuc = $this->categoryModel->getCategoryById($id);
                require_once "./views/Categories/editCategories.php";
            }
        } else {
            header("Location: index.php?act=editCategories&id=" . $id);
            exit();
        }
    }

    public function delete($id)
    {
        if (is_numeric($id) && $id > 0) {
            // 1. Xóa tất cả sản phẩm thuộc về danh mục này trước
            if ($this->productModel->deleteProductsByCategoryId($id)) {
                // 2. Sau khi xóa sản phẩm thành công, tiến hành xóa danh mục
                if ($this->categoryModel->delete($id)) {
                    header("Location: index.php?act=Categories&success=delete"); // Chuyển hướng về trang danh sách
                    exit();
                } else {
                    header("Location: index.php?act=Categories&error=delete"); // Chuyển hướng về trang danh sách
                    exit();
                }
            } else {
                // Xảy ra lỗi khi xóa sản phẩm
                header("Location: index.php?act=Categories&error=delete_products_failed"); // Chuyển hướng về trang danh sách
                exit();
            }
        } else {
            header("Location: index.php?act=Categories&error=invalidid"); // Chuyển hướng về trang danh sách
            exit();
        }
    }
}
