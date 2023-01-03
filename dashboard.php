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
        <title>Dashboard</title>
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
                    <p class="msj-bienvenida">Bienvenido(a)<b><a href="perfil.php"><?php echo " ".$row['nombre']; ?></a></b></p>
                            <h2>Menu De Opciones</h2>
                            <div class="navbar-nav">
                                <ul class="ul-menu-op">
                                    <li><a href="#"><?php $row['tipousuario']; ?></a></li>
                                    <li><a href="pelicula.php" class="nav-link btn btn-primary">Crear Pelicula</a></li>
                                    <li><a href="sala.php" class="nav-link btn btn-primary">Crear Sala</a></li>
                                    <li><a href="funcion.php" class="nav-link btn btn-primary">Crear Funcion</a></li>
                                    <?php if ($row['tipousuario'] == 1) {
                                        echo '<form method="post" action="" class="form"><li><input type="submit" name="listar" class="nav-link btn btn-primary form-control" value="Listar"></li></form>';
                                    } ?>
                                    <li><a href="lout.php" class="nav-link btn btn-danger">Cerrar Sesion</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
        if(isset($_POST["listar"])){
        $sql      = 'SELECT nombre, username, correo FROM administrador';
        $result   = $conexion->query($sql);
        while ($fil = $result->fetch_assoc()){
        ?>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Username</th>
                    <th scope="col">Correo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $fil['nombre'];  ?></th>
                    <td><?php echo $fil['username'];  ?></td>
                    <td><?php echo $fil['correo'];   ?></td>
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