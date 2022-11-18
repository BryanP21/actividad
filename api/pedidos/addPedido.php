<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$link = conectarse();

$idempleado = $_POST['idempleado'];
$fechainicio = $_POST['fechainicio'];
$fechaentrega = $_POST['fechaentrega'];
$idcliente = $_POST['idcliente'];

$instruccion = "INSERT INTO pedido(idempleado,fechaentrega,fechainicio,idcliente,idstatusentrega) VALUES(".$idempleado.",STR_TO_DATE('".$fechaentrega."','%Y,%m,%d'),curdate(),'".$idcliente."',1)";

if ($link->query($instruccion) === TRUE) {
    $last_id = $link->insert_id;
    http_response_code(201); 
    $response = array(
        "success"=>true,
        "data"=>$last_id
    );
    echo json_encode($response);
} else {
    http_response_code(400); 
    $response = array(
        "success"=>false,
        "message"=> "Error: " . $instruccion . "<br>"
    );
    echo json_encode($response);
}
  
  $link->close();
  
  ?>