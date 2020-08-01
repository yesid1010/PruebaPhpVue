<?php
require_once('model/Product.php');

class ProductController{

    public function getProducts($connect,$category){
        $product  = new Product();
        $products = $product->get($connect,$category);
        return $products;
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){
        
    }

}