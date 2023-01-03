<?php 

include("conexion.php");

$nombre = $_REQUEST['nombre'];

$sql = "DELETE FROM pelicula WHERE nombre = '$nombre'";
$result   = $conexion->query($sql);

if($result==true){
	header("Location: pelicula.php");
	}else{
	echo "<script>alert('". $conexion->error ."');</script>";
}

 ?>

