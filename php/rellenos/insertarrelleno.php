<?php
include ('../../php/conexion.php');

$idrelleno = null;
$descripcion = $_POST["descripcion"];




$query = "INSERT INTO relleno(idrelleno,descripcion,idstatus)
             VALUES ('$idrelleno','$descripcion', '1')";




$verificar_descripcion = mysqli_query($link,"SELECT * FROM relleno WHERE descripcion='$descripcion' ");
		
if(mysqli_num_rows($verificar_descripcion) > 0){
    
    echo '<script>alert("Este relleno ya está registrado, registra uno nuevo"); window.location="menurelleno.php" </script>';

          exit();
}

$ejecutar = mysqli_query($link, $query);


if($ejecutar){
    echo '<script>alert("Relleno almacenado exitosamente"); window.location="menurelleno.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, tamaño no almacenado");window.location="menurelleno.php"</script>  ';
    
}

  

?>