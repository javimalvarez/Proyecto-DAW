<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/styleNavbar.css">
<link rel="stylesheet" type="text/css" href="../css/styleAltaEventos.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}
require("../database/datos.php");
#Elimina los warning manteniendo el resto de errores
#error_reporting(E_ALL & ~E_WARNING);

echo"<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>City Planner</title>
</head>
</div>
<nav id='barra_navegacion' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
    <a class='navbar-brand mr-auto' href='../index.php'>
    <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
    <img src='../img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' /></a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
    </button>

    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav mr-auto'>
         <li class='nav-item'>
            <a class='nav-link' href='../index.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
                Inicio
            </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../admin/admin.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
                    Gestión de usuarios
                </a>
            </li>
            <li class='nav-item dropdown'>
              <a class='nav-link dropdown-toggle' href='#' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Eventos
              </a>
              <div class='dropdown-menu' aria-labelledby='navbarEventos'>
                <a class='dropdown-item' href='../admin/alta_eventos.php'>Alta de eventos</a>
                <a class='dropdown-item' href='../admin/gestion_eventos.php'>Gestión de eventos</a>
              </div>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../admin/editor.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
                    Publicar noticia
                </a>
            </li>
        </ul>
    </div>";
    if ($_SESSION['tipoUsuario']==0){
        echo"<div class='nav-item'>
        <a  href='../login/logout.php'>
            <img id='profile-icon' src='../img/box-arrow-right.svg' />
            <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
        </a>
    </div>";
    }
    
echo"</nav>";
echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<h2 class='tituloEventos '>Dar de alta un festival:</h2>
<div class='container'>
<label class='tituloSelect' for='nombre_festival'>Nombre festival:</label>
<input type='text' name='nombre_festival' placeholder='Indica nombre del festival'></br>
<label  class='tituloSelect' for='ini_festival' required>Fecha comienzo:</label>
<input type='date' name='ini_festival' required></br>
<label class='tituloSelect' for='fin_festival'>Fecha fin:</label>
<input type='date' name='fin_festival' required><br/>
<label class='tituloSelect' for='precio_abono'>Precio:</label>
<input type='number' name='precio_abono' step='0.01'><br/>
<label class='tituloSelect' for='url_festival'>Web festival:</label></br>
<input type='url' name='web_festival' placeholder='URL festival'><br/>
<label class='tituloSelect' for='imagen_festival'>URL imagen:</label></br>
<input type='url' name='imagen_festival' placeholder='URL imagen'><br/>
<label class='tituloSelect' for='info_festival'>Otra información:</label><br/>

<textarea name='info_festival' id='info_festival' cols='30' rows='3'></textarea><br/>
<div class= 'text-center'>
<input class='btn  btn-sm' type='submit' name='enviar' value='Alta festival'>
</div>
</form>";

if (isset($_POST['enviar'])){
    $query_festival="SELECT nombre_festival FROM festivales WHERE nombre_festival = '" . $_POST['nombre_festival'] . "'";
    $result_festival = mysqli_query($con, $query_festival) or die("Error " . mysqli_error($con));
    if(mysqli_num_rows($result_festival)== 0){
        $query = "INSERT INTO festivales (nombre_festival,fecha_inicio,fecha_fin, abono, web_festival, imagen_festival, info_festival)
        VALUES ('".$_POST['nombre_festival']."','" . $_POST['ini_festival'] . "', '" . $_POST['fin_festival'] . "', '" . $_POST['web_festival'] . "', ".$_POST['precio_abono'].", '" . $_POST['imagen_festival'] . "', '" . $_POST['info_festival'] . "')";
        mysqli_query($con, $query) or die("Error " . mysqli_error($con));
        echo"<script>alert('El festival ha sido dado de alta');window.location.href='../admin/alta_eventos.php';</script>";
    }else{
        echo"<script>alert('El nombre del festival ya existe');window.location.href='../admin/alta_eventos.php';</script>";
    }
}
?>

<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>