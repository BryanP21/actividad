
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
					
	    <title>Maria's Pasteleria</title>
	    <link rel="icon" href="../../img/logos/Logos-MP-2021-02-02-06.ico">
	</head>
	<body class="fondo overflow-cancel-x">
					<!-- ====== -->
				    <!-- NAVBAR -->
				    <!-- ====== -->
		<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light border-bottom px-3 justify-content-center">
		<!-- <div class="container text-center"> -->
		  <div class="row justify-content-between flex-grow-1">
		    <div class="col-2">
			
		    </div>
		    <div class="col-2">
		       <img src="../../img/2.png" width="100%" height="90%" class="d-inline-block" alt="">
		    </div>
		    <div class="col-2">
			
		    </div>
		  </div>
		<!--</div> -->
		</nav>
					<!-- ========= -->
				    <!-- Recuperar -->
				    <!-- Contraseña-->
				    <!-- ========= -->
		<div id="contenedor">
            <div id="central" class="formrecuperar">
                <div id="login">
                    <div class="titulo contenedor-elipse">
                        Recuperar contraseña
                    </div>
                    	<br>
                    <div class="text-center">
                        <img src="../../img/look.png" width="30%" height="30%" class="d-inline-block" alt="">
                    </div>
					<br>
                    <form action="recuperarContra.php"  name="frmAutentica" method="POST" >
                    	<div class="row justify-content-center">
	                        <input type="text" name="usuario" placeholder="Usuario" required>
	                        				<div class="mt-1 mb-1"><br></div>
                        </div>
						<div class="row justify-content-center">
	                        <input type="password" name="contrasena" placeholder="Contraseña" required>
	                        				<div class="mt-1 mb-1"><br></div>
                        </div>
	                    <div class="row justify-content-end"> 

						<input  type="submit"  name="btnlogin" value="Login" 
						style="width: 100px; background-color:#2CE5C6; BORDER-LEFT-COLOR:#6B1263; 
													BORDER-BOTTOM-COLOR:#6B1263; BORDER-TOP-COLOR:#6B1263; 
													BORDER-RIGHT-COLOR:#6B1263">
								
	                    </div> 
                    </form>
                </div>
            </div>
        </div>
           
		<!-- ============================ -->
	    <!-- Bootstrap Bundle with Popper -->
	    <!-- ============================ -->
	   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	   
  </body>
</html>
