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
</head>
<!-- Popup de inicio de sesión -->
<nav id='barra_navegacion main-navbar' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
<div class='container-fluid'>
<a class='navbar-brand mr-auto' href='../../index.php'>
    <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
    <img src='../../img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' />
</a>
<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
  <span class='navbar-toggler-icon'></span>
</button>
<div class='collapse navbar-collapse' id='navbarSupportedContent'>
  <ul class='navbar-nav ml-4'><!-- mx-auto mb-2 mb-lg-0   ml-auto o ml- te da un margen a la izquierda y mr- a la derecha si offset-1-->
    <li class='nav-item dropdown'>
      <a class='nav-link dropdown-toggle' href='#' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Eventos
      </a>
      <div class='dropdown-menu' aria-labelledby='navbarEventos'>
      <a class='dropdown-item' href='eventos/event_pages/festivales.php'>Festivales</a>
      <a class='dropdown-item' href='eventos/event_pages/conciertos.php'>Conciertos</a>
      <a class='dropdown-item' href='eventos/event_pages/teatro.php'>Teatro</a>
      <a class='dropdown-item' href='eventos/event_pages/cine.php'>Cine</a>
      <a class='dropdown-item' href='eventos/event_pages/ferias.php'>Ferias</a>
      <div class='dropdown-divider'></div>
      <a class='dropdown-item' href='eventos/event_pages/otros.php'>Otros</a>
      </div>
    </li class='nav-item'>
      <a class='nav-link' href='noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
        noticias
      </a>
    </li>
    <li class='nav-item ocultar-div'>
      <a class='nav-link' href='../../login/loginResponsive.php'>Login <span class='sr-only'>(current)</span></a>
    </li>
  </ul>
  <form class='d-flex mx-auto  col-md-4'>
    <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' />
    <button class='btn btn-outline-success' type='submit'>
      Search</button>
  </form>
  <ul class='navbar-nav ml-auto align-items-center'>
    <li class='nav-item'>
      <div class='profile-icon-container'>
        <img id='profile-icon' src='../../img/person.svg' alt='Profile' />
        <div class='login' id='login-form'>
          <div class='login-triangle'></div>";
  if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
    echo "<div class='login-triangle'></div>
              <img src='../../img/user.svg'/>
              <div>" . $_SESSION['nombre'] . "(" . $_SESSION['usuario'] . ")</div>
              <div><a href='user.php' target='_blank'>Ir al perfil</a></div>
              <form action='" . $_SERVER['PHP_SELF'] . "' method='post' class='form-container'>
                <input type='submit' class='exit' name='salir' value='Salir'>
              </form>";
  } else {
    echo "<form class='login-container' action='login/login.php' method='post'>
            <h2 class='login-header'>Iniciar Sesion</h2>
            <p><input type='email' id='correo' name='correo' placeholder='Correo'></p>
            <p><input type='password' id='pass' name='pass' placeholder='Contraseña'></p>
            <p><input class='botonLogin' type='submit' value='Acceder'></p>
            <a id='enlaceContraseña' href=\"#\" onclick=\"reemplazoLogin()\">No recuerdo mi contraseña</a>
            <hr>
            <p>¿Aún no tienes cuenta?</p>
            <!-- Tenemos que poner type button porque si ponemos type submit necesitamos el rellenar el email y pass -->
            <p><input type='button' class='registro' onclick=\"window.location.href='login/registro.php'\" value='Regístrate'></p>            </form>";
  }
  //Tenemos que poner las comillas dobles para que funcione
  
  echo "</div>
      </div>
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
          <a class='nav-link'  href='eventos/event_pages/festivales.php'>Festivales</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='eventos/event_pages/conciertos.php'>Conciertos</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='eventos/event_pages/teatro.php'>Teatro</a>
        </li>
        <li class='nav-item'>
        <a class='nav-link' href='eventos/event_pages/cine.php'>Cine</a>
      </li>   <li class='nav-item'>
      <a class='nav-link' href='eventos/event_pages/ferias.php'>Ferias</a>
    </li>
      </ul>

    </div>
  </div>
