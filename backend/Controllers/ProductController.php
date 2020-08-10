<?php
require_once('model/Product.php');

class ProductController{

    public function getProducts($connect,$category){
        $product  = new Product();
        $data = $product->get($connect,$category);
        return $data;
    }

    public function create($connect,$producto){
        $product  = new Product($producto->name,$producto->price,$producto->image,$producto->description,$producto->category);
        $data     = $product->save($connect);

        return $data;
    }

    public function update($connect,$producto){
        $product  = new Product($producto->name,$producto->price,$producto->image,$producto->description,$producto->category);
        $data     = $product->update($connect,$producto->idproduct);

        return $data;
    }

    public function delete($connect,$id){
        $product  = new Product();
        $data     = $product->delete($connect,$id);
        return $data;
    }

}