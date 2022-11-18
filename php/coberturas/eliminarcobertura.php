
<?php
include ('../conexion.php');


$idcobertura = $_GET['idcobertura'];


$sql = "UPDATE cobertura SET idstatus='2' WHERE idcobertura='$idcobertura'";
$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Cobertura eliminada exitosamente"); window.location="menucobertura.php" </script> ';
   
}else{
    echo '<script>alert("Intentalo de nuevo, cobertura no eliminada");window.location="menucobertura.php"</script>  ';
    
}



?>