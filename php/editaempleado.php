
<?php
include ('../php/conexion.php');

$idempleado = $_POST['idempleado'];
$usuario = $_POST["usuario"];
$nombre = $_POST["nombre"];
$apellidopaterno = $_POST["apellidopaterno"];
$apellidomaterno = $_POST["apellidomaterno"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$tipoempleado = $_POST["tipoempleado"];
$status = $_POST["status"];


$sql = "UPDATE empleado SET nombre='$nombre',usuario='$usuario',apellidopaterno='$apellidopaterno',apellidomaterno='$apellidomaterno',correo='$correo',telefono='$telefono',idTipoempleado='$tipoempleado', idstatus='$status' WHERE idempleado='$idempleado'";



//$verificar_usuario = mysqli_query($link,"SELECT * FROM empleado WHERE usuario='$usuario' ");
		
	//	if(mysqli_num_rows($verificar_usuario) > 0){
			
		//	echo '<script>alert("Este usuario ya está en uso, porfavor utiliza uno distinto"); window.location="index.php" </script>';

			//	  exit();
		//}

$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Empleado actualizado exitosamente"); window.location="index.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, usuario no actualizado");window.location="index.php"</script>  ';
    
}

  

?>