<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$idcliente = $_GET['idcliente'];
$link = conectarse();
$instruccion = "SELECT * FROM direcciones WHERE idcliente = ".$idcliente.";";

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
        "message"=>"Not records found ".$instruccion
    );
}
echo json_encode($response);
?>