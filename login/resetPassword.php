<?php
session_start();
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);

if (isset($_POST['correo_recuperacion']) && !empty($_POST['correo_recuperacion'])) {
    $query = "SELECT * FROM usuarios WHERE email = '$_POST[correo_recuperacion]'";
    $result = mysqli_query($con, $query);
    $numUsers = mysqli_num_rows($result);
    if ($numUsers > 0) {
        //Función para enviar un correo desde un script PHP
        $mensaje = "Hola, hemos recibido una petición para cambiar tu contraseña en City Planner.<br/>
        Puedes solicitar el cambio de contraseña pulsando en el siguiente <a href='password.php'>enlace</a><br/>
        http://localhost/Proyecto-DAW/login/password.php";
        $headers = "From: cityplanner.info@gmx.com";
        mail($_POST['correo_recuperacion'], "City Planner - Solicitud cambio contraseña", $mensaje, $headers);
        $_SESSION['correo'] = $_POST['correo_recuperacion'];
        $_SESSION['mensaje'] = "Se ha enviado un correo para cambiar la contraseña";
        //Se redirige al usuario a la página de inicio  
        header("Location: ../index.php");
    } else {
        $_SESSION['mensaje'] = "El usuario no existe. Debes de registrarte primero";
        //Se redirige al usuario a la página de registro
        header("Location: registro.php");
    }
} else {
    //En caso de que el correo esté vacio se redirige al usuario a la página de origen
    $url = $_SERVER['HTTP_REFERER'];
    header("Location: $url");
}
