<?php
include ('../../php/conexion.php');

$idcobertura = null;
$descripcion = $_POST["descripcion"];




$query = "INSERT INTO cobertura(idcobertura,descripcion,idstatus)
             VALUES ('$idcobertura','$descripcion', '1')";




$verificar_descripcion = mysqli_query($link,"SELECT * FROM cobertura WHERE descripcion='$descripcion' ");
		
if(mysqli_num_rows($verificar_descripcion) > 0){
    
    echo '<script>alert("Este sabor ya está registrado, registra uno nuevo"); window.location="menucobertura.php" </script>';

          exit();
}

$ejecutar = mysqli_query($link, $query);


if($ejecutar){
    echo '<script>alert("Cobertura almacenada exitosamente"); window.location="menucobertura.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, cobertura no almacenada");window.location="menucobertura.php"</script>  ';
    
}

  

?>