
<?php 
session_start();
include('../../conexion.php'); 

if(isset($_POST['modificar']))
{
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];
	$Ncontrasena = $_POST['Ncontrasena'];

	$hascontra = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 10]);
	$hashncontra = password_hash($Ncontrasena, PASSWORD_DEFAULT, ['cost' => 10]);
	
	$sql= "SELECT * from empleado where usuario= '$usuario'";
	
		$resultset= mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($resultset);
		
	if($row!=null){

    $usr =$row['usuario'];

	if($usuario == $usr)
	{
		if($contrasena == $Ncontrasena){
			$update_pwd= mysqli_query($link, "Update empleado SET contrasena= '$hascontra' WHERE usuario= '".mysqli_real_escape_string($link,$usuario)."' ");

			echo '<script>alert("Contraseña modificada"); window.location = "../../login.php"; </script> ';
			exit();

		}else{
			echo '<script>alert("Las contraseñas no coinciden");  window.location = "ModifContra.php";</script> ';
			
		}

	}

     
}else{
	echo '<script>alert("El usuario no existe"); window.location = "ModifContra.php"; </script> ';
}
}
?>

