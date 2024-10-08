<link rel="stylesheet" href="../../css/styleNavbar.css" />
<link rel="stylesheet" href="../../css/styleCards.css" />

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
  <title>Festivales</title>
</head>";

echo "</div>
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
  <li class='nav-item'>
    <a class='nav-link' href='../../index.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
  Inicio
  </a>
  </li>
  <li class='nav-item'>
      <a class='nav-link' href='../../noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
        Noticias
      </a>
    </li>
  </ul>
  <div class='d-flex mx-auto  col-md-4'>
  </div>";
  if(isset($_SESSION['usuario'])) {
    if($_SESSION['tipoUsuario'] == 0){
      echo "<li class='nav-item'>
      <a class='nav-link navlink' href='../../admin/admin.php' role='button' aria-haspopup='true' aria-expanded='false'>Panel administrador
      </a>
    </li>";
    }else{
      echo "<li class='nav-item'>
      <a class='nav-link navlink' href='../../user.php' role='button' aria-haspopup='true' aria-expanded='false' style='font-weight: bold;'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."
      </a>
    </li>";
    }
  }
  //ml-auto
  echo"  <ul class='navbar-nav  align-items-center'>
    <li class='nav-item'>
      <div class='profile-icon-container'>
        <img id='profile-icon' src='../../img/person.svg' alt='Profile' />
        <div class='login' id='login-form'>
          <div class='login-triangle'></div>";
            //Cambio se muestra login del usuario administrador en index.php
  if (isset($_SESSION['usuario'])) {
    echo "<div class='login-container' style='min-width: 200px;'>
    <div class='row justify-content-center align-items-center'><img src='../../img/person.png' alt='profile_image'/></div>";
          if(isset($_SESSION['usuario'])){
            if($_SESSION['tipoUsuario'] == 0){
              echo"<div class='row justify-content-center align-items-center'><a href='../../admin/admin.php' target='_blank'><div class='row justify-content-center align-items-center' style='margin-top: 10px;'><a href='../../user.php' target='_blank'><div class='row justify-content-center align-items-center'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."</div><div class='row justify-content-center align-items-center'>(".$_SESSION['usuario'].")</div></a></div></a></div>
              <div class='row justify-content-center align-items-center' style='margin-top: 10px;'>Administrador</div>";
            }else{
              //Solo se muestra enlace al perfil de usuario si no es administrador
              echo"<div class='row justify-content-center align-items-center' style='margin-top: 10px;'><a href='../../user.php' target='_blank'><div class='row justify-content-center align-items-center'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."</div><div class='row justify-content-center align-items-center'>(".$_SESSION['usuario'].")</div></a></div>";
            }
          }
          if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] == 2) {
            echo"<div class='	row justify-content-center align-items-center' style='margin-top: 10px;'>Accede desde a aquí a la gestión de eventos</div>
            <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='../../eventos/alta_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='../../img/journal-text.svg' alt='alta eventos'/> Alta de eventos</div>
            <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='../../admin/gestion_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='../../img/pencil.svg' alt='editar eventos'/> Editar eventos</a></button></div>";
          }
          echo"<div class='row justify-content-center align-items-center' style='margin-top: 10px;'>
          <a href='../../login/logout.php'><button type='button' class='btn btn-primary'>Salir</button></a></div>
          </div>";
} else {
echo "<form class='login-container' action='../../login/login.php' method='post'>
        <h2 class='login-header'>Iniciar Sesion</h2>
        <p><input type='email' id='correo' name='correo' placeholder='Correo'></p>
        <p><input type='password' id='pass' name='pass' placeholder='Contraseña'></p>
        <p><input class='botonLogin' type='submit' value='Acceder'></p>
        <a id='enlaceContraseña' href=\"#\" onclick=\"reemplazoLogin()\">No recuerdo mi contraseña</a>
        <hr>
        <p>¿Aún no tienes cuenta?</p>
        <!-- Tenemos que poner type button porque si ponemos type submit necesitamos el rellenar el email y pass -->
        <p><input type='button' class='registro' onclick='window.location.href = \"../../login/registro.php\"' value='Regístrate'></p>
      </form>";
}
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
          <a class='nav-link active' style='font-weight:bold;'  href='../../eventos/event_pages/festivales.php'>Festivales</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='../../eventos/event_pages/conciertos.php'>Conciertos</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='../../eventos/event_pages/teatro.php'>Teatro</a>
        </li>
        <li class='nav-item'>
        <a class='nav-link' href='../../eventos/event_pages/cine.php'>Cine</a>
      </li>   <li class='nav-item'>
      <a class='nav-link' href='../../eventos/event_pages/ferias.php'>Ferias</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='../../eventos/event_pages/otros_eventos.php'>Más</a>
  </li>
      </ul>

    </div>
  </div>
