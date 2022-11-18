<?php
include ('../../php/conexion.php');

$idtamano = null;
$descripcion = $_POST["descripcion"];




$query = "INSERT INTO tamano(idtamano,descripcion,idstatus)
             VALUES ('$idtamano','$descripcion', '1')";




$verificar_descripcion = mysqli_query($link,"SELECT * FROM tamano WHERE descripcion='$descripcion' ");
		
if(mysqli_num_rows($verificar_descripcion) > 0){
    
    echo '<script>alert("Este tamaño ya está registrado, registra uno nuevo"); window.location="menutamano.php" </script>';

          exit();
}

$ejecutar = mysqli_query($link, $query);


if($ejecutar){
    echo '<script>alert("Tamaño almacenado exitosamente"); window.location="menutamano.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, tamaño no almacenado");window.location="menuctamano.php"</script>  ';
    
}

  

?>