<?php 


	include ('../../php/conexion.php');
   $link= mysqli_connect($host,$dbuser,$dbpass,$db);

    $id=$_GET['idcliente'];

    $sql="SELECT * FROM cliente WHERE idcliente='$id'";
    $query=mysqli_query($link, $sql);

    $row=mysqli_fetch_array($query);
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
	    <link rel="stylesheet" type="text/css" href="../../css/main.css">
        <link type="text/css" href="../../css/style.css" rel="stylesheet">
	    <!-- <link rel="stylesheet" type="text/css" href="css/fonts.css"> -->
	    <title>Maria's Pasteleria</title>
	    <link rel="icon" href="../../img/logos/Logos-MP-2021-02-02-06.ico">
	</head>
	<body class="fondo">
					<!-- ====== -->
				    <!-- NAVBAR -->
				    <!-- ====== -->
		<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light border-bottom px-3">
		 	<a class="navbar-brand" href="index.html">
		    	<img src="../../img/logos/logos formato-08-A.png" width="150px" height="50px" class="d-inline-block" alt="">
		  	</a>
		  	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      		<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		    <ul class="px-4 fs-4 navbar-nav navbar-text">
		      <li class="nav-item active">
		        <a class="px-3 nav-link " href="../html/pedidos.html">Pedidos</a>
		      </li>
		      <li class="nav-item">
		        <a class="px-3 nav-link" href="../html/productos.html">Productos</a>
		      </li>
		      <li class="nav-item">
		        <a class="px-3 nav-link" href="../html/clientes.html">Clientes</a>
		      </li>
		      <li class="nav-item">
		        <a class="px-3 nav-link" href="../html/empleados.html">Empleados</a>
		      </li>
		      <li class="px-3 nav-item">
		        <a class="nav-link" href="../html/agenda.html">Agenda</a>
		      </li>
		      <li class="nav-item">
		        <a class="px-3 nav-link" href="../html/status.html">Status</a>
		      </li>
		    </ul>
		  </div>
		</nav>

<!-------------------------INICIO TABLA EMPLEADOS REGISTROS------------->
    <!---<div> <img src=../img/empleados/3.png class="logologregistros2"></div>--->
	
	<main class="frmdis2">
		<p class=Title1 style="color: white" font face="Alata" >Modificación de cliente</p>
		
		<form class="formregistros"  action ="editacliente.php" method="POST">

		<input  type="hidden" name='idcliente' value="<?= $row ['idcliente']?>"/> 

			<div class='field4'>
			<h4>Estatus</h4>
			<select name="idstatus" required placeholder='Estatus' required  value="<?= $row['idstatus']?>" >
					<option selected disabled></option>
					<option value="1">Activo</option>
					<option value="2">Inactivo</option>
				</select>
			</div>   
			<p class=Title2 style="color: white" font face="Alata" >Datos Personales</p>
			<div class='field'>
				<h4>Nombre</h4>
				<input type="text" name="nombre" placeholder="Nombre" value="<?= $row['nombre']?>"/>
			</div>
			<div class='field'>
				<h4>Apellido Paterno</h4>
				<input type="text" name="apellidopaterno" placeholder="Apellido Paterno" value="<?= $row['apellidopaterno']?>"/>
			</div>
			<div class='field'>
				<h4>Apellido Materno</h4>
				<input type="text" name="apellidomaterno" placeholder="Apellido Materno" value="<?= $row['apellidomaterno']?>"/>
			</div>
			<div class='field'>
				<h4>Correo</h4>
				<input type="email" name="correo" placeholder="Correo" value="<?= $row['correo']?>"/>
			</div>
			<div class='field'>
				<h4>Teléfono</h4>
				<input type="text" name="telefono" placeholder="Telefono" value="<?= $row['telefono']?>"/>
			</div>

			<div >
				
			<input 				class="submitbutton" 
								type="submit"
								value="Actualizar"
								
								
						>
			</div>
		</form>
	</main>
    </body>
</html>

