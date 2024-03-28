<link rel="stylesheet" href="css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<html>

<body>
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
<!-- Popup de inicio de sesión -->
<nav id='barra_navegacion main-navbar' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
<div class='container-fluid'>
<a class='navbar-brand mr-auto' href='index.php'>
  <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
  <img src='img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' />
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
      <a class='nav-link' href='../../noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
        noticias
      </a>
    </li>
    <li class='nav-item ocultar-div'>
      <a class='nav-link ' href='login/loginResponsive.php'>Login <span class='sr-only'>(current)</span></a>
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
        <img id='profile-icon' src='img/person.svg' alt='Profile' />
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
            <p><input type='button' class='registro' onclick='window.location.href = 'login/registro.php'' value='Regístrate'></p>
          </form>
        </div>
      </div>
    </li>
  </ul>
</div>
</div>
</nav>
<section>
<div class='card mb-3' style='max-width: 70%;'>
  <div class='row g-0'>
    <div class='col-md-4'>
      <img id='imgInfo' src='https://doggiesintown.com/wp-content/uploads/2023/08/El-Fascinante-Mundo-del-Perro-Salchicha-Explorando-su-Historia-Crianza-y-Personalidad-Unica-Doggies-in-Town-1200x676-5.jpg' alt='imgInfo' style='max-width: 100%; height: auto;' />
    </div>
    <div class='col-md-8'>
      <div class='card-body'>
        <h5 class='card-title'>Card title</h5>
        <p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <div class='row'>

          <div class='col-md-11'>
            <button onclick='window.location.href = 'https://doggiesintown.com/wp-content/uploads/2023/08/El-Fascinante-Mundo-del-Perro-Salchicha-Explorando-su-Historia-Crianza-y-Personalidad-Unica-Doggies-in-Town-1200x676-5.jpg''>Ir al enlace</button>
          </div>
          <div class='star-icon-container col-md-4¡1'>
            <a href=''>
              <img id='star-icon' src='img/star.svg' alt='Star' />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<section>
  <div id='recientes'>
    <h2>Planes más próximos</h2>
    <div style='padding: 10px; margin: 10px'>
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
      <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
      $query_categoria = "SELECT * FROM tipo_eventos";
      $result= mysqli_query($con, $query_categoria);
      while ($row = mysqli_fetch_array($result)) {
        extract($row);
        echo "<input type='checkbox' name='categoria[]' value='$id_tipo'>$categoria_evento";
      }
    echo "<input type='checkbox' name='festivales'>Festivales
        <input class='btn btn-primary' type='submit' id='consultar' name='consultar' value='Consultar'/>
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
  } else if (isset($_POST['consultar']) && empty($_POST['categoria'])) {
    echo "<script>alert('Selección no valida');</script>";
  }
  echo "</div></section>";
  ?>

  <footer class='bg-success text-white text-center text-lg-start footer '>
    <!-- Grid container -->
    <div class='container p-4 footerInfo'>
      <!--Grid row-->
      <div class='row'>
        <!--Grid column-->
        <div class='col-lg-6 col-md-12 mb-4 mb-md-0'>
          <h5 class='text-uppercase'>Sobre Nosotros</h5>

          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
            molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
            voluptatem veniam, est atque cumque eum delectus sint!
          </p>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class='col-lg-3 col-md-6 mb-4 mb-md-0'>
          <h5 class='text-uppercase'>Links</h5>

          <ul class='list-unstyled mb-0'>
            <li>
              <a href='#!' class='text-white'>Link 1</a>
            </li>
            <li>
              <a href='#!' class='text-white'>Link 2</a>
            </li>
            <li>
              <a href='#!' class='text-white'>Link 3</a>
            </li>
            <li>
              <a href='#!' class='text-white'>Link 4</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class='col-lg-3 col-md-6 mb-4 mb-md-0'>
          <h5 class='text-uppercase mb-0'>Links</h5>

          <ul class='list-unstyled'>
            <li>
              <a href='#!' class='text-white'>Link 1</a>
            </li>
            <li>
              <a href='#!' class='text-white'>Link 2</a>
            </li>
            <li>
              <a href='#!' class='text-white'>Link 3</a>
            </li>
            <li>
              <a href='#!' class='text-white'>Link 4</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>

    <!-- Copyright -->
    <div class='text-center p-3 footerCopyright' style='background-color: rgba(0, 0, 0, 0.2);'>
      © 2024 Copyright:
      <a class='text-white' href=''>ApePlanner</a>
    </div>
    <!-- Copyright -->
  </footer>"

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>