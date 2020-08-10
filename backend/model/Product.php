<?php

class Product{
    private  $idCategory;
    private  $name;
    private  $description;
    private  $price;
    private  $image;

    private $connect;
    public function __construct($name='',$price='',$image='',$description='',$idCategory=''){
        $this->name        = $name;
        $this->description = $description;
        $this->price       = $price;
        $this->image       = $image;
        $this->idCategory  = $idCategory;
    }

    public static function get($connect,$category){
        $products = array();

        if($category == 0){
            $query = "SELECT * FROM products ORDER BY idproduct DESC";
        }else{
            $query = "SELECT * FROM products WHERE idcategory = $category ORDER BY idproduct DESC";
        }
        $statement = $connect->prepare($query);
        $statement->execute();
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $products[] = $row;
        }

        return $products;
    }


    public function save($connect){

        $data = array(
            ':name'        => $this->getName(),
            ':description' => $this->getDescription(),
            ':price'       => $this->getPrice(),
            ':image'       => $this->getImage(),
            ':idcategory'  => $this->getIdCategory(),
           );
      
        $query = "INSERT INTO products (name,description,price,image,idcategory)
                                VALUES (:name,:description,:price,:image,:idcategory)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $productId = $connect->lastInsertId();

        $product = $this->getProduct($connect,$productId);

        return $product;
    }

    public function getName(){
        return $this->name;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getImage(){
        return $this->image;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getIdCategory(){
        return $this->idCategory;
    }

    // metodo para obtener un producto de la base de datos segun su id
    public function getProduct($connect,$id){
        $query      = "SELECT * FROM products WHERE idproduct = $id";
        $statement  = $connect->prepare($query);
        $statement->execute();

        $product    = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $product;
    }

    public function delete($connect,$id){
        $product = $this->getProduct($connect,$id); // obtento el producto a eliminar
        $data = array(':id' => $id);
        $query = "DELETE FROM products WHERE idproduct = :id";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        
        return $product;
    }

    public function update($connect,$id){
        $data = array(
            ':idproduct'   => $id,
            ':name'        => $this->getName(),
            ':description' => $this->getDescription(),
            ':price'       => $this->getPrice(),
            ':image'       => $this->getImage(),
            ':idcategory'  => $this->getIdCategory(),
           );
      
        $query = "UPDATE products SET name        = :name,
                                      description = :description,
                                      price       = :price,
                                      image       = :image,
                                      idcategory  = :idcategory
                                WHERE idproduct   = :idproduct";
                                
        $statement = $connect->prepare($query);
        $statement->execute($data);

        $product = $this->getProduct($connect,$id); 

        return $product;
    }
}




