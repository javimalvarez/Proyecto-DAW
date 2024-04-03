<link rel="stylesheet" href="../../css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();
require("../../database/datos.php");
require("../../database/filtros.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
date_default_timezone_set('Europe/Madrid');
$fecha = date("Y-m-d");
$coste = "";
setlocale(LC_TIME, 'es_ES.UTF-8');
echo "<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>City Planner</title>
</head>";

echo "</div>
<!-- Popup de inicio de sesión -->
<nav id='barra_navegacion' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
  <a class='navbar-brand mr-auto' href='../../index.php'>
    <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
    <img src='../../img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' /></a>
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
            <a class='dropdown-item' href='festivales.php'>Festivales</a>
            <a class='dropdown-item' href='conciertos.php'>Conciertos</a>
            <a class='dropdown-item' href='teatro.php'>Teatro</a>
            <a class='dropdown-item' href='cine.php'>Cine</a>
            <a class='dropdown-item' href='ferias.php'>Ferias</a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='otros.php'>Otros</a>
          </div>
      </li>
      <li>
          <a class='nav-link' href='../../noticias.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
            Noticias
          </a>
      </li>
    </ul>
    <form class='d-flex mx-auto  col-md-4'>
        <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' />
        <button class='btn btn-outline-success' type='submit'>
            Search</button>
    </form>
  </div>
  
    <div class='nav-item'>
      <img id='profile-icon' src='../../img/person.svg' />
      <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
    </div>
</nav>";
if (isset($_SESSION['usuario'])) {
  echo " <div class='login'>
      <div class='login-triangle'></div>
      <img src='../../img/user.svg'/>
      <div>" . $_SESSION['nombre'] . "(" . $_SESSION['usuario'] . ")</div>
      <form action='" . $_SERVER['PHP_SELF'] . "' method='post' class='form-container'>
        <input type='submit' class='exit' name='salir' value='Salir'></form>
      </form>
    </div>";
  if (isset($_POST['salir'])) {
    session_destroy();
    header("Location: festivales.php");
  }
} else {
  echo "<div class='login' id='login-form'>
    <div class='login-triangle'></div>
    <form class='login-container' action='../../login/login.php' method='post'>
    <h2 class='login-header'>Iniciar Sesion</h2>
    <p><input type='email' id='correo' name='correo' placeholder='Correo'></p>
    <p><input type='password' id='pass' name='pass' placeholder='Contraseña'></p>
    <p><input class='botonLogin' type='submit' value='Acceder'></p>
    <a id='enlaceContraseña' href='#'>No recuerdo mi contraseña</a>
    <hr>
    <p>¿Aún no tienes cuenta?</p>
    <!-- Tenemos que poner type button porque si ponemos type submit necesitamos el rellenar el email y pass -->
    <p><input type='button' class='registro' onclick='window.location.href = \"../../login/registro.php\"' value='Regístrate'></p></form>
  </div>";
}

echo "</div>";
//Filtros
echo "<details><summary>Búsqueda avanzada</summary><div><form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
<select class='form-select' id='festival' name='festival'>
<option value='' disabled selected>Festival</option>";
$query_festival="SELECT id_festival, nombre_festival FROM festivales";
$result_festival = mysqli_query($con, $query_festival);
while ($row = mysqli_fetch_array($result_festival)) {
  extract($row);
  echo "<option value='$id_festival'>$nombre_festival</option>";
}
echo"</select><select class='form-select' id='provincia' name='provincia'>
<option value='' disabled selected>Provincia</option>";
//Consulta de las provincias a la base de datos
$query_provincia = "SELECT * FROM provincias";
$result_provincia = mysqli_query($con, $query_provincia);
while ($row = mysqli_fetch_array($result_provincia)) {
  extract($row);
  echo "<option value='$id_provincia'>$provincia</option>";
  if ($id_provincia == $_SESSION['provincia_usuario']) {
    echo "<option value='$id_provincia' selected>$provincia</option>";
  }
}

echo "</select><br/>
<label for='f_inicio'>Fecha inicio:</label>
<input type='date'id='f_inicio' name='f_inicio' id='f_inicio' value='$fecha'>
<label for='f_fin'>Fecha fin:</label>
<input type='date' id ='f_fin' name='f_fin' id='f_fin' value='2024-12-31'>
<input class='btn btn-primary' type='submit' id='consultar' name='consultar' value='Consultar'/>
<button class='btn btn-secondary' type='reset' id='eliminar' name='eliminar'>Eliminar seleccion</button></form></details>
<div id='eventos' style='border: 2 solid black; padding: 10px'>";
//Mostrará una lista de conciertos
$query="SELECT * FROM festivales";
$result = mysqli_query($con, $query);
$numFestivales=mysqli_num_rows($result);
if ($numFestivales > 0) {
  while ($row = mysqli_fetch_array($result)) {
    extract($row);
    if ($precio == 0) {
      $coste = "Gratuita";
    } else {
      $coste = $precio . "€";
    }
    echo "<div style='border: 1px solid black; margin: 10px; padding: 10px; border-radius: 10px;'>
    <h1>$nombre_festival</h1>";
    $query_provincia="SELECT DISTINCT p.provincia, e.ubicacion FROM eventos e INNER JOIN provincias p ON e.id_provincia = p.id_provincia WHERE e.id_festival = '$id_festival'";
    $result_provincia = mysqli_query($con, $query_provincia);
    $row = mysqli_fetch_array($result_provincia);
    extract($row);
    echo"<span>Provincia: $provincia</span>
    <p>Lista de conciertos:</p><ul>";
    $result=festivales($con,$id_festival);
    while($row = mysqli_fetch_array($result)){
      extract($row);
        echo"<li><div><a href='$web_grupo'>$nombre_grupo</a> $f_concierto</div></li>";
    }
    echo "</ul>
    <div>
      <div><img src='$imagen_festival'></div>
      <div>
        <div>Fecha inicio: $fecha_inicio</div>
        <div>Fecha fin: $fecha_fin</div>
        <div>Coste abono: $coste</div> 
        <div>Web festival: <a href='$web_festival'>$nombre_festival</a></div>
        <div>$info_festival</div>
      </div>  
    </div>";
  }
} else {
  echo "No se ha encontrado ninguna coincidencia";
}
echo "</div>";

##Filtros
//Consulta datos festival
if (isset($_POST['festival']) && isset($_POST['consultar'])) {
  //Consulta nombre festival
  $query_festival="SELECT * FROM festivales WHERE id_festival = '$_POST[festival]'";
  $result_festival = mysqli_query($con, $query_festival);
  $row = mysqli_fetch_array($result_festival);
  extract($row);
  echo"<script>document.getElementById('eventos').innerHTML = '';
  <script> document.getElementById('eventos').innerHTML += '<h1>$nombre_festival</h1><div>Provincia: $provincia</div><div>Lista de conciertos:<ul>'</script>;";
  $result = festivales($con, $_POST['festival']);
  $numEventos = mysqli_num_rows($result);
  if ($numEventos > 0) {
    while ($row = mysqli_fetch_array($result)) {
      extract($row);
      if ($precio == 0) {
        $coste = "Gratuita";
      } else {
        $coste = $precio . "€";
      }
      $fecha_inicio = date("j F Y H:i", strtotime($fecha_inicio));
      $fecha_fin = date("j F Y", strtotime($fecha_fin));
      echo"<script>document.getElementById('eventos').innerHTML += '<li><div><a href='$web_grupo'>$nombre_grupo</a> $f_concierto</div></li>'</script>";
    }
    echo"<script>document.getElementById('eventos').innerHTML += '</ul><div>Precio abono: $abono</div><div>fechas: </div><div>Web festival: <a href='$web_festival'>$nombre_festival</a></div><div>$info_festival</div>'</script>";
  }
}
?>
<script src="../../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>