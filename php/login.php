
<!DOCTYPE html>
<html>
<head>
	
<!--Aqui es donde se va a guardar nuestro formulario-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>							
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
				    <!-- ============= -->
				    <!-- Bootstrap CSS -->
				    <!-- ============= -->
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	    <link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" href="/css/mi.css?uuid=<?php echo uniqid();?>">
	  
	    <title>Maria's Pasteleria</title>
	    <link rel="icon" href="../img/logos/Logos-MP-2021-02-02-06.ico">
	</head>

<body class="fondo overflow-cancel-x" style="overflow-y:hidden" onload="javascript: document.getElementById('pasteleriam').focus();">
<!--Aqui es donde se va a guardar nuestro formulario-->
					<!-- ====== -->
				    <!-- NAVBAR -->
				    <!-- ====== -->
		<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light border-bottom px-3 justify-content-center">
		  <div class="row justify-content-between flex-grow-1">
		    <div class="col-1">
				<img src="../img/logos/logos formato-08-A.png" width="150px" height="50px" class="d-inline-block" alt="">
		    </div>
		    <div class="col-2">
		       <img src="../img/2.png" width="80%" height="100%" class="d-inline-block" alt="">
		    </div>
</nav>

<!--Inicio del login-->

<div id="frm" class="div" >

	<form class="frmdis4" action="qryLogin.php" method="POST"   >

			<div> <img src=../img/3.png class="logolog"></div>

				<p align ="right">
					<label class="letrasarriba">Usuario:</label>
					<input type="text" id="usuario" name="usuario"  class="letrasarriba3" required/>
				</p>	

				<p align ="right">
					<label class="letrasarriba">Contraseña:</label>
					<input type="password" id="contrasena" name="contrasena" class="letrasarriba" required />
				</p>	

				<div align ="right" class="letrasrecuperarcontrasena" >
								<a href="../php/RecuperarContra/recuperarContraseña.php">Recuperar contraseña</a>

							

				</div>
								<input class="btnfrm" type="submit"  name="btnlogin" value="Login" />
							
			</div >
			
		
	</form>

</div>
</body>
</html>









