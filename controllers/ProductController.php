<?php
require_once './models/Products.php'; // Model sản phẩm
class ProductController
{
    public $product;

    public function __construct()
    {
        $this->product = new Products();
    }
    public function index()
    {
        // Kiểm tra nếu có từ khóa tìm kiếm
        $keyword = $_GET['keyword'] ?? null;

        // Lấy danh sách sản phẩm (có hoặc không có từ khóa)
        $products = $this->product->getProducts($keyword);

        // Gọi view
        require_once './views/listproducts.php';
    }
    public function productDetail()
    {
        // Lấy id từ url
        $id = $_GET['id'];
        // Kiểm tra id có tồn tại không
        // if ($id <= 0) {
        //     header('Location: index.php?act=listproducts');
        //     exit;
        // }
        // // Kiểm tra id có tồn tại trong csdl không
        // $product = $this->product->getProductById($id);
        // if (!$product) {
        //     header('Location: index.php?act=listproducts');
        //     exit;
        // }

        // Lấy danh sách sản phẩm
        $product = $this->product->getProductById($id);
        // Lấy danh sách sản phẩm liên quan

        $relatedProducts = $this->product->getRelatedProducts($product->category_id, $product->id);
        // Gọi view
        require_once './views/product_detail.php';
    }
}
