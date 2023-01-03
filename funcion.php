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
		<title>Crear Funcion</title>
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
				<?php include ('partials/nav.php');?>
			</header>
			<div class="container">
				<div class="col-sm-6 col-md-5 col-lg-6 container-fluid">
					<?php
					echo "<p style='color: red; ;'>Bienvenido(a) : <b>"//.$_SESSION['nombre']."</b> </p>";
					?>
					<h2>Crea una función</h2>
					<form action="" method="post" class="form">
						<label>Codigo Funcion</label>
						<input type="text" name="codigo" placeholder="Codigo de la funcion" class="form-control" required><br>
						<label>Fecha</label>
						<input type="date" name="fecha" class="form-control" required><br>
						<label>Hora</label>
						<input type="time" name="hora" class="form-control" required><br>
						<label>Codigo Pelicula</label>
						<select class="form-select" name="codigopelicula" aria-label="Default select example" required>
							<option value="0">Codigo de la Pelicula</option>
							<?php
							include("conexion.php");
								$codigopeliculas = "SELECT * FROM pelicula";
								$result = mysqli_query($conexion,$codigopeliculas);
								while ($list = mysqli_fetch_array($result)) {
							echo '<option value="'.$list['codigo'].'">'.$list['codigo'].'</option>';
								}
							?>
						</select>
						<br>
						<label>Codigo Sala</label>
						<select class="form-select" name="codigosala" aria-label="Default select example" required>
							<option value="0">Codigo de la Sala</option>
							<?php
							include("conexion.php");
								$codigosalas = "SELECT * FROM sala";
								$result = mysqli_query($conexion,$codigosalas);
								while ($list = mysqli_fetch_array($result)) {
							echo '<option value="'.$list['codigo'].'">'.$list['codigo'].'</option>';
								}
							?>
						</select>
						<br>
						<input type="submit" class="btn btn-success form-control" name="Crear" value="Crear Funcion"><br>
						<br>
					</form>
					<form method="post">
						<input type="submit" name="listar" class="btn btn-info form-control" value="Listar Funciones">
					</form>
					<br>
					<?php
					if(isset($_POST["listar"])){
						$sql  = 'SELECT f.codigo, f.fecha, f.hora, codigopelicula, codigosala FROM funcion f
									INNER JOIN pelicula p ON f.codigopelicula = p.codigo
									INNER JOIN sala s ON f.codigosala = s.codigo';
						$result   = $conexion->query($sql);
						while ($fil = $result->fetch_assoc()){
										
					?>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Codigo</th>
								<th scope="col">Fecha</th>
								<th scope="col">Hora</th>
								<th scope="col">Codigo Pelicula</th>
								<th scope="col">Codigo Sala</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row"><?php echo $fil['codigo'];	?></th>
								<td><?php echo $fil['fecha'];	?></td>
								<td><?php echo $fil['hora'];	?></td>
								<td><?php echo $fil['codigopelicula'];	?></td>
								<td><?php echo $fil['codigosala'];	?></td>
								<td>
									<form action="<?php 	echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
										<input type="hidden" name="codigo" value="<?php echo $fil['codigo']; ?>">
										<button type="Submit" name="eliminar">Eliminar</button>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
					<?php
					}if (mysqli_num_rows($result) == 0) {
					echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>No se han encontrado funciones.</p>".$conexion->error;
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
		if(!empty($_POST['codigo']) || !empty($_POST['fecha']) || !empty($_POST['hora']) || !empty($_POST['codigopelicula']) || !empty($_POST['codigosala'])){
			$codigo = $_POST['codigo'];
			$fecha = $_POST['fecha'];
			$hora = $_POST['hora'];
			$codigopelicula = $_POST['codigopelicula'];
			$codigosala = $_POST['codigosala'];
			$sql      = "INSERT INTO funcion (codigo, fecha, hora, codigopelicula, codigosala) ".
				"VALUES ('$codigo', '$fecha', '$hora', '$codigopelicula', '$codigosala')";
			$result = $conexion->query($sql);
			if($result==true){
echo "<script>
alert('La funcion fue creada exitosamente');
</script>";
}	
}else{
echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>Error al crear la funcion. </p>".$conexion->error;
}
}
mysqli_close($conexion);
}
?>


<?php
if (isset($_POST['eliminar'])) { // si presionamos en boton eliminar
$eliminar_confirmacion = true;
$cod_reg = $_POST['codigo'];
$cod_eli = $conexion -> query('SELECT codigopelicula FROM funcion'); // hacemos la consulta
foreach ($cod_eli as $cod) { // recorremos el array
	if ($cod['codigopelicula'] == $cod_reg) {
	$eliminar_confirmacion = false; // verificamos que el registro no este siendo utilizado en otra tabla
	}
}

if ($eliminar_confirmacion) { // si no esta siendo utilizado, eliminamos el registro
	$eliminar = $conexion -> query("DELETE FROM funcion WHERE codigo = '$cod_reg'");
	echo "<script>
		alert('La funcion fue eliminada exitosamente.');
		</script>";
} else { // caso contrario mandamos error
echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>Error al eliminar la funcion. </p>".$conexion->error;
}
}
?>