
<link rel="stylesheet" type="text/css" href="../js/alertify.js">
		<link rel="stylesheet" type="text/css" href="../js/alertify.min.js">
		<script src="../js/jquery-3.6.1.min.js"></script>
<?php
include ('../php/conexion.php');

$idempleado = null;
$usuario = $_POST["usuario"];
$contrasena= $_POST["contrasena"];
$nombre = $_POST["nombre"];
$apellidopaterno = $_POST["apellidopaterno"];
$apellidomaterno = $_POST["apellidomaterno"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$tipoempleado = $_POST["tipoempleado"];
$confirmacontrasena = $_POST["confirmacontrasena"];


//Encriptamiento de contraseña
$hash = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 10]);
	

$query = "INSERT INTO empleado(idempleado,nombre, usuario, contrasena, apellidopaterno, apellidomaterno, correo, telefono, idTipoempleado, idstatus)
             VALUES ('$idempleado','$nombre', '$usuario', '$hash', '$apellidopaterno', '$apellidomaterno', '$correo', '$telefono','$tipoempleado','1')";




$verificar_usuario = mysqli_query($link,"SELECT * FROM empleado WHERE usuario='$usuario' ");
		
if(mysqli_num_rows($verificar_usuario) > 0){
    
    echo '<script>alert("Este usuario ya está en uso, porfavor utiliza uno distinto"); window.location="menuempleado.php" </script>';

          exit();
}
if($contrasena == $confirmacontrasena){


$ejecutar = mysqli_query($link, $query);


if($ejecutar){
    
    echo '<script>alert("Empleado registrado exitósamente");window.location="menuempleado.php"</script>  ';
    
}else{
    echo '<script>alert("Intentalo de nuevo, usuario no almacenado");window.location="menuempleado.php"</script>  ';
    
}
}else{
    
    //echo '<script>alert("Las contraseñas no coinciden");  window.location = "menuempleado.php";</script> ';
    echo '<script type="text/javascript"> $(document).ready(function(){alert("Las contraseñas no coinciden");}) </script> ';
}
  

?>



