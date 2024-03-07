<?php
session_start();
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
if (isset($_SESSION['nombre']) && isset($_SESSION['apellidos']) && isset($_SESSION['correo']) && isset($_SESSION['password'])) {
    $query = "INSERT INTO usuarios (nombre, apellidos, email, contraseña, tipo) VALUES ('$_SESSION[nombre]','$_SESSION[apellidos]','$_SESSION[correo]','$_SESSION[password]',1)";
    mysqli_query($con, $query);
    mysqli_close($con);
    $_SESSION['mensaje'] = "Bienvenid@ $_SESSION[nombre]! Te has dado de alta correctamente";
    header("Location: ../index.php");
}
