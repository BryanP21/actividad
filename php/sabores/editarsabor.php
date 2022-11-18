<?php
include ('../../php/conexion.php');

$idsabor = $_POST['idsabor'];
$descripcion = $_POST["descripcion"];
$status = $_POST["status"];

$sql = "UPDATE sabor SET descripcion='$descripcion', idstatus='$status' WHERE idsabor='$idsabor'";

$verificar_descripcion = mysqli_query($link,"SELECT * FROM sabor WHERE descripcion='$descripcion' ");
		
		if(mysqli_num_rows($verificar_descripcion) > 0){
			
			echo '<script>alert("Este sabor ya está en uso, porfavor utiliza uno distinto"); window.location="menusabor.php" </script>';

				  exit();
		}




$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Sabor actualizado exitosamente"); window.location="menusabor.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, sabor no actualizado");window.location="menusabor.php"</script>  ';
    
}

  

?>