<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$link = conectarse();

$idempleado = $_POST['idempleado'];
$idcliente = $_POST['idcliente'];
$fechaentrega = $_POST['fechaentrega'];
$idpedido = $_POST['idpedido'];

$instruccion = "UPDATE pedido SET idempleado = '".$idempleado."', fechaentrega = '".$fechaentrega."', idcliente = '".$idcliente."' WHERE idpedido = ".$idpedido.";";

if ($link->query($instruccion) === TRUE) {
    http_response_code(201); 
    $response = array(
        "success"=>true
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