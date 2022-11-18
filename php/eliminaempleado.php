<?php
include ('../php/conexion.php');


$idempleado = $_GET['idempleado'];


$sql = "UPDATE empleado SET idstatus='2' WHERE idempleado='$idempleado'";
$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Empleado eliminado exitosamente"); window.location="menuempleado.php" </script> ';
   
}else{
    echo '<script>alert("Intentalo de nuevo, usuario no eliminado");window.location="menuempleado.php"</script>  ';
    
}





?>

