<?php
require_once('model/Product.php');

class ProductController{

    public function getProducts($connect,$category){
        $product  = new Product();
        $products = $product->get($connect,$category);
        return $products;
    }

    public function create($connect,$producto){

        $product  = new Product($producto->name,$producto->price,$producto->image,$producto->description,$producto->category);
        $data     = $product->save($connect,$product);

        return $data;
    }

    public function update(){

    }

    public function delete(){
        
    }

}