<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="../css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();
/*Para acceder al panel de administrador se requiere que el usuario haya iniciado sesion
y si ha iniciado sesión que tenga perfil de admistrador*/
if (!isset($_SESSION['usuario']) || $_SESSION['tipoUsuario'] != 0) {
  header("Location: ../index.php");
}
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
echo"<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>City Planner</title>
</head>
</div>
<!-- Popup de inicio de sesión -->
<nav id='barra_navegacion' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
  <a class='navbar-brand mr-auto' href='index.php'>
    <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
    <img src='../img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' /></a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>
  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
    <ul class='navbar-nav mr-auto'>
      <li class='nav-item'>
          <a class='nav-link' href='../admin/admin.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
              Gestionar usuarios
          </a>
      </li>
      <li class='nav-item'>
          <a class='nav-link' href='../eventos/alta_eventos.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
              Gestionar eventos
          </a>
      </li>
      <li class='nav-item'>
          <a class='nav-link' href='../admin/editor.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
              Publicar noticia
          </a>
      </li>
    </ul>
  </div>
    <div class='nav-item'>
      <img id='profile-icon' src='../img/person.svg' />
      <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
    </div>
</nav>
<div class='login'>
  <div class='login-triangle'></div>
  <img src='../img/user.svg'/>
  <div>".$_SESSION['nombre'] ."(" . $_SESSION['usuario'] .")</div>
  <form action='".$_SERVER['PHP_SELF']."' method='post' class='form-container'>
    <input type='submit' class='exit' name='salir' value='Salir'></form>
  </form>
</div>";
if (isset($_POST['salir'])) {
    session_destroy();
    header("Location: ../index.php");
}
echo"<div style='padding:10px; margin:10px; max-width: 70%; background-color: white; border-radius: 10px; '><form action='".$_SERVER['PHP_SELF']."' method='post'>
    <div class='mb-1'>
        <input type='text' class='form-control' name='titular' placeholder='Título' required>
    </div>
    <div class='mb-1'>
        <textarea name='texto' class ='form-control'required></textarea>
    </div>
    <input type='submit' class='btn btn-primary btn-sm' value='Enviar' name='enviar'></form></div>
    <script>CKEDITOR.replace('texto');</script>";
if (isset($_POST['enviar'])) {
    $query="INSERT INTO noticias (titular, texto, id_usuario) VALUES('".$_POST['titular']."', '".$_POST['texto']."', '".$_SESSION['id_usuario']."')";
    mysqli_query($con, $query) or die("Error en la consulta: ".mysqli_error($con));
    mysqli_close($con);
}
?>
<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>