<?php
include ('../../php/conexion.php');

$idcobertura = $_POST['idcobertura'];
$descripcion = $_POST["descripcion"];
$status = $_POST["status"];

$sql = "UPDATE cobertura SET descripcion='$descripcion', idstatus='$status' WHERE idcobertura='$idcobertura'";

$verificar_descripcion = mysqli_query($link,"SELECT * FROM cobertura WHERE descripcion='$descripcion' ");
		
		if(mysqli_num_rows($verificar_descripcion) > 0){
			
			echo '<script>alert("Esta cobertura ya está en uso, porfavor utiliza una distinto"); window.location="menucobertura.php" </script>';

				  exit();
		}




$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Cobertura actualizada exitosamente"); window.location="menucobertura.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, cobertura no actualizada");window.location="menucobertura.php"</script>  ';
    
}

  

?>