<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$link = conectarse();
$ID_DIRECCION = $_GET['iddireccion'];
$instruccion = "SELECT * FROM direcciones WHERE iddireccion = ".$ID_DIRECCION.";";
$query =  $link->query($instruccion);
$data = [];
$response =[];
if ($query->num_rows > 0) {
    while($row = $query->fetch_assoc()) {
        array_push($data,$row);
      }
      $response = array(
        "success"=>true,
        "rows"=>$query->num_rows,
        "data"=>$data
    );
}else{
    $response = array(
        "success"=>false,
        "message"=>"Not records found"
    );
}
echo json_encode($response);
?>