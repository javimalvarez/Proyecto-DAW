<?php
session_start();
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
if (isset($_POST['correo']) && isset($_POST['pass'])&&!empty($_POST['correo'])&&!empty($_POST['pass'])) {
    $query = "SELECT password FROM usuarios WHERE email = '".$_POST['correo']."'";
    $result = mysqli_query($con, $query);
    //Comprueba si hay algun usuario registrado con esos datos en la base de datos
    $numUsers = mysqli_num_rows($result);
    //Se recupera contraseña desde la base de datos
    $password = mysqli_fetch_array($result);
    //Se hashea la contraseña de la ventana de login
    $loginPassword=password_hash($_POST['pass'],PASSWORD_DEFAULT);
    if ($numUsers > 0&&$loginPassword == $password) {
        //Debe aparecer el usuario logado
    } else {
        //Se muestra al usuario el error de inicio sesión
        if ($numUsers == 0) {
            header("Location:login/registro.php");
            $_SESSION['mensaje'] = "Usuario no registrado";
        } else if ($loginPassword != $password) {
            $_SESSION['mensaje'] = "Contraseña incorrecta";
            //Se redirige al usuario a la página de cambio de contraseña
            header("Location: USuarioRegistrado/registro.php");
        }
    }
}else if(empty($_POST['correo'])||empty($_POST['pass'])){
    $_SESSION['mensaje'] = "Campos vacios";
    //Se determina la página origen desde donde se llama al script
    $url=$_SERVER['HTTP_REFERER'];
    header("Location: $url");
    
}
