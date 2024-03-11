<link rel="stylesheet" type="text/css" href="../css/styleNavbar.css">
<link rel="stylesheet" type="text/css" href="../css/styleRegistro.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
//En el caso de login se guardará el usuario en una variable de sesión
session_start();
require_once("../database/datos.php");
$con=mysqli_connect($host,$user,$pass,$db_name);
//Formulario entrada de datos y login
echo"<nav class='navbar bg-body-tertiary'>
    <div class='container-fluid'>
        <a class='navbar-brand' href='../index.php'>
            <img src='../img/LogoSinFondo.png' alt='Logo' width='100' height='' class='d-inline-block align-text-top'></a>
    </div>
</nav>
<div class='card text-center'>
    <div class='card-header'>
        <ul class='nav nav-tabs card-header-tabs'>
            <li class='nav-item'>
                <a class='nav-link active' href='#' onclick=\"showContent('Registro')\">Crear una cuenta</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='#' onclick=\"showContent('Login')\">Ya tengo una cuenta </a>
            </li>
        </ul>
    </div>
    <div class='card-body'>
        <div id='Registro' style='display: block;'>


            <!-- Contenido para el enlace Active -->
            <form class='row' action='" . $_SERVER['PHP_SELF'] . "' method='post'>
                <div class='col-md-7'>
                    <div class='form-group row'>
                        <label class='col-md-3 col-form-label text-md-right'>Nombre:</label>
                        <div class='col-md-8'>
                            <input type='text' name='nombre' id='nombre'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label class='col-md-3 col-form-label text-md-right'>Apellidos:</label>
                        <div class='col-md-8'>
                            <input type='text' name='apellidos' id='apellidos'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label class='col-md-3 col-form-label text-md-right'>Correo electrónico:</label>
                        <div class='col-md-8'>
                            <input type='email' name='correo' id='correo'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label class='col-md-3 col-form-label text-md-right'>Contraseña:</label>
                        <div class='col-md-8'>
                            <input type='password' name='pass' id='pass'>
                        </div>
                        <div class='col-md-8 offset-md-3'style='text-align:left'>
                            <details>
                                <summary>Información importante:</summary>
                                <p>Para que la contraseña sea valida; la contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número<br/>*Se permiten caracteres especiales</p>
                            </details>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label class='col-md-3 col-form-label text-md-right'>Repite la contraseña:</label>
                        <div class='col-md-8'>
                            <input type='password' name='pass2' id='pass2'>
                        </div>
                    </div>

                    <div class='form-group row'>
                        <div class='col-md-8 offset-md-3'>
                            <div class='form-check'>
                                <input class='form-check-input' type='checkbox' id='confirmar' name='confirmar' value='1'>
                                <label class='form-check-label' for='confirmar'>
                                    Quiero poder gestionar alta de eventos
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-8 offset-md-3'>
                        <input type='submit' class='botonRegistro' name='altaUsuario' id='altaUsuario' value='Regístrate'></input>
                    </div>

                </div>
                <div class='hidden-xs hidden-sm col-md-5'>
                    <p>Regístrate desde aquí. Al registrarte confirmas que has leído y aceptas la <a href='../condiciones.html'>Política de Privacidad y los Términos y condiciones de cityplanner.com</a></p>
                </div>
            </form>
        </div>";
        
    
        //Garantiza que las comprobaciones se realicen solo si se envía el formulario
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $query="SELECT * FROM usuarios WHERE email = '" . $_POST['correo'] . "'";
        $result = mysqli_query($con, $query);
        $numUsers = mysqli_num_rows($result);
            if (empty($_POST['nombre'])|| empty($_POST['apellidos'])|| empty($_POST['correo'])||empty($_POST['pass'])||empty($_POST['pass2'])) {
                echo "<script>alert('Hay campos vacios en el formulario')</script>";
            }
            else {
                $_SESSION['nombre'] = $_POST['nombre'];
                $_SESSION['apellidos'] = $_POST['apellidos'];
                $_SESSION['correo']=$_POST['correo'];
                if($numUsers==0){
                    if($_POST['pass']==$_POST['pass2']){
                        /*Se valida que la contraseña enviada por el usuario cumpla con los requisitos establecidos de seguridad*/
                        /*?=.*[A-Z] debe incluir al menos una mayúscula
                        ?=.*[a-z] debe incluir al menos una minúscula
                        ?=.*[0-9] de incluir al menos un número
                        [\w\W] se permite carácteres alfanuméricos y carácteres especiales
                        {8,} longitud mínima de 8 carácteres*/
                        if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[\w\W]{8,}$/', $_POST['pass'])){
                            $mensaje="Hola, hemos recibido una petición de registro en City Planner.<br/>
                            Para confirmar el registro pulsa en el siguiente <a href='http:.//localhost/Proyecto-DAW/confirmar.php'>enlace</a><br/>
                            http://localhost/Proyecto-DAW/login/confirmar.php
                            Si la petición no la has realizado tu, omite este correo.<br/><br/>
                            Un saludo del equipo de City Planner.";
                            $headers = "From: cityplanner.info@gmx.com";
                            mail($_POST['correo'],"City Planner - Solicitud registro",$mensaje,$headers);
                            //Se almacena la contraseña hasheada en la base de datos
                            $_SESSION['password'] = password_hash($_POST['pass'],PASSWORD_DEFAULT);
                            echo "<script>alert('Te hemos enviado correo que debes confirmar para finalizar el registro')</script>";
                        }
                        else{
                            echo "<script>alert('La contraseña no cumple con los requisitos especificados')</script>";
                        }
                        
                    }
                    else if($_POST['pass']==$_POST['pass2']&&isset($_POST['confirmar'])&&isset($_POST['confirmar'])&&$_POST['confirmar']=='1'){
                        /*Se valida que la contraseña enviada por el usuario cumpla con los requisitos establecidos de seguridad*/
                        /*?=.*[A-Z] debe incluir al menos una mayúscula
                        ?=.*[a-z] debe incluir al menos una minúscula
                        ?=.*[0-9] de incluir al menos un número
                        [\w\W] se permite carácteres alfanuméricos y carácteres especiales
                        {8,} longitud mínima de 8 carácteres*/
                        if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[\w\W]{8,}$/', $_POST['pass'])){
                            $mensaje="Hola, hemos recibido una petición de registro en City Planner.<br/>
                            Para confirmar el registro pulsa en el siguiente <a href='http:.//localhost/Proyecto-DAW/confirmar.php'>enlace</a><br/>
                            http://localhost/Proyecto-DAW/login/confirmar.php
                            Si la petición no la has realizado tu, omite este correo.<br/><br/>
                            Un saludo del equipo de City Planner.";
                            $headers = "From: cityplanner.info@gmx.com";
                            mail($_POST['correo'],"City Planner - Solicitud registro",$mensaje,$headers);
                            //Se almacena la contraseña hasheada en la base de datos
                            $_SESSION['password'] = password_hash($_POST['pass'],PASSWORD_DEFAULT);
                            $_SESSION['confirmar']=$_POST['confirmar'];
                            echo "<script>alert('Te hemos enviado correo que debes confirmar para finalizar el registro')</script>";
                        }
                        else{
                            echo "<script>alert('La contraseña no cumple con los requisitos especificados')</script>";
                        }
                        
                    }
                    else{
                        echo "<script>alert('La contraseña y su confirmación no coinciden')</script>";
                    }
                }else{
                    echo "<script>alert('El correo ya existe')</script>";
                    header("Location: ../index.php");
                }                  
            }
        }
      
        
        
        echo "<div id='Login' style='display: none;'>
            <!-- Contenido para el enlace Link -->
            <form class='row' action='login.php' method='post'>
                <div class='col-md-7'>
                    <div class='form-group row'>
                        <label for='correo' class='col-md-3 col-form-label text-md-right'>Correo:</label>
                        <div class='col-md-8'>
                            <input type='email' class='form-control' id='correo' name='correo'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='pass' class='col-md-3 col-form-label text-md-right'>Contraseña:</label>
                        <div class='col-md-8'>
                            <input type='password' class='form-control' id='pass' name='pass'>
                        </div>
                    </div>
                    <div class='col-md-8 offset-md-3'>
                        <input type='submit' class='btn btn-primary botonRegistro' value='Acceder'>
                    </div>
                </div>
                <div class='hidden-xs hidden-sm col-md-5'>
                    <p>Inicia sesión y accede a tu área de usuario donde podrás  modificar tus datos de registro. Al iniciar sesión confirmas que has leído y aceptas la <a href='../condiciones.html'>Política de Privacidad y los Términos y condiciones de cityplanner.com</a></p>
                </div>
            </form>
            <div class='col-md-7'>
                <details>
                <summary style='text-align: left;'>¿Has olvidado tu contraseña?</summary>
                    <div class='form-group row'>
                        <form class='row' action='resetPassword.php' method='post'>
                            <p style='text-align: left;'>Por favor indica tu correo y te enviaremos una nueva contraseña</p>
                            <label for='correo_recuperacion' class='col-md-3 col-form-label text-md-right'>Dirección de correo:</label>
                            <div class='col-md-8'>
                                <input type='email' class='form-control' id='correo_recuperacion' name='correo_recuperacion'>
                            </div>
                            <div class='col-md-8 offset-md-3'>
                                <input type='submit' class='btn btn-primary botonRegistro' value='Solicitar nueva contraseña'>
                            </div>                      
                        </form>
                    </div>
                </details>
            </div>
        </div>
    </div>";
    if (isset($_POST['btnReset'])){
        echo "<script> 
        document.getElementById('btnLogin').disabled = true;
         </script>";
    }
echo"</div>";
?>
<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>";