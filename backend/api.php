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
    $categories         = $categoryController->getCategories($connect);

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
    $categories          = $categoryController->getCategories($connect);

    echo json_encode($categories);
}

if($params->url == 'created_product')
{
    $productController  = new ProductController();
    $product            = $productController->create($connect,$params->product);
    echo json_encode($product);
}

if($params->url == 'insert')
{
//  $data = array(
//   ':name' => $received_data->name,
//   ':description' => $received_data->$description,
//   ':price' => $received_data->price
//  );


 $query = "INSERT INTO ordenes () VALUES () ";

 $statement = $connect->prepare($query);

 $statement->execute();
 
 $ordenID = $connect->lastInsertId();

for ($i=0; $i < $carrito; $i++) { 
   
}

 $output = array(
  'message' => 'Data Inserted',
  'idorden'=> $result
 );
 echo json_encode($output);
}

?>