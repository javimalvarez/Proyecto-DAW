<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/styleNavbar.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php

session_start();
//Requiere que el usuario haya iniciado sesion y en caso de haber iniciado sesión solo puede ser usuario administrador o con permisos alta eventos
if (!isset($_SESSION['usuario']) || $_SESSION['tipoUsuario']==1) {
     header("Location: ../index.php");
}
require_once("../database/datos.php");

$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error " . mysqli_error($con));
echo"<head>
  <meta charset='utf-8'/>
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>City Planner</title>
</head>
</div>
<!-- Popup de inicio de sesión -->
<nav id='barra_navegacion' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
    <a class='navbar-brand mr-auto' href='../index.php'>
        <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
        <img src='../img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' /></a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='nav-item'>
        <a  href='".$_SERVER["HTTP_REFERER"]."'>
            <img id='profile-icon' src='../img/box-arrow-right.svg' />
            <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
        </a>
    </div>
</nav>


<div class=' main-content cem col-md-9' style='margin-top: 10px;'>
<div class='card cardEvento' >
<div class='card-header'>Desde aquí puedes gestionar el alta de eventos</div>
<div class='card-body'>
<form id='eventos' method='post' action='" . $_SERVER['PHP_SELF'] . "''>
    <label for='evento' required>Evento:</label>
    <input type='text' id='evento' name='evento' placeholder='Indica nombre del evento' required>
    <select name='tipo_evento' id='tipo_evento' autofocus>
        <option value='' selected disabled>Indica tipo de evento</option>";
        $query_tipoEvento = "SELECT * FROM tipo_eventos";
        $result_tipoEvento = mysqli_query($con, $query_tipoEvento) or die("Error " . mysqli_error($con));
        while ($row = mysqli_fetch_array($result_tipoEvento)) {
            extract($row);
            echo "<option value='$id_tipo'>$categoria_evento</option>";
        }
    echo "</select><br/>
    <span id='grupo' style='visibility:hidden;'><select name='grupo' id='grupo'>
    <option value=''>Grupo</option>";
    $query_grupo = "SELECT id_grupo, nombre_grupo FROM grupos";
    $result_grupo = mysqli_query($con, $query_grupo) or die("Error " . mysqli_error($con));
    while ($row = mysqli_fetch_array($result_grupo)) {
        extract($row);
        echo "<option value='$id_grupo'>$nombre_grupo</option>";
    }
    echo "</select> Si el grupo no aparece en la lista pulsa aquí <button class='btn btn-outline-primary btn-sm' type='button'><a href='alta_grupos.php' style='text-decoration:none; color:black;'>Nuevo grupo</a></button></span><br/>
    <span id='festival' style='visibility:hidden;'><select name='festival' id='festival' onchange='desactivarPrecio()'><option value=''>Festival</option>";
    $query_festival = "SELECT id_festival, nombre_festival FROM festivales";
    $result_festival = mysqli_query($con, $query_festival) or die("Error " . mysqli_error($con));
    while ($row = mysqli_fetch_array($result_festival)) {
        extract($row);
        echo "<option value='$id_festival'>$nombre_festival</option>";
    }
    echo "</select> Si el festival no aparece en la lista lo puedes dar de alta desde aquí <button class='btn btn-outline-primary btn-sm' type='button'><a href='alta_festivales.php' style='text-decoration:none; color:black;'>Alta festival</a></button></span><br/>
    <select name='provincia'><option value=''>Provincia</option>";
    $query_provincia = "SELECT * FROM provincias";
    $result_provincia = mysqli_query($con, $query_provincia) or die("Error " . mysqli_error($con));
    while ($row = mysqli_fetch_array($result_provincia)) {
        extract($row);
        echo "<option value='$id_provincia'>$provincia</option>";
    }
    echo "</select><br/>
    <label for='ubicacion' title='Indica coordenadas'>Ubicación:</label> 
    <input type='text' name='ubicacion' placeholder='ejemplo: {lat:42.54992, lng:-6.59791}'><br/>
    <input type='checkbox' id='varios_dias' onchange='marcar()'>Marca esta opción si el evento tiene una duración de varios días (no disponible para conciertos)<br/>
    <label for='fecha_inicio'>Fecha/hora evento:</label>
    <input type='datetime-local' name='fecha_inicio'>
    <span id='fecha_fin'style='visibility: hidden;'>
        <label for='fecha_fin'>Fecha fin:</label>
        <input type='date' name='fecha_fin'>
    </span><br/>
    <label for='duracion'>Duracion:</label>
    <input type='text' name='duracion'><br/>
    <label for='precio'>Precio:</label>
    <input type='number' name='precio' id='precio' step='0.01' min='0' value='0'><br/>
    <label for='web'>Web:</label>
    <input type='url' name='web_festival' placeholder='URL evento'><br/>
    <label for='imagen'>Imagen:</label>
    <input type='url' name='imagen_festival' placeholder='URL imagen'><br/>
    <label for='info'>Otra información:</label><br/>
    <textarea name='info' id='info_festival' cols='60' rows='7'></textarea><br/>
    <input type='submit' class='btn btn-primary btn-sm' id='enviar' value='Enviar'>
</form>";
if (isset($_POST['enviar'])) {
    $query = "INSERT INTO eventos (nombre_evento, id_tipo, id_grupo, id_festival, id_provincia, ubicacion, fecha_inicio, fecha_fin, duracion, precio, web_evento, imagen_evento, info_evento, id_usuario) VALUES($_POST[evento], $_POST[grupo], $_POST[festival], $_POST[provincia], $_POST[ubicacion], $_POST[fecha_inicio], $_POST[fecha_fin], $_POST[precio],$_POST[web], $_POST[imagen], $_POST[info]," . $_SESSION['id_usuario'] . ")";
    mysqli_query($con, $query) or die("Error " . mysqli_error($con));
    mysqli_close($con);
    echo "<script>(alert('Alta evento realizada correctamente'))</script>";
    header("Location: $_SERVER[HTTP_REFERER]");
}
    echo "</div> </div>";
?>

</div>
<footer>
    <div class="text-center p-3 footerCards" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2024 Copyright:
        <a class="text-white" href="">ApePlanner</a>
    </div>
</footer>
<script src='eventos.js'></script>
<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


