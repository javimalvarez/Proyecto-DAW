<link rel="stylesheet" type="text/css" href="../styleNavbar.css">
<link rel="stylesheet" type="text/css" href="styleRegistro.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
//En el caso de login se guardará el usuario en una variable de sesión
session_start();
require_once("../database/datos.php");
$con=mysqli_connect($host,$user,$pass,$db_name);
//Formulario entrada de datos y login
echo"<nav class='navbar bg-body-tertiary'>
    <div class='container-fluid'>
        <a class='navbar-brand' href='#'>
            <img src='../img/LogoSinFondo.png' alt='Logo' width='100' height='' class='d-inline-block align-text-top'>
            Ape Planner </a>
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
                            <input type='text' name='apellido' id='apellido'>
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
                    </div>
                    <div class='form-group row'>
                        <label class='col-md-3 col-form-label text-md-right'>Repite la contraseña:</label>
                        <div class='col-md-8'>
                            <input type='password' name='pass2' id='pass2'>
                        </div>
                    </div>
                    <div class='col-md-8 offset-md-3'>
                        <input type='submit' class='botonRegistro' name='altaUsuario' id='altaUsuario' value='Regístrate'></input>
                    </div>

                </div>
                <div class='hidden-xs hidden-sm col-md-5'>
                    <p>Inicia sesión y accede a tu área de usuario donde podrás encontrar tus entradas y modificar tus datos de registro y envío. Al iniciar sesión confirmas que has leído y aceptas la Política de Privacidad y los Términos y condiciones de apeplanner.com.</p>
                </div>
            </form>";
            
            if (isset($_POST['nombre'])&&isset($_POST['apellido'])&&isset($_POST['correo'])&&isset($_POST['pass'])&&isset($_POST['pass2'])
            && !empty($_POST['nombre'])&& !empty($_POST['apellido'])&& !empty($_POST['correo'])&& !empty($_POST['pass'])&& !empty($_POST['pass2'])) {
                //Función para enviar un correo desde un script PHP
                $_SESSION['nombre'] = $_POST['nombre'];
                $_SESSION['apellido'] = $_POST['apellido'];
                $_SESSION['correo'] = $_POST['correo'];
                if($_POST['pass']==$_POST['pass2']){
                    /*Se valida que la contraseña enviada por el usuario cumpla con los requisitos establecidos de seguridad*/
                    /*?=.*[A-Z] debe incluir al menos una mayúscula
                    ?=.*[a-z] debe incluir al menos una minúscula
                    ?=.*[0-9] de incluir al menos un número
                    [\w\W] se permite carácteres alfanuméricos y carácteres especiales
                    {8,} longitud mínima de 8 carácteres*/
                    if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[\w\W]{8,}$/', $_POST['pass'])){
                        $mensaje="Hola, hemos recibido una petición de registro en Ape Planner.<br/>
                        Para confirmar el registro pulsa en el siguiente <a href='http:.//localhost/Proyecto-DAW-main/confirmar.php'>enlace</a><br/>
                        http://localhost/Proyecto-DAW-main/confirmar.php
                        Si la petición no la has realizado tu, omite este correo.<br/><br/>
                        Un saludo del equipo de Ape Planner.";
                        mail($_POST['correo'],"Ape Planner - Solicitud registro",$mensaje,'proyectodaw.linkiafp@gmail.com');
                        //Se almacena la contraseña hasheada en la base de datos
                        $_SESSION['password'] = password_hash($_POST['pass'],PASSWORD_DEFAULT);
                    }
                    else{
                        echo "<div>La contraseña no cumple con los requisitos especificados</div>";
                    }
                    
                }else{
                    echo "<div>Las contraseñas no coinciden</div>";
                }
            }
            else{
                echo "<script>alert('Debes rellenar todos los campos');</script>";
            }    
            
        echo"</div>";
        
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
                        <label for='pass' class='col-md-3 col-form-label text-md-right'>Contraseña</label>
                        <div class='col-md-8'>
                            <input type='password' class='form-control' id='pass' name='pass'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <details>
                            <summary>¿Has olvidado tu contraseña?</summary>
                            <form class='row' action='resetPassword.php' method='post'>
                                <p>Por favor indica tu correo, te enviaremos una nueva contraseña</p>
                                <label for='correo_recuperacion' class='col-md-3 col-form-label text-md-right'>Dirección de correo:</label>
                                <div class='col-md-8'>
                                    <input type='email' class='form-control' id='correo_recuperacion' name='correo_recuperacion'>
                                </div>
                                <div class='col-md-8 offset-md-3'>
                                    <input type='submit' class='btn btn-primary botonRegistro' value='Recuperar'><!--pon un icono para el botón--></input>
                                </div>
                            </form>
                        </details>
                    </div>
                    <div class='col-md-8 offset-md-3'>
                        <input type='submit' class='btn btn-primary botonRegistro' value='Acceder'>
                    </div>

                </div>
                <div class='hidden-xs hidden-sm col-md-5'>
                    <p>Inicia sesión y accede a tu área de usuario donde podrás encontrar tus entradas y modificar tus datos de registro y envío. Al iniciar sesión confirmas que has leído y aceptas la Política de Privacidad y los Términos y condiciones de appeplanner.com.</p>
                </div>
            </form>
        </div>
    </div>
    <div class='mensaje'>";
    //Muestra el mensaje de error si hay un problema en login
    if(isset($_SESSION['mensaje'])){
        echo "<div style='color:red;'>".$_SESSION['mensaje']."</div>";
        unset($_SESSION['mensaje']);
        //Refresca la página
        echo"<script>setTimeout(function(){location.reload();}, 1000);</script>";
    }
    echo"</div>
</div>
<script src='registro.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'
    integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL'
    crossorigin='anonymous'></script>";

?>