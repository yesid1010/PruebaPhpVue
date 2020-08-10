<?php
require_once('model/Conection.php');
require_once('Controllers/ProductController.php');
require_once('Controllers/CategoryController.php');

// creamos la conexion a la base de datos
$conection = new Conection();
$connect = $conection->connect();

// recibimos los parametros
$params = json_decode(file_get_contents("php://input"));

// rutas 

if($params->url == 'products')
{
    $productController  = new ProductController();
    $products           = $productController->getProducts($connect,$params->category);

    $categoryController = new CategoryController();
    $categories         = $categoryController->get($connect);

    echo json_encode([$products,$categories]);
}

if($params->url == 'save_category')
{
    $categoryController = new CategoryController();
    $category           = $categoryController->create($connect,$params->name);

    echo json_encode($category);
}

if($params->url == 'categories')
{
    $categoryController  = new CategoryController();
    $categories          = $categoryController->get($connect);

    echo json_encode($categories);
}

if($params->url == 'deleteCategory')
{
     $categoryController  = new CategoryController();
     $category            = $categoryController->delete($connect,$params->id);
    
     echo json_encode([$category,"Categorìa eliminada"]);
}

if($params->url == 'updateCategory')
{
     $categoryController  = new CategoryController();
     $category            = $categoryController->update($connect,$params->category);
    
     echo json_encode($category);
}

if($params->url == 'created_product')
{
    
     $productController  = new ProductController();
     $product            = $productController->create($connect,$params->product);
     echo json_encode($product);
}

if($params->url == 'deleteProduct')
{
     $productController  = new ProductController();
     $product            = $productController->delete($connect,$params->id);
    
     echo json_encode([$product,"Producto eliminado"]);
}

if($params->url == 'update_product')
{
     $productController  = new ProductController();
     $product            = $productController->update($connect,$params->product);
    
     echo json_encode($product);
}

?>