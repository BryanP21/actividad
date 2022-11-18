
<?php
include ('../conexion.php');


$idtamano = $_GET['idtamano'];


$sql = "UPDATE tamano SET idstatus='2' WHERE idtamano='$idtamano'";
$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Tamaño eliminado exitosamente"); window.location="menutamano.php" </script> ';
   
}else{
    echo '<script>alert("Intentalo de nuevo, tamaño no eliminado");window.location="menutamano.php"</script>  ';
    
}



?>