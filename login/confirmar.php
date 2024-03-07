<?php
session_start();
require("../datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
if (isset($_SESSION['nombre'])&&isset($_SESSION['apellido'])&&isset($_SESSION['correo'])&&isset($_SESSION['password'])){
    $query="INSERT INTO usuarios (nombre, apellido, email, contraseña) VALUES ('$_SESSION[nombre]','$_SESSION[apellido]','$_SESSION[correo]','$_SESSION[password]')";
    mysqli_query($con,$query);
    mysqli_close($con);
    header("Location: ../index.php");
    $_SESSION['mensaje'] = "Bienvenido. Usuario dado de alta correctamente";
}
?>