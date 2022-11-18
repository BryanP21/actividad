
<?php
include ('../conexion.php');


$idsabor = $_GET['idsabor'];


$sql = "UPDATE sabor SET idstatus='2' WHERE idsabor='$idsabor'";
$ejecutar = mysqli_query($link, $sql);


if($ejecutar){
    echo '<script>alert("Sabor eliminado exitosamente"); window.location="menusabor.php" </script> ';
   
}else{
    echo '<script>alert("Intentalo de nuevo, sabor no eliminado");window.location="menusabor.php"</script>  ';
    
}



?>