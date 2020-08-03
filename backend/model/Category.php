<?php

class Category {
    private $idcategory;
    private $name;

    public function get($connect){
        $categories = array();
        $query = "SELECT * FROM categories ORDER BY idcategory DESC";
        $statement = $connect->prepare($query);
        $statement->execute();
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $categories[] = $row;
        }
        
        return $categories;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function save($connect,$name){

        $data = array(
            ':name' => $name
           );

      
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $idcategory = $connect->lastInsertId();

        $category = $this->getCategory($connect,$idcategory);

        return $category;
    }

    public function getCategory($connect,$id){
        $query = "SELECT * FROM categories WHERE idcategory = $id";
        $statement = $connect->prepare($query);
        $statement->execute();
        $category = $statement->fetch(PDO::FETCH_ASSOC);
        return $category;
    }

    public function delete($connect,$id){
        $category = $this->getCategory($connect,$id); // obtento la categoria a eliminar
        $data = array(':id' => $id);
        $query = "DELETE FROM categories WHERE idcategory = :id";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        
        return $category;
    }
}