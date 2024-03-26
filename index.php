<link rel="stylesheet" href="css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();
require("database/datos.php");
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
<div id='alerta'>";

echo "</div>
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
        <a class='dropdown-item' href='eventos/event_pages/festivales.php'>Festivales</a>
        <a class='dropdown-item' href='eventos/event_pages/conciertos.php'>Conciertos</a>
        <a class='dropdown-item' href='eventos/event_pages/teatro.php'>Teatro</a>
        <a class='dropdown-item' href='eventos/event_pages/cine.php'>Cine</a>
        <a class='dropdown-item' href='eventos/event_pages/ferias.php'>Ferias</a>
        <div class='dropdown-divider'></div>
        <a class='dropdown-item' href='eventos/event_pages/otros.php'>Otros</a>
      </div>
      </li>
      <li>
          <a class='nav-link' href='noticias.php' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Noticias
          </a>
      </li>
      <li>
          <a class='nav-link' href='#' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Acerca de nosotros
          </a>
      </li>
      <li>
        <form class='d-flex' role='search'>
          <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' />
          <button class='btn btn-outline-success' type='submit'>
            Search
          </button>
        </form>
      </li>
    </ul>
  </div>
  <div class='navbar-nav ml-auto'>
    <div class='nav-item'>
      <img id='profile-icon' src='img/person.svg' />
      <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
    </div>
  </div> 
</nav>
<div class='login' id='login-form'>
  <div class='login-triangle'></div>
  <form class='login-container' action='login/login.php' method='post'>
  <h2 class='login-header'>Iniciar Sesion</h2>
  <p><input type='email' id='correo' name='correo' placeholder='Correo'></p>
  <p><input type='password' id='pass' name='pass' placeholder='Contraseña'></p>
  <p><input class='botonLogin' type='submit' value='Acceder'></p>
  <a id='enlaceContraseña' href='#'>No recuerdo mi contraseña</a>
  <hr>
  <p>¿Aún no tienes cuenta?</p>
  <!-- Tenemos que poner type button porque si ponemos type submit necesitamos el rellenar el email y pass -->
  <p><input type='button' class='registro' onclick='window.location.href = \"login/registro.php\"' value='Regístrate'></p></form>
</div>
<section>
  <div id='recientes'>
    <h2>Planes más próximos</h2>";
echo "<div style='padding: 10px; margin: 10px'>
      <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
        <label for='f_inicio'>Fecha inicio:</label>
        <input type='date' id='f_inicio' name='f_inicio' id='f_inicio' value='$fecha'>
        <label for='f_fin'>Fecha fin:</label>
        <input type='date' id ='f_fin' name='f_fin' id='f_fin' value='" . date('Y-m-d', strtotime('+4 months')) . "'>
        <input class='btn btn-primary' type='submit' id='consultar' name='consultar' value='Consultar'/>
        <button class='btn btn-secondary' type='reset' id='eliminar' name='eliminar'>Eliminar seleccion</button>
      </form></div>";
//Mostrará una lista de eventos de 4 meses a partir de la fecha actual
$query = "SELECT e.evento, e.ubicacion, e.fecha_inicio, e.fecha_fin, e.precio, e.web_evento, e.imagen_evento, e.info_evento, t.categoria_evento, g.nombre_grupo, g.web_grupo, g.info_grupo, f.nombre_festival, f.web_festival, f.info_festival, p.provincia FROM eventos e LEFT JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo LEFT JOIN festivales f ON f.id_festival = e.id_festival INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.fecha_inicio BETWEEN CURDATE() AND CURDATE()+INTERVAL 4 MONTH";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
  extract($row);
  if ($precio == 0) {
    $coste = "Gratuita";
  } else {
    $coste = $precio . "€";
  }
  if (!empty($fecha_inicio)) {
    $fecha_inicio = date("j F, Y H:i", strtotime($fecha_inicio));
  }
  if (!empty($fecha_fin)) {
    $fecha_fin = date("j F, Y", strtotime($fecha_fin));
  }
  echo "<div style='border: 1px solid black; margin: 10px; padding: 10px; border-radius: 10px;'>
            <div><img src='$imagen_evento'></div>
            <div><img src='$imagen_festival'></div>
            <div>
                <h3>$evento</h3>
                <span><a href='#'>$categoria_evento</a></span>
                <span>Provincia: $provincia</span>
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
                <div><a href='$web_evento'>$web_evento</a></div>
                <span>Entrada: $coste</span>
                <div>Otra información: $info_evento</div>
            </div>
            </div>";
}
echo "</div></section>
<section>
  <div>
    <h2>Planes gratuitos</h2>
    <div style='padding: 10px; margin: 10px'>
      <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
        <select class='form-select' id='categoria' name='categoria[]' multiple>";