</nav>";
echo "<details><summary>Búsqueda avanzada</summary><div><form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
<select class='form-select' id='festival' name='festival'>
<option value='' disabled selected>Festival</option>";
$query_festival = "SELECT id_festival, nombre_festival FROM festivales";
$result_festival = mysqli_query($con, $query_festival);
while ($row = mysqli_fetch_array($result_festival)) {
  extract($row);
  echo "<option value='$id_festival'>$nombre_festival</option>";
}
echo "</select><select class='form-select' id='provincia' name='provincia'>
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
<div id='eventos'>";

//Se muestra información de todos los festivales que constan en la base de datos
$query = "SELECT * FROM festivales";
$result = mysqli_query($con, $query);
$numFestivales = mysqli_num_rows($result);
if ($numFestivales > 0) {
  while ($row = mysqli_fetch_array($result)) {
    extract($row);
    echo "<script>let eventos=document.getElementById('eventos'); eventos.innerHTML += \"<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'><div class='row g-0'><div class='col-md-4'><div><img style='border-radius: 10px; padding: 5px' width='270px' height='auto' src='$imagen_festival' alt='cartel'></div></div><div class='col-md-8'><div class='card-body'>";
    if ($abono == 0) {
      $coste = "Gratuito";
    } else {
      $coste = $abono . "€";
    }
    echo "<h3>$nombre_festival</h3>";
    
    $result_festival = festivales($con, $id_festival);
    $num_conciertos = mysqli_num_rows($result_festival);
    //Mostrará una lista de conciertos por festival
    if ($num_conciertos > 0) {
      //Solo se muestra información de la provincia si hay conciertos asociados al festival
      $provincia =consulta_provincia($con, $id_festival);
      echo "<div>Provincia: $provincia</div><div><details><summary>Conciertos:</summary><ul>";
      while ($row = mysqli_fetch_array($result_festival)) {
        extract($row);
        echo "<li>";
        if ($web_grupo != "") {
          echo "<span><a href='$web_grupo'>$nombre_grupo</a></span>";
        } else {
          echo "<span><a href='#'>$nombre_grupo</a></span>";
        }
        echo "<span> Fecha concierto: $f_concierto</span></li>";
      }
      echo "</ul></details></div>";
    } else {
      echo "<div>No consta información para este festival</div>";
    }
    echo "<div><span>Inicio: $fecha_inicio</span><span> Fin: $fecha_fin</span></div><div>Precio abono: $coste</div><div>Web festival: <a href=\'$web_festival\'>$nombre_festival</a></div>";
    if ($info_festival != '') {
      echo "<div>Otra información: $info_festival</div>";
    }
    //Solo se muestra el botón para añadir como favorito si el usuario está registrado
    if(isset($_SESSION['usuario'])&&$_SESSION['tipoUsuario']!=0){
      echo "<div class='d-flex justify-content-end'><button type='submit' name='add_favorito' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
    }
    echo "</div></div></div></div>\"</script>";
  }
} else {
  echo "<script>document.getElementById('eventos').innerHTML += 'No se ha encontrado ninguna coincidencia'</script>";
}

