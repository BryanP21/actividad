<?php
include ('../../php/conexion.php');

$idrelleno = $_POST['idrelleno'];
$descripcion = $_POST["descripcion"];
$status = $_POST["status"];

$sql = "UPDATE relleno SET descripcion='$descripcion', idstatus='$status' WHERE idrelleno='$idrelleno'";

$verificar_descripcion = mysqli_query($link,"SELECT * FROM relleno WHERE descripcion='$descripcion' ");
		
		if(mysqli_num_rows($verificar_descripcion) > 0){
			
			echo '<script>alert("Este relleno ya está en uso, porfavor utiliza uno distinto"); window.location="menurelleno.php" </script>';

				  exit();
		}




$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Relleno actualizado exitosamente"); window.location="menurelleno.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, relleno no actualizado");window.location="menurelleno.php"</script>  ';
    
}

  

?>