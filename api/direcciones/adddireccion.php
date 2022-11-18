<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$link = conectarse();

$ID_CLIENTE = $_POST['ID_CLIENTE'];
$CALLE = $_POST['CALLE'];
$CIUDAD = $_POST['CIUDAD'];
$CODIGO = $_POST['CODIGO'];
$NUMERO = $_POST['NUMERO'];
$COLONIA = $_POST['COLONIA'];
$ESTADO = $_POST['ESTADO'];
$DESCRIPCION = $_POST['DESCRIPCION'];


$instruccion = "INSERT INTO direcciones VALUES(null,'".$ID_CLIENTE."','".$CALLE."','".$COLONIA."','".$NUMERO."','".$CODIGO."','".$CIUDAD."','".$ESTADO."','".$DESCRIPCION."');";

if ($link->query($instruccion) === TRUE  ) {
    $last_id = $link->insert_id;
    http_response_code(200); 
    $response = array(
        "success"=>true,
        "data"=>$last_id
    );
    echo json_encode($response); 
}else {
    http_response_code(500); 
    $response = array(
        "success"=>false,
        "message"=> "Error: " . $instruccion . "<br>" . $link->error
    );
    echo json_encode($response);
}
  
  $link->close();
  
  ?>
