<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$link = conectarse();
$instruccion = "SELECT pedido.idpedido,pedido.idempleado,empleado.NOMBRE AS 'EMPLEADO' ,pedido.fechainicio,pedido.fechaentrega,pedido.idcliente, cliente.nombre AS 'CLIENTE', pedido.costototal,pedido.anticipo, pedido.restante, pedido.edopago, pedido.idstatusentrega, statusentrega.descripcion FROM pedido LEFT JOIN empleado ON pedido.idempleado = empleado.idempleado LEFT JOIN cliente ON pedido.idcliente = cliente.idcliente LEFT JOIN statusentrega ON pedido.idstatusentrega = statusentrega.idstatusentrega WHERE pedido.idstatusentrega <> '1' AND pedido.idstatusentrega <> '10' ORDER BY pedido.idpedido DESC;";
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