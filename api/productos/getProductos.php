<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$link = conectarse();
$idPedido = $_GET['idpedido'];
$instruccion = "SELECT productos.idproducto, productos.idpedido, productos.cantidad, productos.idsabor, sabor.descripcion AS 'SABOR', productos.idrelleno, relleno.descripcion AS 'RELLENO', productos.idcobertura, cobertura.descripcion AS 'COBERTURA', productos.idtamano, tamano.descripcion AS 'TAMANO', productos.especificaciones, productos.imgref FROM productos LEFT JOIN sabor ON productos.idsabor = sabor.idsabor LEFT JOIN relleno ON productos.idrelleno = relleno.idrelleno LEFT JOIN cobertura ON productos.idcobertura = cobertura.idcobertura LEFT JOIN tamano ON productos.idtamano = tamano.idtamano WHERE productos.idpedido = '".$idPedido."';";
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