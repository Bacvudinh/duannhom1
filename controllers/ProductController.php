<?php

class ProductController
{

    public $product;
    public $category;
    public $size;

    public function __construct()
    {

        $this->product = new Products();
        $this->category = new Categories();
        $this->size= new Size1();
    }
    public function index()
    {
        // Lấy từ khóa tìm kiếm nếu có
        $keyword = $_GET['keyword'] ?? null;

        // Phân trang
        $limit = $_GET['limit'] ?? 6; // Mặc định là 5 nếu không truyền gì
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        // Lấy tổng số sản phẩm
        $totalProducts = $this->product->countProducts($keyword);
        $totalPages = ceil($totalProducts / $limit);

        // Lấy danh sách sản phẩm theo trang
        $products = $this->product->getProducts($keyword, $limit, $offset);
        // Lấy danh sách sản phẩm theo loại 
        $categories  = $this->category->getAllCategoriesClient();
        $sizes= $this->size->getAllSize();
        // Gọi view và truyền biến
        require_once './views/listproducts.php';
    }
   public function productDetail()
{
    $id = $_GET['id'] ?? 0;

    $product = $this->product->getProductById($id);
    if (!$product) {
    $_SESSION['add_to_cart_error'] = "Sản phẩm không tồn tại hoặc đã bị xóa.";
    header("Location: index.php");
    exit;
}

// ✅ Kiểm tra nếu sản phẩm đã ngừng kinh doanh (status = 0)
if ($product->status == 0) {
    $_SESSION['add_to_cart_error'] = "Sản phẩm '{$product->name}' hiện đã ngừng kinh doanh.";
    header("Location: index.php?act=product_detail&id=$id");
    exit;
}
    $productVariants = $this->product->getVariantsByProductId($product->id);
    if (!$product) {
        header('Location: index.php?act=listproducts');
        exit;
    }

    $relatedProducts = $this->product->getRelatedProducts($product->category_id, $product->id);

    require_once 'models/Comment.php';
    $commentModel = new Comment();
    $comments = $commentModel->getCommentsByProductId($id);

    // Thêm bình luận
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $userId = $_SESSION['user']['id'] ?? null;
        $commentText = $_POST['comment'] ?? '';

        if ($userId && !empty($commentText)) {
            $commentModel->addComment([
                'user_id' => $userId,
                'product_id' => $id,
                'comment' => $commentText
            ]);
            header("Location: index.php?act=productDetail&id=$id");
            exit;
        }
    }

    require_once './views/product_detail.php';
}

}
