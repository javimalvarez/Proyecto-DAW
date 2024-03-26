<link rel="stylesheet" href="css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();
if (!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
require("database/datos.php");
require("database/filtros.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
date_default_timezone_set('Europe/Madrid');
$fecha = date("Y-m-d");
$coste="";
setlocale(LC_TIME, 'es_ES.UTF-8');
echo"<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>City Planner</title>
</head>
<div id='alerta'>";
   
echo"</div>
<!-- Popup de inicio de sesión -->
<nav id='barra_navegacion' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
  <a class='navbar-brand mr-auto' href='index.php'>
    <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
    <img src='img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' /></a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
    <ul class='navbar-nav mr-auto'>
      <li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle' href='#' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Eventos
          </a>
          <div class='dropdown-menu' aria-labelledby='navbarEventos'>
            <a class='dropdown-item' href='#'>Festivales</a>
            <a class='dropdown-item' href='eventos/event_pages/conciertos.php'>Conciertos</a>
            <a class='dropdown-item' href='#'>Cine</a>
            <a class='dropdown-item' href='#'>Teatro</a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='#'>Otros</a>
          </div>
      </li>
      <li>
          <a class='nav-link' href='noticias.php' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Noticias
          </a>
      </li>
      <li><form class='d-flex' role='search' >
          <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' />
          <button class='btn btn-outline-success' type='submit'>
            Search
          </button>
        </form>
      </li>
  </div>
    <div class='nav-item'>
      <img id='profile-icon' src='img/person.svg' />
      <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
    </div>
</nav>
<div class='login'>
  <div class='login-triangle'></div>
  <img src='img/user.svg'/>
  <div>".$_SESSION['nombre'] ."(" . $_SESSION['usuario'] .")</div>
  <form action='".$_SERVER['PHP_SELF']."' method='post' class='form-container'>
    <input type='submit' class='exit' name='salir' value='Salir'></form>
  </form>
</div>";
if (isset($_POST['salir'])) {
    session_destroy();
    header("Location: index.php");
}
//Filtros
echo"<div style='padding: 10px; margin: 10px'><details><summary>Búsqueda avanzada</summary><div><form action='".$_SERVER['PHP_SELF']."' method='post'>
<select class='form-select' id='tipo' name='tipo' multiple size='1'>
<option value='' selected disabled>Elige un plan:</option>";
//Consulta de los tipos de eventos a la base de datos
$query_evento = "SELECT * FROM tipo_eventos";
$result_evento = mysqli_query($con, $query_evento);
while ($row = mysqli_fetch_array($result_evento)) {
    extract($row);
    echo "<option value='$idtipo'>$categoria_evento</option>";
}
echo "<option value='Festivales'>Festivales</option></select>
<label for='provincia'>Eventos en</label>
<select class='form-select' id='provincia' name='provincia'>
<option value='' disabled>Provincia:</option><optgroup>";
//Consulta de las provincias a la base de datos
$query_provincia = "SELECT * FROM provincias";
$result_provincia = mysqli_query($con, $query_provincia);
while ($row = mysqli_fetch_array($result_provincia)) {
    extract($row);
    if ($_SESSION['provincia_usuario'] == $id_provincia) {
        echo "<option value='$id_provincia' selected>$provincia</option>";
    }else{
      echo "<option value='$id_provincia'>$provincia</option>";
    }
}

echo "</select><input type='checkbox' id='precio' name='precio' value='0'>
<label for='coste'>Solo planes gratuitos</label><br/>
<label for='f_inicio'>Fecha inicio:</label>
<input type='date' id='f_inicio' name='f_inicio' id='f_inicio' value='$fecha'>
<label for='f_fin'>Fecha fin:</label>
<input type='date' id ='f_fin' name='f_fin' id='f_fin' value='2024-12-31'>
<input class='btn btn-primary' type='submit' id='consultar' name='consultar' value='Consultar'/>
<button class='btn btn-secondary' type='reset' id='eliminar' name='eliminar'>Eliminar seleccion</button></form></details></div>";
$query_provincia="SELECT * FROM provincias WHERE id_provincia = '$_SESSION[provincia_usuario]'";
$result_provincia = mysqli_query($con, $query_provincia);
while ($row = mysqli_fetch_array($result_provincia)) {
    extract($row);
    echo"<div id='eventos' style='border: 2 solid black; padding: 10px'><h3>Planes en $provincia</h3>";
}
//Mostrará una lista de eventos relativos a la provincia que consta en el registro
$result=provincia($con, $_SESSION['provincia_usuario']);
$numEventos=mysqli_num_rows($result);
if ($numEventos > 0) {
  while($row = mysqli_fetch_array($result)){
      extract($row);
      if($precio==0){
        $coste="Gratuita";
      }else{
        $coste=$precio."€";
      }
      if(!empty($fecha_inicio)){
        $fecha_inicio= date("j F, Y H:i", strtotime($fecha_inicio));
      }
      if(!empty($fecha_fin)){
        $fecha_fin= date("j F, Y", strtotime($fecha_fin)); 
      }
      echo "<div style='border: 1px solid black; margin: 10px; padding: 10px; border-radius: 10px;'>
            <div><img src='$imagen_evento'></div>
            <div><img src='$imagen_festival'></div>
            <div>
                <h3>$evento</h3>
                <span><a href='#'>$categoria_evento</a></span>
                <div>
                    <span><a href='$web_grupo'>$nombre_grupo</a></span>
                    <span>$info_grupo</span>
                    <span><a href='$web_festival'>$nombre_festival</a></span>
                    <span>$info_festival</span>
                </div>
                <div>
                    <span>Fecha: $fecha_inicio</span>
                    <span>$fecha_fin</span>
                </div>
                <div><a href='$web_evento'>$web_evento</a></div>";
                
                echo "<span>Entrada: $coste</span>
                <div>Otra información: $info_evento</div>   
            </div>
          </div>";
  }
}else{
    echo "No hay eventos en esta provincia";
}
if(isset($_POST['precio'])&&isset($_POST['consultar'])){
  $result=provinciaGratis($con, $_POST['provincia'], $_POST['precio'], $_POST['f_inicio'], $_POST['f_fin']);
  $numEventos=mysqli_num_rows($result);
  if ($numEventos > 0) {
    echo"<script>document.getElementById('eventos').innerHTML = '';</script>";
    while($row = mysqli_fetch_array($result)){
        extract($row);
        if($precio==0){
          $coste="Gratuita";
        }else{
          $coste=$precio."€";
        }
        if(!empty($fecha_inicio)){
          $fecha_inicio= date("j F, Y H:i", strtotime($fecha_inicio));
        }
        if(!empty($fecha_fin)){
          $fecha_fin= date("j F, Y", strtotime($fecha_fin)); 
        }
        echo"<script>document.getElementById('eventos').innerHTML += \"<div id='eventos'><div style='border: 1px solid black; margin: 10px; padding: 10px; border-radius: 10px;'><div><img src='$imagen_evento'></div><div><img src='$imagen_festival'></div><div><h3>$evento</h3><div><span><a href='$web_grupo'>$nombre_grupo</a></span><span>$info_grupo</span><span><a href='$web_festival'>$nombre_festival</a></span><span>$info_festival</span></div><div><span>Fecha: $fecha_inicio</span></div><div><a href='$web_evento'>$web_evento</a></div><span>Entrada: $coste</span><div>Otra información: $info_evento</div>\" ;</script>";
    }
  }else{
    echo"<script>alert('No se ha encontrado ninguna coincidencia');</script>";
  }
}
echo"</div>";
?>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>