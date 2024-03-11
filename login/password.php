<?php
session_start();
//Se limita el acceso a usuarios registrados y que hayan pedido un cambio de contraseña
if (!isset($_SESSION['correo'])) {
    header("Location: ../index.php");
}
require("../database/datos.php");
echo"<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<p>La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número</p>
<label for='pass'>Contraseña:</label>
<input type='password' name='pass' id='pass'><br/>
<label for='pass2'>Confirmar contraseña:</label>
<input type='password' name='pass2' id='pass2'><br/>
<input type='submit' value='Cambiar contraseña'></form>";
$con=mysqli_connect($host,$user,$pass,$db_name);

/*Se valida que la contraseña enviada por el usuario cumpla con los requisitos establecidos de seguridad*/
/*?=.*[A-Z] debe incluir al menos una mayúscula
?=.*[a-z] debe incluir al menos una minúscula
?=.*[0-9] de incluir al menos un número
[\w\W] se permite carácteres alfanuméricos y carácteres especiales
{8,} longitud mínima de 8 carácteres*/
if(isset($_POST['pass']) && isset($_POST['pass2']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && $_POST['pass']==$_POST['pass2']){
    //Se pasa el patrón de comparación y se comprueba con la información recuperada del JSON
    if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[\w\W]{8,}$/', $_POST['pass'])){
        $result=mysqli_query($con,"SELECT * FROM usuarios WHERE email = '$_SESSION[correo]'");
        $numUser = mysqli_fetch_array($result);
        
           $hashPass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
            $query="UPDATE usuarios SET contraseña = '$hashPass' WHERE email = '$_SESSION[correo]'";/*Se actualiza la contraseña en la base de datos*/
            mysqli_query($con,$query);
            echo"<script>alert('La contraseña ha sido cambiada');</script>";
            //Una vez se utilice el enlace expira eliminando la variable de sesión
            unset( $_SESSION['correo']);
            header("refresh:0 url=../index.php");//Se redirige a la página de inicio
        
    }else{
        echo "<script>alert('La contraseña no cumple con los requisitos especificados');</script>";
    }
}
else{
    if($_SERVER['REQUEST_METHOD']==='POST'){
        //Se envia la información con los campos vacios
        if(empty($_POST['pass']) || empty($_POST['pass2'])){
            echo "<script>alert('Hay campos vacios en el formulario');</script>";
        }
        //Las contraseñas no coinciden
        else if($_POST['pass']!=$_POST['pass2']){
            echo "<script>alert('La contraseña y su confirmación no coinciden');</script>";
        }
    }
}
?>