<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/styleNavbar.css">
<link rel="stylesheet" type="text/css" href="../css/styleAltaEventos.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php

session_start();
//Requiere que el usuario haya iniciado sesion y en caso de haber iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}
require_once("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error " . mysqli_error($con));
echo"<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Alta eventos</title>
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
            </li>";
            if ($_SESSION['tipoUsuario']==0){
                echo"<li class='nav-item'>
                <a class='nav-link' href='admin.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
                    Gestión de usuarios
                </a>
            </li>
            <li class='nav-item dropdown'>
              <a class='nav-link dropdown-toggle' href='#' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Eventos
              </a>
              <div class='dropdown-menu' aria-labelledby='navbarEventos'>
                <a class='dropdown-item' href='alta_eventos.php'>Alta de eventos</a>
                <a class='dropdown-item' href='gestion_eventos.php'>Gestión de eventos</a>
              </div>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../admin/editor.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
                    Publicar noticia
                </a>
            </li>";
            }
        echo"</ul>
    </div>";
    echo"<div class='nav-item'>
        <a  href='../login/logout.php'>
            <img id='profile-icon' src='../img/box-arrow-right.svg' />
            <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
        </a>
    </div>
    
</nav>
<div class='main-content'>
<h2 class='tituloEventos'>Gestión de Eventos</h2>
<div class='container ' >
<form  id='eventos' method='post' action='" . $_SERVER['PHP_SELF'] . "''>
    <label class='tituloSelect' for='evento' required>Nombre evento:</label></br>

    <input type='text' id='evento' name='evento' placeholder='Indica nombre del evento' required></br>
    <label class='tituloSelect' for='tipo_evento' required>Tipo de evento:</label></br>

    <select name='tipo_evento' id='tipo_evento' autofocus onchange='mostrarOcultarElementos()'>
        <option value='' selected disabled>Indica tipo de evento</option>";
        $query_tipoEvento = "SELECT * FROM tipo_eventos";
        $result_tipoEvento = mysqli_query($con, $query_tipoEvento) or die("Error " . mysqli_error($con));
        while ($row = mysqli_fetch_array($result_tipoEvento)) {
            extract($row);
            echo "<option value='$id_tipo'>$categoria_evento</option>";
        }
    echo "</select><br/>
    <span id='grupo' style='display: none;'>
    <label class='tituloSelect' for='evento' required>Grupo:</label></br>

    <select name='grupo' id='grupo'>
    <option value=''>Grupo</option>";
    $query_grupo = "SELECT id_grupo, nombre_grupo FROM grupos";
    $result_grupo = mysqli_query($con, $query_grupo) or die("Error " . mysqli_error($con));
    while ($row = mysqli_fetch_array($result_grupo)) {
        extract($row);
        echo "<option value='$id_grupo'>$nombre_grupo</option>";
    }
    echo "</select> Si el grupo no aparece en la lista pulsa aquí <button class='btn btn-outline-primary btn-sm' type='button'><a href='../eventos/alta_grupos.php' style='text-decoration:none; color:black;'>Nuevo grupo</a></button></span>
    <span id='festival' style='display: none;'>
    <label class='tituloSelect' for='evento' required>Festival:</label></br>

    <select name='festival' id='festival' onchange='desactivarPrecio()'><option value=''>Festival</option>";
    $query_festival = "SELECT id_festival, nombre_festival FROM festivales";
    $result_festival = mysqli_query($con, $query_festival) or die("Error " . mysqli_error($con));
    while ($row = mysqli_fetch_array($result_festival)) {
        extract($row);
        echo "<option value='$id_festival'>$nombre_festival</option>";
    }
    echo "</select> Si el festival no aparece en la lista lo puedes dar de alta desde aquí <button class='btn btn-outline-primary btn-sm' type='button'><a href='../eventos/alta_festivales.php' style='text-decoration:none; color:black;'>Alta festival</a></button></span>


    <label class='tituloSelect'>Provincia:</label></br>
    <select name='provincia'><option value=''>Provincia</option>";
    $query_provincia = "SELECT * FROM provincias";
    $result_provincia = mysqli_query($con, $query_provincia) or die("Error " . mysqli_error($con));
    while ($row = mysqli_fetch_array($result_provincia)) {
        extract($row);
        echo "<option value='$id_provincia'>$provincia</option>";
    }
    echo "</select><br/>
    <div>
    <label class='tituloSelect' for='ubicacion' title='Indica coordenadas'>Ubicación:</label> </br>
    <input type='text' name='ubicacion' placeholder='ejemplo: {lat:42.54992, lng:-6.59791}'  required><br/>
    <label class='tituloSelect' for='fecha_inicio' required>Fecha/hora evento:</label><br/>
    <input type='datetime-local' name='fecha_inicio'><br/>
    <label class='tituloSelect' for='fecha_fin'>Fecha fin:</label><br/>
    <input type='date' name='fecha_fin'><br/>
    <label class='tituloSelect' for='duracion'>Duracion:</label><br/>
    <input type='text' name='duracion'><br/>
    <label class='tituloSelect' for='precio'>Precio:</label><br/>
    <input type='number' name='precio' id='precio' step='0.01' min='0' value='0' required><br/>
    <label  class='tituloSelect'for='web_evento'>Web:</label><br/>
    <input type='url' name='web_evento' id='web_evento' placeholder='URL evento'><br/>
    <label class='tituloSelect' for='imagen_evento'>Imagen:</label><br/>
    <input type='url' name='imagen_evento' id='imagen_evento' placeholder='URL imagen'><br/>
    <label  class='tituloSelect' for='info_evento'>Otra información:</label><br/>
    <textarea name='info_evento' id='info_evento' cols='60' rows='7'></textarea><br/>
    <div class= 'text-center'>
    <input type='submit' class='btn btonEnviar btn-sm' id='enviar' name='enviar' value='Enviar'>
    </div>
