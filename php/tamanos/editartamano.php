<?php
include ('../../php/conexion.php');

$idtamano = $_POST['idtamano'];
$descripcion = $_POST["descripcion"];
$status = $_POST["status"];

$sql = "UPDATE tamano SET descripcion='$descripcion', idstatus='$status' WHERE idtamano='$idtamano'";

$verificar_descripcion = mysqli_query($link,"SELECT * FROM tamano WHERE descripcion='$descripcion' ");
		
		if(mysqli_num_rows($verificar_descripcion) > 0){
			
			echo '<script>alert("Este tamaño ya está en uso, porfavor utiliza uno distinto"); window.location="menutamano.php" </script>';

				  exit();
		}




$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Tamaño actualizado exitosamente"); window.location="menutamano.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, tamano no actualizado");window.location="menutamano.php"</script>  ';
    
}

  

?>