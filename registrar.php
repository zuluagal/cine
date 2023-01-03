<?php
require('conexion.php');
session_start();

if(isset($_SESSION['Reg'])){
if($_SESSION['Reg']=='ok'){
    echo '<script>window.location="dashboard.php"</script>';
    }}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registrar</title>
        <link rel="icon" type="image/png" href="img/logo.svg">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <!-- ICONOS FONTAW -->
        <script src="https://kit.fontawesome.com/f6f7ead16d.js" crossorigin="anonymous"></script>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <script src="partials/funciones.js"></script>
    </head>
    <body>
        <div class="w">
            <header>
                <?php
                require_once('partials/cab.php');
                ?>
            </header>
            <div class="container">
                <div class="col-sm-6 col-md-5 col-lg-6 container-fluid">
                    <h2>Crear Usuario</h2>
                    <form method="post" action="" class="form">
                        <input type="text" name="nombre" placeholder="Digita tu nombre" class="form-control" required><br>
                        <input type="text" name="username" placeholder="Digita tu nombre de usuario" class="form-control" required><br>
                        <input type="password" name="password" placeholder="Digita tu contaseña" class="form-control" required><br>
                        <input type="mail" name="email" placeholder="Digita tu correo" class="form-control" required><br>
                        <input type="submit" name="registrar" class="btn btn-success form-control" value="Registrarse"><br>
                        <br>
                        <div>
                            <a href="index.php">O Iniciar Sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
if(isset($_POST['registrar'])){
if ($conexion->connect_errno) {
echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
}else{
$nombre = $_POST['nombre'];
$username = $_POST['username'];
//$password = password_hash($_POST['password'], PASSWORD_DEFAULT, array("cost"=>12));
$password = $_POST['password'];
$email = $_POST['email'];
$sql      = "INSERT INTO administrador (nombre, username, password, correo, tipousuario) ".
"VALUES ('$nombre', '$username', '$password', '$email', 2)";
$result = $conexion->query($sql);
if($result==true){
echo "<script>
        alert('El usuario fue creado exitosamente.');
        window.location='index.php'
     </script>";
}else{
echo"<p style='text-align: center; font-size: 20px; color: #dc3545;'>Error al crear el usuario. </p>".$conexion->error;
}
}
mysqli_close($conexion);
}
?>