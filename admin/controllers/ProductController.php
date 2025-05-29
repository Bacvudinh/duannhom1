<?php
// admin/controllers/ProductsController.php

require_once "../models/Products.php";
require_once "../models/Categories.php";

class ProductsController
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->productModel = new Products();
        $this->categoryModel = new Categories();
    }

    public function index()
    {
        $keyword = $_GET['keyword'] ?? null;
        $listProducts = $this->productModel->getProductsforadmin($keyword);
        require_once "./views/Product/Product.php";
    }

    public function add()
    {
        $listCategories = $this->categoryModel->getActiveCategories();
        // Khởi tạo $error rỗng để tránh lỗi "Undefined variable" khi load view lần đầu
        $error = [];
        require_once "./views/Product/addProduct.php";
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? 0;
            $status= $_POST['status']=1 ; // Mặc định là 1 (có thể thêm trường này nếu cần)

            $description = $_POST['description'] ?? '';
            $image = null;
            $is_delete=null;
           
            $error = [];

            if (empty($name)) { $error[] = "Vui lòng nhập tên sản phẩm."; }
            if (empty($price) || !is_numeric($price) || $price <= 0) { $error[] = "Giá sản phẩm không hợp lệ."; }
            if (empty($categoryId)) { $error[] = "Vui lòng chọn danh mục."; }

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../uploads/product/';
                if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $imagePath = $uploadDir . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $image = $imageName;
                } else {
                    $error[] = "Không thể tải lên ảnh.";
                }
            } else if ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $error[] = "Lỗi khi tải lên ảnh: " . $_FILES['image']['error'];
            }

            if (empty($error)) {
                if ($this->productModel->addProduct($name, $price, $categoryId,$status, $description,$image, $is_delete)) {
                    header("Location: index.php?act=Product&success=add");
                    exit();
                } else {
                    $error[] = "Thêm sản phẩm thất bại vào cơ sở dữ liệu.";
                }
            }

            // Nếu có lỗi, vẫn cần load danh mục và hiển thị lại form với lỗi
            $listCategories = $this->categoryModel->getAllCategories();
            require_once "./views/Product/addProduct.php";

        } else {
            header("Location: index.php?act=addProduct");
            exit();
        }
    }

    public function edit($id)
    {
        if (is_numeric($id) && $id > 0) {
            $product = $this->productModel->getProductById($id);
            $listCategories = $this->categoryModel->getActiveCategories();

            if ($product) {
                // Đảm bảo biến $error tồn tại khi render view
                $error = [];
                require_once "./views/Product/editProduct.php";
            } else {
                // Chuyển hướng về trang danh sách sản phẩm với thông báo lỗi
                header("Location: index.php?act=Product&error=product_not_found");
                exit();
            }
        } else {
            // Chuyển hướng về trang danh sách sản phẩm với thông báo lỗi
            header("Location: index.php?act=Product&error=invalid_product_id");
            exit();
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? 0;
            $description = $_POST['description'] ?? '';
            $currentImage = $_POST['current_image'] ?? null;
            $status = $_POST['status'] ?? 1; // Mặc định là 1 (có thể thêm trường này nếu cần)
            $image = $currentImage; // Mặc định giữ ảnh cũ
            $error = [];

            if (empty($name)) { $error[] = "Vui lòng nhập tên sản phẩm."; }
            if (empty($price) || !is_numeric($price) || $price <= 0) { $error[] = "Giá sản phẩm không hợp lệ."; }
            if (empty($categoryId)) { $error[] = "Vui lòng chọn danh mục."; }

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../uploads/product/';
                if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $imagePath = $uploadDir . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $image = $imageName;
                    // Xóa ảnh cũ nếu có và ảnh mới được tải lên thành công
                    if ($currentImage && file_exists($uploadDir . $currentImage)) {
                        unlink($uploadDir . $currentImage);
                    }
                } else {
                    $error[] = "Không thể tải lên ảnh mới.";
                }
            } else if ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                // Nếu có lỗi upload không phải do người dùng không chọn file
                $error[] = "Lỗi khi tải lên ảnh mới: " . $_FILES['image']['error'];
            }

            if (empty($error)) {
                if ($this->productModel->updateProduct($id, $name, $price, $categoryId, $status, $description, $image)
) {
                    header("Location: index.php?act=Product&success=update");
                    exit();
                } else {
                    $error[] = "Cập nhật sản phẩm thất bại vào cơ sở dữ liệu.";
                }
            }
            
            // Nếu có lỗi, cần load lại dữ liệu sản phẩm (đã được cập nhật nếu có)
            // và danh mục để hiển thị lại form
            $product = $this->productModel->getProductById($id); // Lấy lại sản phẩm để hiển thị trên form nếu có lỗi
            if (!$product) { // Trường hợp đặc biệt: sản phẩm bị xóa trong khi đang chỉnh sửa
                header("Location: index.php?act=Product&error=product_not_found_during_update");
                exit();
            }
            $listCategories = $this->categoryModel->getAllCategories();
            require_once "./views/Product/editProduct.php";

        } else {
            // Nếu truy cập bằng GET thay vì POST, chuyển hướng về trang chỉnh sửa
            header("Location: index.php?act=editProduct&id=" . $id);
            exit();
        }
    }

    public function delete($id)
    {
        if (is_numeric($id) && $id > 0) {
            $product = $this->productModel->getProductById($id);

            if ($product) {
                // Bạn có thể thêm logic xóa cart_items ở đây nếu không dùng ON DELETE CASCADE
                // require_once "../models/Cart.php";
                // $cartModel = new Cart();
                // if (!$cartModel->deleteCartItemsByProductId($id)) {
                //     header("Location: index.php?act=Product&error=delete_cart_items_failed");
                //     exit();
                // }

                if (!empty($product->image) && file_exists('../uploads/product/' . $product->image)) {
                    unlink('../uploads/product/' . $product->image);
                }

                if ($this->productModel->delete($id)) {
                    header("Location: index.php?act=Product&success=delete");
                    exit();
                } else {
                    header("Location: index.php?act=Product&error=delete_failed");
                    exit();
                }
            } else {
                header("Location: index.php?act=Product&error=product_not_found");
                exit();
            }
        } else {
            header("Location: index.php?act=Product&error=invalid_product_id");
            exit();
        }
    }
}