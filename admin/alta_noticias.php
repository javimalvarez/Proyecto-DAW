
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/styleNavbar.css">
<link rel="stylesheet" type="text/css" href="../css/styleAltaNoticias.css">
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php

session_start();
//Requiere que el usuario haya iniciado sesion y en caso de haber iniciado sesión solo puede ser usuario administrador o con permisos alta eventos

if (!isset($_SESSION['usuario']) || $_SESSION['tipoUsuario'] != 0) {
  header("Location: ../index.php");
}
require_once("../database/datos.php");

$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error " . mysqli_error($con));
echo "<nav id='barra_navegacion' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
<a class='navbar-brand mr-auto' href='../index.php'>
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
        <a class='nav-link' href='../admin/alta_noticias.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
            Publicar noticia
        </a>
    </li>
</ul>
</div>
  <div class='nav-item'>
 <a  href='../login/logout.php'>
    <img id='profile-icon' src='../img/box-arrow-right.svg' />
    <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
    </a>
  </div>
</nav>";




echo"
<form action='".$_SERVER['PHP_SELF']."' method='post'>
<h2 class='tituloNoticias' >Gestión de Noticias</h2>
    <input type='text' name='titular' placeholder='Título de la noticia' required><br/><br/>
    <textarea id='texto' name='texto' placeholder='Escribe aquí el texto de la noticia' required></textarea>
    <input type='submit' value='Enviar' name='enviar'></form>";
echo"<script>
    ClassicEditor
        .create( document.querySelector( '#texto' ) )
        .catch( error => {
        console.error( error );
        } );
</script>";
$query="INSERT INTO noticias (titular, texto) VALUES('$_POST[titular]', '$_POST[texto]')";
mysqli_query($con, $query) or die("Error en la consulta: ".mysqli_error($con));
mysqli_close($con);





?>
