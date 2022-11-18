<?php
include ('../../php/conexion.php');


$idcliente = $_GET['idcliente'];


$sql = "UPDATE cliente SET idstatus='2' WHERE idcliente='$idcliente'";
$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Cliente eliminado exitosamente"); window.location="menucliente.php" </script> ';
   
}else{
    echo '<script>alert("Intentalo de nuevo, cliente no eliminado");window.location="menucliente.php"</script>  ';
    
}





?>

