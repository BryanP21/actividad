
<?php
include ('../conexion.php');


$idrelleno = $_GET['idrelleno'];


$sql = "UPDATE relleno SET idstatus='2' WHERE idrelleno='$idrelleno'";
$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Relleno eliminado exitosamente"); window.location="menurelleno.php" </script> ';
   
}else{
    echo '<script>alert("Intentalo de nuevo, relleno no eliminado");window.location="menurelleno.php"</script>  ';
    
}



?>