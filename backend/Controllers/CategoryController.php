<?php
require_once('../model/Category.php');

class CategoryController{

    public function get($connect){
        $category  = new Category();
        $categories = $category->get($connect);
        return $categories;
    }

    public function create($connect,$name){
        $category  = new Category($name);

        $data = $category->save($connect);
        return $data;
    }

    public function update($connect,$data){
        $category  = new Category($data->name);
        $data = $category->update($connect,$data->id);
        return $data;
    }

    public function delete($connect,$id){
        $category  = new Category();
        $data = $category->delete($connect,$id);
        return $data;
    }
    
}