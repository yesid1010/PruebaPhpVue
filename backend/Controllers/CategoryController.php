<?php
require_once('model/Category.php');

class CategoryController{

    public function get($connect){
        $category  = new Category();
        $categories = $category->get($connect);
        return $categories;
    }

    public function create($connect,$name){
        $category  = new Category();

        $data = $category->save($connect,$name);
        return $data;
    }

    public function update(){

    }

    public function delete($connect,$id){
        $category  = new Category();
        $data = $category->delete($connect,$id);
        return $data;
    }
    
}