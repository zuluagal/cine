<?php
session_start();
if(isset($_SESSION['Reg'])){
if($_SESSION['Reg']=='ok'){
require('conexion.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Crear Pelicula</title>
		<link rel="icon" type="image/png" href="img/logo.svg">
		<!-- Bootstrap -->        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/f6f7ead16d.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<script src="partials/funciones.js"></script>
	</head>
	<body>
		<div class="w">
			<header>
				<?php
      				 require_once('partials/nav.php');
        		?>
			</header>
			<div class="container">
				<div class="col-sm-6 col-md-5 col-lg-6 container-fluid">
                    <h2>Crea una pelicula</h2>
					<form action="" method="post" enctype="multipart/form-data" class="form">
						<label>Portada</label>
						<label for="portada" class="icono-plus"><img src="img/portada.png" width="100" height="100" style="cursor: pointer;"></label>
						<input type="file" name="portada" id="portada" class="form-control" style="display: none; visibility: none;" onchange="getImage(this.value);"><br>
						<div id="display-image" style="display: none;"></div>
						
						<!--<input type="file" name="imagen" id="imagen" required /><br>-->
						<label>Nombre Pelicula</label>
						<input type="text" name="nombre" placeholder="Nombre de la pelicula" class="form-control" required><br>
						<label>Codigo Pelicula</label>
						<input type="text" name="codigo" placeholder="Codigo de la pelicula" class="form-control" required><br>
						<label>Clasificacion Pelicula</label>
						<select class="form-select" name="clasificacion" aria-label="Default select example" required>
							<option value="0">Selecciona Clasificacion</option>
							<?php
							include("conexion.php");
								$clasificaciones = "SELECT * FROM clasificacion";
								$result = mysqli_query($conexion,$clasificaciones);
								while ($list = mysqli_fetch_array($result)) {
								echo '<option value="'.$list['id_clasificacion'].'">'.$list['nombre_clasificacion'].'</option>';
								}
							?>
						</select>
						<br>
						<input type="submit" class="btn btn-success form-control" name="Crear" value="Crear Pelicula"><br>
						<br>
					</form>
					<form method="post">
						<input type="submit" name="listar" class="btn btn-info form-control" value="Listar Peliculas">
					</form>
					<br>
					<?php
					if(isset($_POST["listar"])){
						//$sql      = 'SELECT * FROM pelicula';
						$sql  = 'SELECT * FROM pelicula p
									INNER JOIN clasificacion c ON p.id_clasificacion = c.id_clasificacion';
						$result   = $conexion->query($sql);
						while ($fil = $result->fetch_assoc()){
										
					?>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Portada</th>
								<th scope="col">Nombre</th>
								<th scope="col">Codigo</th>
								<th scope="col">Clasificacion</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><img src="<?php echo $fil['portada']; ?>" class="img-portada-pelicula img-fluid"></td>
								<th scope="row"><?php echo $fil['nombre'];	?></th>
								<td><?php echo $fil['codigo'];	?></td>
								<td><?php echo $fil['nombre_clasificacion']; ?></td>
								<td><a href="eliminar.php?nombre=<?php echo $fil['nombre']; ?>" class="btn btn-danger">Eliminar</a></td>
							</tr>
						</tbody>
					</table>
					<?php
					}if (mysqli_num_rows($result) == 0) {
					echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>No se han encontrado peliculas.</p>".$conexion->error;
						}
					mysqli_close($conexion);
					}
					?>
				</div>
			</div>
			<footer>
				
			</footer>
		</div>
	</body>
</html>
<?php
}else{
header("Location: index.php");
}
}else{
header("Location: index.php");
}
?>
<?php
if(isset($_POST['Crear'])){
	if ($conexion->connect_errno) {
			echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
		}else{
			//$portada = addslashes(file_get_contents($_FILES['portada']['tmp_name']));
			$imageNombre = $_FILES['portada']['name'];
			$imagen = $_FILES['portada']['tmp_name'];
			$ruta="portadas";
			$ruta=$ruta."/".$imageNombre;
			move_uploaded_file($imagen, $ruta);
        	//$imagen = addslashes(file_get_contents($image));
			$nombre = $_POST['nombre'];
			$codigo = $_POST['codigo'];
			$clasificacion = $_POST['clasificacion'];
			$sql      = "INSERT INTO pelicula (portada, nombre, codigo, id_clasificacion) ".
				"VALUES ('$ruta', '$nombre', '$codigo', '$clasificacion')";
			$result = $conexion->query($sql);
			if($result==true){
				echo "<script>
        				alert('La pelicula fue creada exitosamente');
     				</script>";
			}else{
				echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>Error al crear la pelicula. </p>".$conexion->error;
			}
		}
	mysqli_close($conexion);
}
?>


<!--no sirve-->
<?php 	
if(isset($_POST['eliminar'])){
	if ($conexion->connect_errno) {
			echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
		}else{
$nombre = $_REQUEST['nombre'];

$sql = "DELETE FROM pelicula WHERE nombre = '$nombre'";
$result   = $conexion->query($sql);

if($result==true){
	echo"<p style='text-align: center; font-size: 20px; color: #198754;'>La pelicula se elimino exitosamente.</p>";
	}else{
	echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>Error al eliminar la pelicula. </p>".$conexion->error;
}
}
mysqli_close($conexion);
}

 ?>