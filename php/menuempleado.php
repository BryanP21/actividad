 <?php
include('../php/conexion.php');

session_start();
if(!isset($_SESSION['usuario'])){
	echo '<script> alert("Por favor debes iniciar sesión"); window.location = "login.php"; </script>'; 
	session_destroy();
	
}
$empleado = "SELECT * FROM empleado";
$query = mysqli_query($link,$empleado);
?>

<!doctype html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
				    <!-- ============= -->
				    <!-- Bootstrap CSS -->
				    <!-- ============= -->
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	    <link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../js/css/alertify.css">
		<link rel="stylesheet" type="text/css" href="../js/css/themes/default.css">
		<script src="../js/alertify.js"></script>
		<script src="../js/jquery-3.6.1.min.js"></script>
        <link type="text/css" href="../css/style.css" rel="stylesheet">
	    <!-- <link rel="stylesheet" type="text/css" href="css/fonts.css"> -->
	    <title>Maria's Pasteleria</title>
	    <link rel="icon" href="../img/logos/Logos-MP-2021-02-02-06.ico">
	</head>
	<body class="fondo" style="overflow-x:hidden">
					<!-- ====== -->
				    <!-- NAVBAR -->
				    <!-- ====== -->

			<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light border-bottom px-3">
		 	<a class="navbar-brand" href="index.html">
		    	<img src="../img/logos/logos formato-08-A.png" width="150px" height="50px" class="d-inline-block" alt="">
		  	</a>
		  	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      		<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		    <ul class="px-4 fs-4 navbar-nav navbar-text">
		      <li class="nav-item active">
		        <a class="px-3 nav-link " href="../pedidos/pedidos.php">Pedidos</a>
		      </li>
		      <li class="nav-item">
		        <a class="px-3 nav-link" href="#">Productos</a>
		      </li>
		      <li class="nav-item">
		        <a class="px-3 nav-link" href="cliente/menucliente.php">Clientes</a>
		      </li>
		      <li class="nav-item">
		        <a class="px-3 nav-link" href="#">Empleados</a>
		      </li>
		      <li class="px-3 nav-item">
		        <a class="nav-link" href="../agenda/index.php">Agenda</a>
		      </li>
		    </ul>
		  </div>
		</nav>

<!-------------------------INICIO TABLA EMPLEADOS REGISTROS------------->
    <!---<div> <img src=../img/empleados/3.png class="logologregistros2"></div>--->
	
	<main class="frmdis2">
		<p class=Title1 style="color: white" font face="Alata" >Registro de empleado</p>
		
		<form class="formregistros"  action ="insertarempleado.php" method="POST"   >

			<div class='field'>
				<h4>Usuario</h4>
				<input name='usuario' type='name' autocomplete="off" placeholder='Usuario' required />
			</div>
			<div class='field3'>
				<h4>Tipo empleado</h4>
				<select name='tipoempleado' required placeholder='Selecciona Rol' required>
					<option selected disabled></option>
					<option value="1">Administrador</option>
					<option value="2">Empleado</option>
				</select>
			</div>
			<div class='field'>
				<h4>Contraseña</h4>
				<input name='contrasena' type='password' autocomplete="off" autocomplete placeholder='******' required/>
			</div>
            <div class='field'>
				<h4>Vuelve a escribir la contraseña</h4>
				<input name='confirmacontrasena' type= 'password' required placeholder='******' required>
			</div>
			
			<p class=Title2 style="color: white" font face="Alata" >Datos Personales</p>
			<div class='field'>
				<h4>Nombre</h4>
				<input name='nombre' type='text' autocomplete placeholder='-----' required/>
			</div>
			<div class='field'>
				<h4>Correo</h4>
				<input name='correo' type='email' autocomplete placeholder='Correo'required />
			</div>
			<div class='field'>
				<h4>Teléfono</h4>
				<input name='telefono' type='text' autocomplete placeholder='#######' required />
			</div>
			<div class='field'>
				<h4>Apellido Paterno</h4>
				<input name='apellidopaterno' type='text' autocomplete placeholder='Apellido Paterno' required/>
			</div>
			<div class='field'>
				<h4>Apellido Materno</h4>
				<input name='apellidomaterno' type='text' autocomplete placeholder='Apellido Materno' required/>
			</div>

			<div >
				
			<input 				class="submitbutton" 
								type="submit"
								value="Agregar"
								
								
						>
			</div>
		</form>
	</main>
	<div class="ajustador"><p class=Title5 style="color: white" font face="Alata" >Consulta de empleados</p></div>
    <div class="users-table3" >
        
        <table style="border: 6px solid #ee69c6;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Usuario</th> 
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Tipo de empleado</th>
                    <th>Estatus</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
			
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
					<?php if($row['idstatus'] == '1'){ ?>
                    <tr>
                        
                        <th><?= $row['nombre'] ?></th>
                        <th><?= $row['usuario'] ?></th>
                        <th><?= $row['apellidopaterno'] ?></th>
                        <th><?= $row['apellidomaterno'] ?></th>
                        <th><?= $row['correo'] ?></th>
                        <th><?= $row['telefono'] ?></th>
						<?php if($row['idTipoempleado'] == '1'){ ?> 
							<th>Administrador</th>
						<?php } else{ ?>
							<th>Empleado</th>
					<?php	} ?>
						        
					<?php if($row['idstatus'] == '1'){ ?> 
							<th>Activo</th>
						<?php } ?>
					
                        <th><a href="updateempleado.php?idempleado=<?= $row['idempleado'] ?>" class="users-table--edit">Editar</a></th>
                        <th><a href="eliminaempleado.php?idempleado=<?= $row['idempleado'] ?>" class="users-table--delete" >Eliminar</a></th>
						
                    </tr>
					<?php	} ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
	
</body>
		<!-- ============================ -->
	    <!-- Bootstrap Bundle with Popper -->
	    <!-- ============================ -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