</nav>";

echo "</div>";
//Aplicados estilos Bootstrap 4 a los controles del formulario y modificada presentación conciertos a formato tabla
//Modificado desde aquí
echo "<div  style='margin: 10px; padding: 10px'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
<select class='custom-select-sm w-15' id='festival' name='festival' style='font-size: .8em;'>
<option value='' disabled selected>Festival</option>";
$query_festival = "SELECT id_festival, nombre_festival FROM festivales";
$result_festival = mysqli_query($con, $query_festival);
while ($row = mysqli_fetch_array($result_festival)) {
  extract($row);
  echo "<option value='$id_festival'>$nombre_festival</option>";
}
echo "</select>&nbsp<select class='custom-select-sm w-15' id='provincia' name='provincia' style='font-size: .8em;'>
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
echo "</select>
<label for='f_inicio'>Desde:</label>
<input type='date'id='f_inicio' name='f_inicio' id='f_inicio' style='font-size: .8em'>
<label for='f_fin'>hasta:</label>
<input type='date' id ='f_fin' name='f_fin' id='f_fin' style='font-size: .8em'>
<input class='btn btn-primary btn-sm' type='submit' id='consultar' name='consultar' value='Consultar'/>
<button class='btn btn-secondary btn-sm' type='reset' id='eliminar' name='eliminar'>Eliminar seleccion</button></form></div>

<div class='main-content' id='eventos'>";
//Modificado hasta aqui

