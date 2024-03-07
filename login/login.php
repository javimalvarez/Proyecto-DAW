<?php
session_start();
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
if (isset($_POST['correo']) && isset($_POST['pass']) && !empty($_POST['correo']) && !empty($_POST['pass'])) {
    $query = "SELECT contraseña FROM usuarios WHERE email = '" . $_POST['correo'] . "'";
    $result = mysqli_query($con, $query);
    //Comprueba si hay algun usuario registrado con esos datos en la base de datos
    $numUsers = mysqli_num_rows($result);
    //Se recupera contraseña desde la base de datos
    $contraseña = mysqli_fetch_array($result)['contraseña'];
    //Si el usuario cumplimenta los datos de login se realizan varias validaciones
    if ($numUsers > 0 && password_verify($_POST['pass'], $contraseña)) {
        //Se recupera el tipo de usuario mediante una consulta a la base de datos
        $query_typeUser = "SELECT email, tipo FROM usuarios WHERE email = '" . $_POST['correo'] . "'";
        $result = mysqli_query($con, $query_typeUser);
        extract(mysqli_fetch_array($result));
        $_SESSION['tipoUsuario'] = $tipo;
        $_SESSION['usuario'] = $email;
        if ($_SESSION['tipoUsuario'] == 0 ) {
            //Se redirige al usuario al panel de administrador
        } else if ($_SESSION['tipoUsuario'] == 1) {
            //Se mostrará la página del perfil de usuario
        }
    } else if ($numUsers == 0) {
        //Caso donde no existe el usuario en la base de datos
        $_SESSION['mensaje'] = "Usuario no registrado. Debes registrarte";
        header("Location:registro.php");
    } else if (password_verify($_POST['pass'], $contraseña) == false) {
        //Caso donde la contraseña no coincide
        $_SESSION['mensaje'] = "Contraseña incorrecta";
        //Se redirige al usuario a la página de inicio donde puede cambiar la contraseña
        header("Location:../index.php");
    }
} else if (empty($_POST['correo']) || empty($_POST['pass'])) {
    $_SESSION['mensaje'] = "Hay campos vacios en el formulario";
    //Se determina la página origen desde donde se llama al script
    $url = $_SERVER['HTTP_REFERER'];
    header("Location: $url");
}
