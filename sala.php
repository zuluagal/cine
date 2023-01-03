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
		<title>Crear Sala</title>
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
                    <h2>Crea una Sala</h2>
					<form action="" method="post" class="form">
						<label>Nombre Sala</label>
						<input type="text" name="nombre" placeholder="Nombre de la sala" class="form-control" required><br>
						<label>Codigo Sala</label>
						<input type="text" name="codigo" placeholder="Codigo de la sala" class="form-control" required><br>
						<label>Capacidad Sala</label>
						<input type="number" min="10" max="50" name="capacidad" placeholder="Cantidad de personas" class="form-control" required>
						<p class="monto-minimo">Capacidad minima: 10 - Capacidad maxima: 50</p>
						<br>
						<input type="submit" class="btn btn-success form-control" name="Crear" value="Crear Sala"><br>
						<br>
					</form>
					<form method="post">
						<input type="submit" name="listar" class="btn btn-info form-control" value="Listar Salas">
					</form>
					<br>
					<?php
					if(isset($_POST["listar"])){
						$sql      = 'SELECT * FROM sala';
						$result   = $conexion->query($sql);
						while ($fil = $result->fetch_assoc()){
										
					?>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Codigo</th>
								<th scope="col">Capacidad</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row"><?php echo $fil['nombre'];	?></th>
								<td><?php echo $fil['codigo'];	?></td>
								<td><?php echo $fil['capacidad'];	?></td>
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
					echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>No se han encontrado datos.</p>".$conexion->error;
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
header("Location: login.php");
}
}else{
header("Location: login.php");
}
?>

<?php
if(isset($_POST['Crear'])){
	if ($conexion->connect_errno) {
			echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
		}else{
			$nombre = $_POST['nombre'];
			$codigo = $_POST['codigo'];
			$capacidad = $_POST['capacidad'];
			$sql      = "INSERT INTO sala (nombre, codigo, capacidad) ".
				"VALUES ('$nombre', '$codigo', '$capacidad')";
			$result = $conexion->query($sql);
			if($result==true){
				echo "<script>
        				alert('La sala fue creada');
     				</script>";
			}else{
				echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>Error al crear la sala. </p>".$conexion->error;
			}
		}
	mysqli_close($conexion);
}
?>



<?php
if (isset($_POST['eliminar'])) { // si presionamos en boton eliminar
$eliminar_confirmacion = true;
$cod_reg = $_POST['codigo'];
$cod_eli = $conexion -> query('SELECT codigosala FROM funcion'); // hacemos la consulta
foreach ($cod_eli as $cod) { // recorremos el array
	if ($cod['codigosala'] == $cod_reg) {
	$eliminar_confirmacion = false; // verificamos que el registro no este siendo utilizado en otra tabla
	}
}

if ($eliminar_confirmacion) { // si no esta siendo utilizado, eliminamos el registro
	$eliminar = $conexion -> query("DELETE FROM sala WHERE codigo = '$cod_reg'");
	echo "<script>
		alert('La sala fue eliminada exitosamente.');
		</script>";

}else{ // caso contrario mandamos error

	$nombre_sala = $conexion -> query("SELECT nombre FROM sala WHERE codigo = '$cod_reg'");
	foreach ($nombre_sala as $nombs) {
		
		?>
                <p class="mensaje"><b>Error:</b> La <b><?php echo $sala['nombre']; ?></b> esta asignada a una funcion, por lo tanto no se puede eliminar</p>
<?php
		
							}
	   }
}
?>