##Filtros
//Consulta información de un determinado festival
if (isset($_POST['festival']) && isset($_POST['consultar'])) {
  //Consulta datos por festival
  $query_festival = "SELECT * FROM festivales WHERE id_festival = $_POST[festival]";
  extract(mysqli_fetch_array(mysqli_query($con, $query_festival)));
  echo "<script>document.getElementById('eventos').innerHTML = ''</script>";
  echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'><div class='row g-0'><div class='col-md-4'><div><img style='border-radius: 10px; padding: 5px' width='270px' height='auto' src='$imagen_festival' alt='cartel'></div></div><div class='col-md-8'><div class='card-body'>";
  echo "<h3>$nombre_festival</h3>";
  if ($abono == 0) {
    $coste = "Gratuito";
  } else {
    $coste = $abono . "€";
  }
  $query_provincia = "SELECT DISTINCT p.provincia, e.ubicacion FROM eventos e INNER JOIN provincias p ON e.id_provincia = p.id_provincia WHERE e.id_festival = $_POST[festival]";
  $result_provincia = mysqli_query($con, $query_provincia);
  extract($row = mysqli_fetch_array($result_provincia));
  $fecha_inicio = date("j F Y H:i", strtotime($fecha_inicio));
  $fecha_fin = date("j F Y", strtotime($fecha_fin));
  $result_festival = festivales($con, $_POST['festival']);
  $num_conciertos = mysqli_num_rows($result_festival);
  if ($num_conciertos > 0) {
    //Solo se muestra información de la provincia si hay conciertos asociados al festival
    $provincia =consulta_provincia($con, $id_festival);
    echo "<div>Provincia: $provincia</div><div><details><summary>Conciertos:</summary><ul>";
    while ($row = mysqli_fetch_array($result_festival)) {
      extract($row);
      echo "<li>";
      if ($web_grupo != "") {
        echo "<span><a href='$web_grupo'>$nombre_grupo</a></span>";
      } else {
        echo "<span><a href='#'>$nombre_grupo</a></span>";
      }
      echo "<span> Fecha concierto: $f_concierto</span></li>";
    }
    echo "</ul></details></div>";
  }else {
    echo "<div>No consta información para este festival</div>";
  }
  echo "<div><span>Inicio: $fecha_inicio</span><span> Fin: $fecha_fin</span></div><div>Precio abono: $coste</div><div>Web festival: <a href=\'$web_festival\'>$web_festival</a></div>";
  if ($info_festival != '') {
    echo "<div>Otra información: $info_festival</div>";
  }
  //Solo se muestra el botón para añadir como favorito si el usuario está registrado
  if(isset($_SESSION['usuario'])&&$_SESSION['tipoUsuario']!=0){
    echo "<div class='d-flex justify-content-end'><button type='submit' name='add_favorito' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
  }
  echo "</div></div></div></div>\";</script>";
}

