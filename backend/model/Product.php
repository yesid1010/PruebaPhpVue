<?php

class Product{
    private  $idproduct;
    private  $name;
    private  $description;
    private  $price;
    private  $image;

    private $connect;
    public function __construct(){
        // $this->name = $name;
        // $this->description = $description;
        // $this->price = $price;
        // $this->image = $image;
    }

    public static function get($connect,$category){
        $products = array();

        if($category == 0){
            $query = "SELECT * FROM products";
        }else{
            $query = "SELECT * FROM products WHERE idcategory = $category";
        }
        $statement = $connect->prepare($query);
        $statement->execute();
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $products[] = $row;
        }

        return $products;
    }

}