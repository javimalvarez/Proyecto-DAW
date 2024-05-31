<link rel="stylesheet" type="text/css" href="../css/styleNavbar.css">
<link rel="stylesheet" type="text/css" href="../css/styleRegistros.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
//En el caso de login se guardará el usuario en una variable de sesión
session_start();
require_once("../database/datos.php");
//Formulario entrada de datos y login
echo"<nav id='barra_navegacion' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
<a class='navbar-brand mr-auto' href='../index.php'>
  <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
  <img src='../img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' /></a>
<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
  <span class='navbar-toggler-icon'></span>
</button>
<div class='collapse navbar-collapse' id='navbarSupportedContent'>
  <ul class='navbar-nav mr-auto'>
  </li class='nav-item'>
      <a class='nav-link' href='../index.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
    Inicio
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
        Noticias
      </a>
    </li>
</ul>
</div>
</div>
</nav>
<nav class='navbarEventos navbar navbar-expand-lg    navbar-dark bg-dark'>
<div class='container-fluid'>  
<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarText' aria-controls='navbarText' aria-expanded='false' aria-label='Toggle navigation'>
<span class='navbar-toggler-icon'></span>
</button>
  <div class='collapse navbar-collapse' id='navbarText'>
    <ul class='ulnavbarEventos navbar-nav mx-auto'>
      <li class='nav-item'>
        <a class='nav-link'  href='../eventos/event_pages/festivales.php'>Festivales</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='../eventos/event_pages/conciertos.php'>Conciertos</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='../eventos/event_pages/teatro.php'>Teatro</a>
      </li>
      <li class='nav-item'>
      <a class='nav-link' href='../eventos/event_pages/cine.php'>Cine</a>
    </li>   <li class='nav-item'>
    <a class='nav-link' href='../eventos/event_pages/ferias.php'>Ferias</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' href='../eventos/event_pages/otros_eventos.php'>Otros</a>
  </li>
    </ul>

  </div>
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
                        <label class='col-md-3 col-form-label text-md-right'>Provincia:</label>
                        <div class='col-md-8'>
                            <select name='provincia' id='provincia' class='form-control form-select-sm' aria-label='Default select example'>";
                                $query="SELECT * FROM provincias";
                                $result = mysqli_query($con, $query);
                                while($row = mysqli_fetch_array($result)){
                                    extract($row);
                                    echo"<option value='$id_provincia'>$provincia</option>";
                                }
                            echo"</select>
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
                                <summary id='informacionImportante'>Información importante:</summary>
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
                                <label class='form-check-label  m-2' for='confirmar'>
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
            if (empty($_POST['nombre'])|| empty($_POST['apellidos'])|| empty($_POST['provincia'])||empty($_POST['correo'])||empty($_POST['pass'])||empty($_POST['pass2'])) {
                echo "<script>alert('Hay campos vacios en el formulario')</script>";
            }
            else {
                $_SESSION['nombre'] = $_POST['nombre'];
                $_SESSION['apellidos'] = $_POST['apellidos'];
                $_SESSION['provincia'] = $_POST['provincia'];
                $_SESSION['correo']=$_POST['correo'];
                if($numUsers==0){
                    if($_POST['pass']==$_POST['pass2']&&isset($_POST['altaUsuario'])){
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
                            header("Location: ../index.php");
                        }
                        else{
                            echo "<script>alert('La contraseña no cumple con los requisitos especificados')</script>";
                        }
                        
                    }
                    else if($_POST['pass']==$_POST['pass2']&&isset($_POST['confirmar'])&&isset($_POST['confirmar'])&&$_POST['confirmar']=='1'&&isset($_POST['altaUsuario'])){
                        /*Se valida que la contraseña enviada por el usuario cumpla con los requisitos establecidos de seguridad*/
                        /*?=.*[A-Z] debe incluir al menos una mayúscula
                        ?=.*[a-z] debe incluir al menos una minúscula
                        ?=.*[0-9] de incluir al menos un número
                        [\w\W] se permite carácteres alfanuméricos y carácteres especiales
                        {8,} longitud mínima de 8 carácteres*/
                        if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[\w\W]{8,}$/', $_POST['pass'])){
                            $mensaje="Hola, hemos recibido una petición de registro en City Planner para poder dar de alta eventos.<br/>
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
                            header("Location: ../index.php");
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
<footer class='text-white text-center text-lg-start footerIndex '>
    <!-- Grid container -->
    <div class='container p-4 footerInfo'>
      <!--Grid row-->
      <div class='row'>
        <!--Grid column-->
        <div class='col-lg-8 col-md-12  md-0'>
          <h5 class='text-uppercase tituloFooter'>Sobre Nosotros</h5>

          <p>
            Somos un equipo de cuatro estudiantes apasionados por la tecnología y el desarrollo web. Actualmente, estamos cursando el ciclo formativo de Desarrollo de Aplicaciones Web (DAW) y este proyecto es una oportunidad para aplicar nuestros conocimientos y habilidades en un entorno real.
          </p>
        </div>
        <!--Grid column-->

       
        <!--Grid column-->
        <div class='col-lg-4 col-md-6  md-0'>
          <h5 class='text-uppercase tituloFooter md-0'>Nosotros  </h5>

          <ul class='list-unstyled'>
            <li>
              <a href='#!' class='text-white'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg> Javier Martinez</a>
            </li>
            <li>
              <a href='#!' class='text-white'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg> Itziar Esteban</a>
            </li>
            <li>
              <a href='#!' class='text-white'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg> David Rodriguez</a>
            </li>
            <li>
              <a href='#!' class='text-white'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg> Arantxa Ordoyo</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>

    <!-- Copyright -->
    <div class='text-center p-3 footerCopyright' style='background-color: rgba(0, 0, 0, 0.2);'>
      © 2024 Copyright:
      <a class='text-white' href=''>CityPlanner</a>
    </div>
    <!-- Copyright -->
  </footer>
<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>