//Consulta información de festivales por rango de fechas
if (isset($_POST['f_inicio']) && isset($_POST['f_fin']) && isset($_POST['consultar'])) {
  //Consulta datos por festival
  $query_festivales = festivalesFecha($con, $_POST['f_inicio'], $_POST['f_fin']);
  $num_festivales = mysqli_num_rows($query_festivales);
  if ($num_festivales > 0) {
    echo "<script>document.getElementById('eventos').innerHTML = ''</script>";
    while ($row = mysqli_fetch_array($query_festivales)) {
      extract($row);
      echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'><div class='row g-0'><div class='col-md-4'><div><img style='border-radius: 10px; padding: 5px' width='270px' height='auto' src='$imagen_festival' alt='cartel'></div></div><div class='col-md-8'><div class='card-body'>";
      if ($abono == 0) {
        $coste = "Gratuita";
      } else {
        $coste = $abono . "€";
      }
      echo "<h3>$nombre_festival</h3>";
      $fecha_inicio = date("j F Y H:i", strtotime($fecha_inicio));
      $fecha_fin = date("j F Y", strtotime($fecha_fin));
      $result_festival = festivales($con, $id_festival);
      $num_conciertos = mysqli_num_rows($result_festival);
      if ($num_conciertos > 0) {
        $provincia =consulta_provincia($con, $id_festival);
        echo "<div>Provincia: $provincia</div><div><details><summary>Conciertos:</summary><ul>";
        while ($row = mysqli_fetch_array($result_festival)) {
          extract($row);
          echo "<li>";
          if ($web_grupo != "") {
            echo "<span><a href='$web_grupo'>$nombre_grupo</a></span>";
          } else {
            echo "<span><a href='#'>$nombre_grupo</a></span>";
          }
          echo "<span>Fecha concierto: $f_concierto</span></li>";
        }
        echo "</ul></details></div>";
      }else {
        echo "<div>No consta información para este festival'</div>";
      }
      if ($info_festival != '') {
        echo "<div>Otra información: $info_festival</div>";
      }
      //Solo se muestra el botón para añadir como favorito si el usuario está registrado
      if(isset($_SESSION['usuario'])&&$_SESSION['tipoUsuario']!=0){
        echo "<div class='d-flex justify-content-end'><button type='submit' name='add_favorito' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
      }
      echo "</div></div></div></div>\";</script>";
    }
  }
}
//Consulta de festivales por provincia
if (isset($_POST['provincia']) && isset($_POST['consultar'])) {
  $query_festivales = festivalesProvincia($con, $_POST['provincia'], $_POST['f_inicio'], $_POST['f_fin']);
  $num_festivales = mysqli_num_rows($query_festivales);
  if ($num_festivales > 0) {
    $query_provincia = "SELECT provincia FROM provincias WHERE id_provincia = $_POST[provincia]";
    $result_provincia = mysqli_query($con, $query_provincia);
    extract($row = mysqli_fetch_array($result_provincia));
    echo "<script>const titulo = document.createElement('h3'); document.body.insertBefore(titulo, eventos);titulo.innerHTML = 'Resultados para la provincia de $provincia';</script>";
    echo "<script>document.getElementById('eventos').innerHTML = ''</script>";
    while ($row = mysqli_fetch_array($query_festivales)) {
      extract($row);
      echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'><div class='row g-0'><div class='col-md-4'><div><img style='border-radius: 10px; padding: 5px' width='270px' height='auto' src='$imagen_festival' alt='cartel'></div></div><div class='col-md-8'><div class='card-body'>";
      if ($abono == 0) {
        $coste = "Gratuita";
      } else {
        $coste = $abono . "€";
      }
      echo "<h3>$nombre_festival</h3>";
      $fecha_inicio = date("j F Y H:i", strtotime($fecha_inicio));
      $fecha_fin = date("j F Y", strtotime($fecha_fin));
      $result_festival = festivales($con, $id_festival);
      $num_conciertos = mysqli_num_rows($result_festival);
      if ($num_conciertos > 0) {
        $provincia =consulta_provincia($con, $id_festival);
        echo "<div>Provincia: $provincia</div><div><details><summary>Conciertos:</summary><ul>";
        echo "<div><span>Conciertos:</span><ul>";
        while ($row = mysqli_fetch_array($result_festival)) {
          extract($row);
          echo "<li>";
          if ($web_grupo != "") {
            echo "<span><a href='$web_grupo'>$nombre_grupo</a></span>";
          } else {
            echo "<span><a href='#'>$nombre_grupo</a></span>";
          }
          echo "<span>Fecha concierto: $f_concierto</span></li>";
        }
        echo "</ul></details></div>";
      } else {
        echo "<div>No consta información para este festival'</div>";
      }
      if ($info_festival != '') {
        echo "<div>Otra información: $info_festival</div>";
      }
      //Solo se muestra el botón para añadir como favorito si el usuario está registrado
      if(isset($_SESSION['usuario'])&&$_SESSION['tipoUsuario']!=0){
        echo "<div class='d-flex justify-content-end'><button type='submit' name='add_favorito' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
      }
      echo "</div></div></div></div>\";</script>";
    }
  }
}
echo "</div>";

//Función que devuelve la provincia donde se celebra un determinado festival
function consulta_provincia($con, $id_festival) {
  $query = "SELECT DISTINCT  p.provincia FROM eventos e LEFT JOIN festivales f ON e.id_festival = f.id_festival INNER JOIN provincias p ON e.id_provincia = p.id_provincia WHERE e.id_festival = $id_festival";
  $result= mysqli_query($con, $query);
  while($row=mysqli_fetch_array($result)){
    extract($row);
    return $provincia;
  }
}
?>
<script src="../../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>