<?php
require_once('conexion.php');


$received_data = json_decode(file_get_contents("php://input"));
$data = array();
$categories = array();
$carr=array();
if($received_data->action == 'fetchall')
{
    if($received_data->selectedCategorie == 0){
        $query = "SELECT * FROM products";
    }else{
        $query = "SELECT * FROM products WHERE idcategory = $received_data->selectedCategorie";
    }
    
    $statement = $connect->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
    $data[] = $row;
    }

    $query = "SELECT * FROM categories";
    $statement = $connect->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
    $categories[] = $row;
    }
    echo json_encode([$data,$categories]);
}

if($received_data->action == 'insert')
{
 $data = array(
  ':name' => $received_data->name,
  ':description' => $received_data->$description,
  ':price' => $received_data->price
 );


 $query = "INSERT INTO ordenes () VALUES ()";

 $statement = $connect->prepare($query);

 $statement->execute($data);
 
 $output = array(
  'message' => 'Data Inserted'
 );

 $query2 = "INSERT INTO detailsOrden () VALUES ()"; 
 echo json_encode($output);
}

?>