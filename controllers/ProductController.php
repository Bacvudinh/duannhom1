<?php

class ProductController
{
    public $product;
     public $category;

    public function __construct()
    {
        $this->product = new Products();
        $this->category = new Categories();
    }
    public function index()
    {
        // Lấy từ khóa tìm kiếm nếu có
        $keyword = $_GET['keyword'] ?? null;

        // Phân trang
        $limit = $_GET['limit'] ?? 5; // Mặc định là 5 nếu không truyền gì
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        // Lấy tổng số sản phẩm
        $totalProducts = $this->product->countProducts($keyword);
        $totalPages = ceil($totalProducts / $limit);

        // Lấy danh sách sản phẩm theo trang
        $products = $this->product->getProducts($keyword, $limit, $offset);
        // Lấy danh sách sản phẩm theo loại 
        $categories  = $this->category->getAllCategories();
        // Gọi view và truyền biến
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