$query_categoria = "SELECT * FROM tipo_eventos";
$result = mysqli_query($con, $query_categoria);
while ($row = mysqli_fetch_array($result)) {
  extract($row);
  echo "<option value='$id_tipo'>$categoria_evento</option>";
}
echo "</select><input class='btn btn-primary' type='submit' id='consultar' name='consultar' value='Consultar'/>
        <button class='btn btn-secondary' type='reset' id='eliminar' name='eliminar'>Eliminar seleccion</button>
      </form></div>
      <div id='gratis'>";
$query = "SELECT e.evento, e.ubicacion, e.fecha_inicio, e.fecha_fin, e.precio, e.web_evento, e.imagen_evento, e.info_evento, t.categoria_evento, g.nombre_grupo, g.web_grupo, g.info_grupo, f.nombre_festival, f.web_festival, f.info_festival, p.provincia FROM eventos e LEFT JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo LEFT JOIN festivales f ON f.id_festival = e.id_festival INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.precio = 0 AND e.fecha_inicio BETWEEN CURDATE() AND CURDATE()+INTERVAL 4 MONTH";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
  extract($row);
  if ($precio == 0) {
    $coste = "Gratuita";
  } else {
    $coste = $precio . "€";
  }
  if (!empty($fecha_inicio)) {
    $fecha_inicio = date("j F, Y H:i", strtotime($fecha_inicio));
  }
  if (!empty($fecha_fin)) {
    $fecha_fin = date("j F, Y", strtotime($fecha_fin));
  }
  echo "<div style='border: 1px solid black; margin: 10px; padding: 10px; border-radius: 10px;'>
              <div><img src='$imagen_evento'></div>
              <div><img src='$imagen_festival'></div>
              <div>
                  <h3>$evento</h3>
                  <span><a href='#'>$categoria_evento</a></span>
                  <span>Provincia: $provincia</span>
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
                  <div><a href='$web_evento'>$web_evento</a></div>
                  <span>Entrada: $coste</span>
                  <div>Otra información: $info_evento</div>
              </div>
            </div>";
}
echo "</div>";
if (isset($_POST['categoria']) && !empty($_POST['categoria']) && isset($_POST['consultar'])) {
  $query = "SELECT e.*, t.categoria_evento, g.web_grupo, g.info_grupo, f.web_festival, f.info_festival, p.provincia FROM eventos e INNER JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo LEFT JOIN festivales f ON f.id_festival = e.id_festival INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.id_tipo IN(" . implode(',', $_POST['categoria']) . ") AND e.precio = 0 ";
  $result = mysqli_query($con, $query);
  $num_elementos = mysqli_num_rows($result);
  if ($num_elementos > 0) {
    echo "<script>document.getElementById('gratis').innerHTML = '';</script>";
    while ($row = mysqli_fetch_array($result)) {
      extract($row);
      if ($precio == 0) {
        $coste = "Gratuita";
      } else {
        $coste = $precio . "€";
      }
      if (!empty($fecha_inicio)) {
        $fecha_inicio = date("j F, Y H:i", strtotime($fecha_inicio));
      }
      if (!empty($fecha_fin)) {
        $fecha_fin = date("j F, Y", strtotime($fecha_fin));
      }
      echo "<script>document.getElementById('gratis').innerHTML += \"<div style='border: 1px solid black; margin: 10px; padding: 10px; border-radius: 10px;'><div><img src='$imagen_evento'></div><div><img src='$imagen_festival'></div><div><h3>$evento</h3><span><a href='#'>$categoria_evento</a></span><span> Provincia: $provincia</span><div><span><a href='$web_grupo'>$nombre_grupo</a></span><span>$info_grupo</span><span><a href='$web_festival'>$nombre_festival</a></span><span>$info_festival</span></div><div><span>Fecha: $fecha_inicio</span><span>$fecha_fin</span></div><div><a href='$web_evento'>$web_evento</a></div><span>Entrada: $coste</span><div>Otra información: $info_evento</div></div> \";</script>";
    }
  } else {
    echo "<script>alert('No se ha encontrado ninguna coincidencia ');</script>";
  }
} else if(isset($_POST['consultar']) && empty($_POST['categoria'])) {
  echo "<script>alert('Selección no valida');</script>";
}
echo "</div></section>";

/* <!-- 
    <section>

<div class='card' style='width: 30rem; text-align: center; position:center;'>
  <img src='...' class='card-img-top' alt='...'>
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
      </section>
      <section>
        <div class="card text-center">
            <div class="card-header">
              Featured
            </div>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-body-secondary">
              2 days ago
            </div>
          </div>
      </section>
      <section>
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
          </div>
          
          
      </section>
    <h1>Hello, world!</h1>
    <section> <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </section> -->*/
?>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>