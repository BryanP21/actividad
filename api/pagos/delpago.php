<?php
header('Content-Type: application/json; charset=utf-8');
include("../../config/config.php");
$link = conectarse();
$ID_PEDIDO = $_POST['ID_PEDIDO'];
$ID_PAGO = $_POST['ID_PAGO'];
$data = [];

$instruccion = "DELETE FROM pagos WHERE idpago = '".$ID_PAGO."';";

if ($link->query($instruccion) === TRUE  ) {

    $instruccionCheckPagado = "SELECT pedido.costototal AS 'TOTAL',(SELECT SUM(pagos.cantidad) FROM pagos WHERE pagos.idpedido = pedido.idpedido)  AS 'TOTAL_PAGOS' FROM pedido WHERE idpedido = ".$ID_PEDIDO.";";
    $querys =  $link->query($instruccionCheckPagado);
    if ($querys->num_rows > 0) {
        while($row = $querys->fetch_assoc()) {
            array_push($data,$row);
          }
          if($data[0]['TOTAL'] == $data[0]['TOTAL_PAGOS']){

            /* Actualizamos */
            $instruccionPagado = "UPDATE pedido SET edopago = 'Si' WHERE idpedido = '".$ID_PEDIDO."';";
            if ($link->query($instruccionPagado) === TRUE  ) {
                    http_response_code(200); 
                    $response = array(
                        "success"=>true
                    );
                    echo json_encode($response); 
                    return;
            }
        }elseif($data[0]['TOTAL'] > $data[0]['TOTAL_PAGOS']){
            /* Actualizamos */
            $instruccionPagado = "UPDATE pedido SET edopago = 'No' WHERE idpedido = '".$ID_PEDIDO."';";
            if ($link->query($instruccionPagado) === TRUE  ) {
                    http_response_code(200); 
                    $response = array(
                        "success"=>true
                    );
                    echo json_encode($response); 
                    return;
            }
        }
    }else{
        $response = array(
            "success"=>false,
            "message"=>"Not records founds ".$instruccionCheckPagado
        );
        echo json_encode($response); 
        return;
    }
    
    

} else {
    http_response_code(500); 
    $response = array(
        "success"=>false,
        "message"=> "Error: " . $instruccion . "<br>" . $link->error
    );
    echo json_encode($response);
}
  
  $link->close();
  
  ?>