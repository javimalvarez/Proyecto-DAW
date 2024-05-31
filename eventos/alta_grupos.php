<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/styleNavbar.css">
<link rel="stylesheet" type="text/css" href="../css/styleAltaEventos.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php
session_start();
//Requiere que el usuario haya iniciado sesion
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
echo"<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<h2 class='tituloEventos ' >Dar de alta un grupo</h2>
<div class='container' >
<label  class='tituloSelect' for='nombre_grupo' >Nombre grupo:</label>
<input type='text' name='nombre_grupo' required placeholder='Indica nombre del grupo' required><br/>
<label  class='tituloSelect' for='nombre_genero_grupo' >Genero grupo:</label>

<select name='genero' required><option value='' disabled selected>Genero</option>";

$query="SELECT * FROM generos";
$result=mysqli_query($con, $query) or die("Error ".mysqli_error($con));

while($row = mysqli_fetch_array($result)){
    extract($row);
    echo "<option value='$id_genero'>$genero</option>";
}
echo"</select><br/><label  class='tituloSelect' for='url_grupo'>Web:</label>
<input type='url' name='url_grupo' placeholder='URL grupo'><br/>
<label  class='tituloSelect' for='info_grupo'>Otra información:</label><br/>
<textarea name='info_grupo' id='info_grupo' cols='30' rows='3'></textarea><br/>
<div class= 'text-center'>
<input  class='btn  btn-sm' type='submit' name='enviar' value='Dar de alta grupo'>
</div>
</form></div>";

if(isset($_POST['enviar'])){
    $query_grupo="SELECT nombre_grupo FROM grupos WHERE nombre_grupo = '" . $_POST['nombre_grupo'] . "'";
    $result_grupo = mysqli_query($con, $query_grupo) or die("Error ".mysqli_error($con));
    if (mysqli_num_rows($result_grupo)== 0) {
        $query="INSERT INTO grupos (nombre_grupo, id_genero, web_grupo, info_grupo) 
        VALUES ('" . $_POST['nombre_grupo'] . "', " . $_POST['genero'] . ", '" . $_POST['url_grupo'] . "', '" . $_POST['info_grupo'] . "')";
        mysqli_query($con, $query) or die("Error ".mysqli_error($con));
        echo"<script>alert('El grupo ha sido dado de alta');window.location.href='../admin/alta_eventos.php';</script>";
    }else{
        echo"<script>alert('El grupo ya existe');window.location.href='../admin/alta_eventos.php';</script>";
    }
    
}

?>

<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>