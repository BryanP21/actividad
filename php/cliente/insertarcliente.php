
<link rel="stylesheet" type="text/css" href="../js/alertify.js">
		<link rel="stylesheet" type="text/css" href="../js/alertify.min.js">
		<script src="../js/jquery-3.6.1.min.js"></script>
<?php
include ('../../php/conexion.php');

$idcliente= null;
$nombre = $_POST["nombre"];
$apellidopaterno = $_POST["apellidopaterno"];
$apellidomaterno = $_POST["apellidomaterno"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];

	

$query = "INSERT INTO cliente(idcliente,nombre,apellidopaterno, apellidomaterno, correo, telefono,iddireccion,idstatus)
             VALUES ('$idcliente','$nombre','$apellidopaterno', '$apellidomaterno', '$correo', '$telefono','1','1')";




$verificar_correo = mysqli_query($link,"SELECT * FROM cliente WHERE correo='$correo' ");
		
if(mysqli_num_rows($verificar_correo) > 0){
    
    echo '<script>alert("El correo  ya está en uso, porfavor utiliza uno distinto"); window.location="menucliente.php" </script>';
}else{


$ejecutar = mysqli_query($link, $query);

if($ejecutar){
    
    echo '<script>alert("Cliente registrado exitósamente");window.location="menucliente.php"</script>  ';
    
}else{
    echo '<script>alert("Intentalo de nuevo, cliente no almacenado");window.location="menucliente.php"</script>  ';
    
}
 } 

?>



