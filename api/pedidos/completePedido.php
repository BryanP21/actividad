<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$link = conectarse();

$ID_PEDIDO = $_POST['ID_PEDIDO'];
$MONTO = $_POST['MONTO'];
$ENVIO = $_POST['ENVIO'];
$ANTICIPO = $_POST['ANTICIPO'];
$PAGADO = $_POST['PAGADO'];
$FORMA_PAGO = $_POST['FORMA_PAGO'];
$ID_DIRECCION = $_POST['ID_DIRECCION'];


$instruccion = "UPDATE pedido SET  cantidadproductos = (SELECT SUM(productos.cantidad) FROM productos WHERE productos.idpedido = ".$ID_PEDIDO.") , costototal = '".($MONTO+$ENVIO)."', anticipo = '".$ANTICIPO."', edopago = '".$PAGADO."', restante  ='".($MONTO+$ENVIO-$ANTICIPO)."', idstatusentrega  = '2', metodopago = '".$FORMA_PAGO."', iddireccion = '".$ID_DIRECCION."'   WHERE pedido.idpedido = '".$ID_PEDIDO."';";
$instruccionPago = "INSERT INTO pagos(idpedido,cantidad,fechapago,metodo) VALUES(".$ID_PEDIDO.",'".$ANTICIPO."',curdate(),'".$FORMA_PAGO."');";

if ($link->query($instruccion) === TRUE && $link->query($instruccionPago)  === TRUE ) {
    http_response_code(200); 
    $response = array(
        "success"=>true
    );
    echo json_encode($response);
} else {
    http_response_code(500); 
    $response = array(
        "success"=>false,
        "message"=> "Error: " . $instruccion . "<br>" .$instruccionPago . "<br>" . $link->error
    );
    echo json_encode($response);
}
  
  $link->close();
  
  ?>