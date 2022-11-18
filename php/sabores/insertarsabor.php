<?php
include ('../../php/conexion.php');

$idsabor = null;
$descripcion = $_POST["descripcion"];




$query = "INSERT INTO sabor(idsabor,descripcion,idstatus)
             VALUES ('$idsabor','$descripcion', '1')";




$verificar_descripcion = mysqli_query($link,"SELECT * FROM sabor WHERE descripcion='$descripcion' ");
		
if(mysqli_num_rows($verificar_descripcion) > 0){
    
    echo '<script>alert("Este sabor ya está registrado, registra uno nuevo"); window.location="menusabor.php" </script>';

          exit();
}

$ejecutar = mysqli_query($link, $query);


if($ejecutar){
    echo '<script>alert("Sabor almacenado exitosamente"); window.location="menusabor.php" </script> ';

}else{
    echo '<script>alert("Intentalo de nuevo, tamaño no almacenado");window.location="menusabor.php"</script>  ';
    
}

  

?>