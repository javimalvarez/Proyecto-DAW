<?php
session_start();
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
if(isset($_POST['pass']) && isset($_POST['pass2']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && isset($pass) && isset($pass2) && $pass==$pass2){
    //Se pasa el patrón de comparación y se comprueba con la información recuperada del JSON
    if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[\w\W]{8,}$/', $pass)){
        $result=mysqli_query($con,"SELECT * FROM usuarios WHERE email = '$_SESSION[correo]'");
        $numUser = mysqli_fetch_array($result);
        if($numUser == 0){
            echo "<div>No se encuentra el usuario</div>";
        }
        else{
            //Contraseña hasheada
            $hashPass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
            $query="UPDATE usuarios SET contraseña = '$hashPass' WHERE email = '$_SESSION[correo]'";/*Se actualiza la contraseña en la base de datos*/
            mysqli_query($con,$query);
            mysqli_close($con);
            $_SESSION['mensaje'] = "Contraseña cambiada";
            header("Location: index.php");//Se redirige a la página de inicio
        }
    }else{
        echo "<div>La contraseña no cumple con los requisitos especificados</div>";
    }
}
else{
    //Se envia la información con los campos vacios
    if(empty($_POST['pass']) || empty($_POST['pass2'])){
        echo "<div>Debes rellenar todos los campos</div>";
    }
    //Las contraseñas no coinciden
    else if($_POST['pass']!=$_POST['pass2']){
        echo "<div>Las contraseñas no coinciden</div>";
    }
}
?>