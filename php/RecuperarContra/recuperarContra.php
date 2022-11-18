<?php
    if(isset($_REQUEST['btnlogin'])){
		session_start();

		$usuario =  $_REQUEST['usuario']??'';
		$contrasena = $_REQUEST['contrasena']??'';

		include_once '../conexion.php';

		$sql= "SELECT * from empleado where usuario= '$usuario'";
	

		$resultset= mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($resultset);
		if($row){
			
			$_SESSION['idempleado']= $row['idempleado'];
			$_SESSION['usuario']= $row['usuario'];
			$_SESSION['contrasena']=$row['contrasena'];
			$_SESSION['idstatus']= $row['idstatus'];
			$_SESSION['idTipoempleado']= $row['idTipoempleado'];
			
            if($row['idstatus'] == 1){

			if($row['idTipoempleado'] == 1){
			    if(password_verify($contrasena,$row['contrasena'])){
			header("location: ../RecuperarContra/RContraSeg/ModifContra.php");
			}else{
				echo '<script>alert("Usuario y/o contraseña incorrectos"); window.location = "recuperarContraseña.php"; </script> ';
			}
		}else{
			echo '<script>alert("El usuario no es administrador"); window.location = "recuperarContraseña.php"; </script> ';
		}
	}else{
		echo '<script>alert("El usuario está inactivo"); window.location = "recuperarContraseña.php"; </script> ';
	}
		
}

	}

?>


