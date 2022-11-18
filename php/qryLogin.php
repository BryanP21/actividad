<?php
    if(isset($_REQUEST['btnlogin'])){
		session_start();

		$usuario =  $_REQUEST['usuario']??'';
		$contrasena = $_REQUEST['contrasena']??'';

		include_once 'conexion.php';

	//	$sql= "SELECT * from empleado where usuario= '$usuario'";
	    $sqlquery = "UPDATE * from empleado where usuario= '$usuario'";
echo 'hola';




		$resultset= mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($resultset);
		if($row){
			
			$_SESSION['idempleado']= $row['idempleado'];
			$_SESSION['usuario']= $row['usuario'];
			$_SESSION['contrasena']=$row['contrasena'];

			$_SESSION['activo']= '1';
			
            
			if($row['idstatus'] == 1){
			    if(password_verify($contrasena,$row['contrasena'])){
			header("location: ../menuprincipal/index.php");
			}else{
				echo '<script>alert("Usuario y/o contraseña incorrectos"); window.location = "login.php"; </script> ';
			}
		}else{
			echo '<script>alert("El usuario está inactivo"); window.location = "login.php"; </script> ';
		}
		
}

	}

?>



