<?php

class HomeController
{
    public $product;

    public function __construct()
    {
        $this->product = new Products();
    }
    public function index()
    {
        // Lấy danh sách sản phẩm
        $products = $this->product->getProducts();

        // Gọi view

        require_once './views/home.php';
    }
}
