<?php
require('conexion.php');
session_start();
if(isset($_SESSION['Reg'])){
if($_SESSION['Reg']=='ok'){
$usuario = $_SESSION['nombre_usuario'];
$sql = "SELECT * FROM administrador WHERE username = '$usuario'";
$result = $conexion->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mi Perfil</title>
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
                    <h2>Mi Perfil</h2>
                    <div class="navbar-nav">
                        <form method="post" action="" class="form">
                            <label for="foto" class="icono-plus"><img src="img/portada.png" width="100" height="100" style="cursor: pointer;"></label>
                            <input type="file" name="foto" id="foto" class="form-control" required style="display: none; visibility: none;" onchange="getImage(this.value);"><br>
                            <div id="display-image" style="display: none;"></div>
                            
                            <label>Foto Perfil</label>
                            <img src="<?php echo $row['foto']; ?>" class="img-foto-perfil img-fluid"><br>

                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre'] ?>" required>
                            <br>
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" readonly>
                            <br>
                            <label for="correo">Correo</label>
                            <input type="mail" name="correo" class="form-control" value="<?php echo $row['correo'] ?>" required>
                            <br>
                            <label for="password">Contraseña</label>
                            <input type="text" name="password" class="form-control">
                            <br>
                            <a href="dashboard.php" class="nav-link btn btn-info">Dashboard</a><br>
                            <input type="submit" name="actualizar" value="Actualizar" class="btn btn-success form-control">
                            <a href="lout.php" class="nav-link btn btn-danger">Cerrar Sesion</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}else{
header("Location: perfil.php");
}
}else{
header("Location: index.php");
}
?>
<?php
if(isset($_POST['actualizar'])){
    if ($conexion->connect_errno) {
            echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
        }else{
            $imageNombre = $_FILES['foto']['name'];
            $imagen = $_FILES['foto']['tmp_name'];
            $ruta="fotosdeperfil";
            $ruta=$ruta."/".$imageNombre;
            move_uploaded_file($imagen, $ruta);
            $nombre    = $_POST['nombre'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $correo = $_POST['correo'];
            $sql = "UPDATE administrador SET foto='$ruta', nombre='$nombre', password='$password' ,correo='$correo' WHERE username = '$username'";
            $result = $conexion->query($sql);
if($result==true){
echo "<script>
alert('Información actualizada correctamente.');
window.location.href = window.location.href;
</script>";
}else{
echo "<script>
alert('Información no actualizada".$conexion->error."');
</script>";
}
mysqli_close($conexion);
}
}
?>