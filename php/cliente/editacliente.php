
<?php
include ('../../php/conexion.php');

$idcliente = $_POST["idcliente"];
$nombre = $_POST["nombre"];
$apellidopaterno = $_POST["apellidopaterno"];
$apellidomaterno = $_POST["apellidomaterno"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$idstatus = $_POST["idstatus"];


//Encriptamiento de contraseña
//$contrasena = MD5('MD5',$contrasena);


$sql = "UPDATE cliente SET nombre='$nombre',apellidopaterno='$apellidopaterno',apellidomaterno='$apellidomaterno',correo='$correo',telefono='$telefono',idstatus='$idstatus' WHERE idcliente='$idcliente'";



//$verificar_usuario = mysqli_query($link,"SELECT * FROM empleado WHERE usuario='$usuario' ");
		
	//	if(mysqli_num_rows($verificar_usuario) > 0){
			
		//	echo '<script>alert("Este usuario ya está en uso, porfavor utiliza uno distinto"); window.location="index.php" </script>';

			//	  exit();
		//}

$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Cliente actualizado exitosamente"); window.location="menucliente.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, cliente no actualizado"); window.location="updatecliente.php"</script>  ';
    
}

  

?>