</form>
</div>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $web = $_SERVER['HTTP_REFERER'];
    $nombreEvento = mysqli_real_escape_string($con, $_POST['evento']);
    $tipoEvento = $_POST['tipo_evento'];
    $grupo = !empty($_POST['grupo']) ? $_POST['grupo'] : 'NULL';
    $festival = !empty($_POST['festival']) ? $_POST['festival'] : 'NULL';
    $provincia = $_POST['provincia'];
    $ubicacion = mysqli_real_escape_string($con, $_POST['ubicacion']);
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = !empty($_POST['fecha_fin']) ? "'".$_POST['fecha_fin']."'" : 'NULL';
    $duracion = mysqli_real_escape_string($con, $_POST['duracion']);
    $precio = $_POST['precio'];
    $webEvento = mysqli_real_escape_string($con, $_POST['web_evento']);
    $imagenEvento = mysqli_real_escape_string($con, $_POST['imagen_evento']);
    $infoEvento = mysqli_real_escape_string($con, $_POST['info_evento']);
    $idUsuario = $_SESSION['id_usuario'];

    $query_evento = "SELECT nombre_evento FROM eventos WHERE nombre_evento='$nombreEvento'";
    $result_evento = mysqli_query($con, $query_evento) or die("Error " . mysqli_error($con));

    if (mysqli_num_rows($result_evento) == 0) {
        $query = "INSERT INTO eventos (nombre_evento, id_tipo, id_grupo, id_festival, id_provincia, ubicacion, fecha_inicio, fecha_fin, duracion, precio, web_evento, imagen_evento, info_evento, id_usuario) 
                  VALUES ('$nombreEvento', $tipoEvento, $grupo, $festival, $provincia, '$ubicacion', '$fechaInicio', $fechaFin, '$duracion', $precio, '$webEvento', '$imagenEvento', '$infoEvento', $idUsuario)";
        
        mysqli_query($con, $query) or die("Error " . mysqli_error($con));
        mysqli_close($con);
        echo "<script>alert('Alta evento realizada correctamente');window.location.href='$web';</script>";
    } else {
        echo "<script>alert('El evento ya existe');window.location.href='$web';</script>";
    }
}
    
    echo "</div> </div>";
?>

</div>
<footer>
    <div class="text-center p-3 footerCards" >
        © 2024 Copyright:
        <a class="text-white" href="">City Planner</a>
    </div>
</footer>


<script src='../eventos/eventos.js'></script>
<!-- <script src="../script.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


