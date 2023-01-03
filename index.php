<?php

require('conexion.php');
session_start();

if(isset($_SESSION['Reg'])){
if($_SESSION['Reg']=='ok'){
    echo '<script>window.location="dashboard.php"</script>';
    }}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="Leonardo, LeonardoZvluaga, Leonardo Zuluaga, Zuluaga, Zuluaga Cine">
        <meta name="author" content="Leonardo Zuluaga Coba">
        <meta name="title" content="Zuluaga Cine">
        <title>Login</title>
        <link rel="icon" type="image/png" href="img/logo.svg">
        <!-- Bootstrap -->        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <!-- ICONOS FONTAW -->
        <script src="https://kit.fontawesome.com/f6f7ead16d.js" crossorigin="anonymous"></script>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <script src="partials/funciones.js"></script>
    </head>
    <body>
        <div class="w">
            <div class="container">
                <div class="abs-center">
                <div class="col-sm-6 col-md-5 col-lg-6">
                    <form action="" method = "post" class="form">
                        <h2>Iniciar Sesion</h2>
                        <label>Usuario</label>
                        <input type="text" name="username" class="form-control" placeholder="Ingresa tu usuario(username)" required><br>
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required><br>
                        <input type="submit" name="iniciarsesion" class="btn btn-success form-control" value="Iniciar Sesion">
                        <div>
                            <a href="registrar.php">O registrarse</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
if(isset($_POST['iniciarsesion'])){
if ($conexion->connect_errno) {
echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
}else{
$username = $_POST['username'];
$password = $_POST['password'];
$contador = 0;
$sql ="SELECT * FROM administrador WHERE username = '$username' and password = '$password'";
$result = $conexion->query($sql);
if($result->fetch_assoc()){

session_start();
$_SESSION['Reg']='ok';
$_SESSION['nombre_usuario']=$username;

echo '<script>window.location="dashboard.php"</script>';
//header('Location: /registrar.php');

}else{
$_SESSION['Reg']='fail';

echo "<script>
        alert('Usuario o Contraseña incorrecto');
        window.location='index.php'
     </script>";

}
}
mysqli_close($conexion);
}
?>