// Se muestra información de todos los festivales que constan en la base de datos
$query = "SELECT * FROM festivales";
$result = mysqli_query($con, $query);
$numFestivales = mysqli_num_rows($result);
if ($numFestivales > 0) {
  while ($row = mysqli_fetch_array($result)) {
    extract($row);
    echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto cardGeneral shadow-sm p-3 mb-5 bg-white rounded' onclick='redirectToFestival($id_festival)'><div class='row g-0'><div class='col-md-4 cardDiv'><div><img src='$imagen_festival' class='responsive-img'></div></div><div class='col-md-8'><div class='card-body'>";
    if ($abono == 0) {
      $coste = "Gratuito";
    } else {
      $coste = $abono . "€";
    }
    echo "<h3>$nombre_festival</h3>";
    
    echo "<div><span>Inicio: $fecha_inicio</span><span> Fin: $fecha_fin</span></div><div>Precio abono: $coste</div><div>Web festival: <a href=\'$web_festival\'>$nombre_festival</a></div>";
    if ($info_festival != '') {
      echo "<div>Otra información: $info_festival</div>";
    }
    //Solo se muestra el botón para añadir como favorito si el usuario está registrado
    if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
      echo "<div class='d-flex justify-content-end' onclick='event.stopPropagation()'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><button type='submit' name='favorito' value='$id_festival' style='border: none; background: none;'><img id='star-icon' src='../../img/star.svg' alt='Star'/></button></form></div>";
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
  $query_festival = "SELECT * FROM festivales WHERE id_festival =". $_POST['festival']."";
  extract(mysqli_fetch_array(mysqli_query($con, $query_festival)));
  echo "<script>document.getElementById('eventos').innerHTML = ''</script>";
  echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto cardGeneral shadow-sm p-3 mb-5 bg-white rounded' onclick='redirectToFestival($id_festival)'><div class='row g-0'><div class='col-md-4 cardDiv'><div><img src='$imagen_festival' class='responsive-img'></div></div><div class='col-md-8'><div class='card-body'>";
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
    echo "<div>Provincia: $provincia</div>";
  }else {
    echo "<div>No consta información para este festival</div>";
  }
  echo "<div><span>Inicio: $fecha_inicio</span><span> Fin: $fecha_fin</span></div><div>Precio abono: $coste</div><div>Web festival: <a href=\'$web_festival\'>$web_festival</a></div>";
  if ($info_festival != '') {
    echo "<div>Otra información: $info_festival</div>";
  }
  //Solo se muestra el botón para añadir como favorito si el usuario está registrado
  if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
    echo "<div class='d-flex justify-content-end' onclick='event.stopPropagation()'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><button type='submit' name='favorito' value='$id_festival' style='border: none; background: none;'><img id='star-icon' src='../../img/star.svg' alt='Star'/></button></div>";
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
      echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto cardGeneral shadow-sm p-3 mb-5 bg-white rounded' onclick='redirectToFestival($id_festival)'><div class='row g-0'><div class='col-md-4 cardDiv'><div><img src='$imagen_festival' class='responsive-img'></div></div><div class='col-md-8'><div class='card-body'>";
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
        echo "<div>Provincia: $provincia</div>";
      }else {
        echo "<div>No consta información para este festival'</div>";
      }
      echo "<div><span>Inicio: $fecha_inicio</span><span> Fin: $fecha_fin</span></div><div>Precio abono: $coste</div><div>Web festival: <a href=\'$web_festival\'>$web_festival</a></div>";
      if ($info_festival != '') {
        echo "<div>Otra información: $info_festival</div>";
      }
      //Solo se muestra el botón para añadir como favorito si el usuario está registrado
      if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
        echo "<div class='d-flex justify-content-end' onclick='event.stopPropagation()'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><button type='submit' name='favorito' value='$id_festival' style='border: none; background: none;'><img id='star-icon' src='../../img/star.svg' alt='Star'/></button></div>";
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
      echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto cardGeneral shadow-sm p-3 mb-5 bg-white rounded' onclick='redirectToFestival($id_festival)'><div class='row g-0'><div class='col-md-4 cardDiv'><div><img src='$imagen_festival' class='responsive-img'></div></div><div class='col-md-8'><div class='card-body'>";
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
        echo "<div>Provincia: $provincia</div>";
      } else {
        echo "<div>No consta información para este festival'</div>";
      }
      echo "<div><span>Inicio: $fecha_inicio</span><span> Fin: $fecha_fin</span></div><div>Precio abono: $coste</div><div>Web festival: <a href=\'$web_festival\'>$web_festival</a></div>";
      if ($info_festival != '') {
        echo "<div>Otra información: $info_festival</div>";
      }
      //Solo se muestra el botón para añadir como favorito si el usuario está registrado
      if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
        echo "<div class='d-flex justify-content-end' onclick='event.stopPropagation()'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><button type='submit' name='favorito' id='$id_festival' style='border: none; background: none;'><img id='star-icon' src='../../img/star.svg' alt='Star'/></button></form></div>";
      }
      echo "</div></div></div></div>\";</script>";
    }
  }
}
echo "</div>";

if(isset($_POST['favorito'])&&isset($_SESSION['id_usuario'])&&!empty($_POST['favorito'])) { 
  $result=mysqli_query($con, "SELECT * FROM usuarios_eventos WHERE id_festival=" . $_POST['favorito'] . " AND id_usuario=" . $_SESSION['id_usuario']);
  $num_eventos=mysqli_num_rows($result);
  //Comprobamos si existe el registro en la base de datos 
  if($num_eventos==0){
    $query_fav="INSERT INTO usuarios_eventos (id_usuario, id_festival) VALUES (".$_SESSION['id_usuario'].",". $_POST['favorito'].")";
    mysqli_query($con, $query_fav);
    echo"<script>alert('Favorito añadido');</script>";
  }else{
    echo"<script>alert('Favorito ya añadido');</script>";
  }
}

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
<footer>
    <div class="text-center p-3 footerCards" >
        © 2024 Copyright:
        <a class="text-white" href="">City Planner</a>
    </div>
</footer>
<script src="../../script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>