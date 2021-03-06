<?php

class Category {
    private $idcategory;
    private $name;


    public function __construct($name=''){
        $this->name = $name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    // metodo para obtener todas las categorìas
    public function get($connect){
        $categories = ['data'=>[]];
        $query = "SELECT * FROM categories ORDER BY idcategory DESC";
        $statement = $connect->prepare($query);
        $statement->execute();

        
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $id = $row['idcategory'];
            $query_count = "SELECT COUNT(*) AS product_category_count FROM products WHERE idcategory = $id";
            $stm_count = $connect->prepare($query_count);
            $stm_count->execute();
            $count = $stm_count->fetch(PDO::FETCH_ASSOC);

            array_push($categories['data'],
                [
                   'idcategory' => $row['idcategory'],
                   'name'=>$row['name'],
                   'count' => $count
                ]
            );
        }
        
        return $categories;
    }

    // metodo para guardar una categorìa
    public function save($connect){

        $data = array(':name' => $this->getName());

        $query = "INSERT INTO categories (name) VALUES (:name)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $idcategory = $connect->lastInsertId();

        $category = $this->getCategory($connect,$idcategory);

        return $category;
    }

    // metodo para editar una categorìa
    public function update($connect,$id){
        $data = array(
            ':id'=>$id,
            ':name' => $this->getName()
        );

        $query = "UPDATE categories SET name = :name WHERE idcategory = :id";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $category = $this->getCategory($connect,$id);

        return $category;
    }

    // metodo para obtener una categorìa
    public function getCategory($connect,$id){
        $query = "SELECT * FROM categories WHERE idcategory = $id";
        $statement = $connect->prepare($query);
        $statement->execute();
        $category = $statement->fetch(PDO::FETCH_ASSOC);
        return $category;
    }

    // metodo para eliminar una categorìa
    public function delete($connect,$id){
        $category = $this->getCategory($connect,$id); // obtento la categoria a eliminar
        $data = array(':id' => $id);
        $query = "DELETE FROM categories WHERE idcategory = :id";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        
        return $category;
    }
}