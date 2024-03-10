<?php
session_start();
require("../database/datos.php");
$con=mysqli_connect($host,$user,$pass,$db_name);

if (isset($_POST['correo_recuperacion'])&&!empty($_POST['correo_recuperacion'])){
    $query="SELECT * FROM usuarios WHERE email = '$_POST[correo_recuperacion]'";
    $result=mysqli_query($con,$query);
    $numUsers = mysqli_num_rows($result);
    if ( $numUsers > 0){
        //Función para enviar un correo desde un script PHP
        $mensaje="Hola, hemos recibido una petición para cambiar tu contraseña en Ape Planner.<br/>
        Puedes solicitar el cambio de contraseña pulsando en el siguiente <a href='password.php'>enlace</a><br/>
        http://localhost/Proyecto-Login/password.php";
        mail($_POST['correo_recuperacion'],"Ape Planner - Solicitud cambio contraseña",$mensaje);
        $_SESSION['correo'] = $_POST['correo_recuperacion'];
        $_SESSION['mensaje']="<script>alert('Se ha enviado un correo para cambiar la contraseña');</script>";
        header("Location: ../index.html");
    }
    else{
        $_SESSION['mensaje'] = "El usuario no existe";
        //Se redirige al usuario a la página de registro
        header("Location: registro.php");
    }
    
}else{
    $url=$_SERVER['HTTP_REFERER'];
    header("Location: $url");
}
?>