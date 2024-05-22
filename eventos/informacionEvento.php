<link rel="stylesheet" href="../css/styleNavbar.css" />

<link rel="stylesheet" href="../css/styleInfoEventos.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<html>

<body>
  <?php
  session_start();
  require("../database/datos.php");
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
<a class='navbar-brand mr-auto' href='../index.php'>
    <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
    <img src='../img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' />
</a>
<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
  <span class='navbar-toggler-icon'></span>
</button>
<div class='collapse navbar-collapse' id='navbarSupportedContent'>
  <ul class='navbar-nav ml-4'><!-- mx-auto mb-2 mb-lg-0   ml-auto o ml- te da un margen a la izquierda y mr- a la derecha si offset-1-->

      <a class='nav-link' href='../noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
        noticias
      </a>
    </li>
    <li class='nav-item ocultar-div'>
      <a class='nav-link' href='../login/loginResponsive.php'>Login <span class='sr-only'>(current)</span></a>
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
        <img id='profile-icon' src='../img/person.svg' alt='Profile' />
        <div class='login' id='login-form'>
          <div class='login-triangle'></div>";
  if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
    echo "<div class='login-triangle'></div>
              <img src='../img/user.svg'/>
              <div>" . $_SESSION['nombre'] . "(" . $_SESSION['usuario'] . ")</div>
              <div><a href='../user.php' target='_blank'>Ir al perfil</a></div>
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
            <p><input type='button' class='registro' onclick=\"window.location.href='../login/registro.php'\" value='Regístrate'></p>            </form>";
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
          <a class='nav-link'  href='../eventos/event_pages/festivales.php'>Festivales</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='../eventos/event_pages/conciertos.php'>Conciertos</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='../eventos/event_pages/teatro.php'>Teatro</a>
        </li>
        <li class='nav-item'>
        <a class='nav-link' href='../eventos/event_pages/cine.php'>Cine</a>
      </li>   <li class='nav-item'>
      <a class='nav-link' href='../eventos/event_pages/ferias.php'>Ferias</a>
    </li>
      </ul>

    </div>
  </div>
</nav>
<section>
";
  // Conexión a la base de datos

  if (isset($_GET['id_evento'])) {
    $id_evento = $_GET['id_evento'];
    $query_evento = "SELECT e.*, g.nombre_grupo, g.web_grupo, g.info_grupo, p.provincia FROM eventos e LEFT JOIN grupos g ON e.id_grupo = g.id_grupo INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.id_evento = ?";
    $stmt = $con->prepare($query_evento);
    $stmt->bind_param("i", $id_evento);
    $stmt->execute();
    $result_evento = $stmt->get_result();

    if ($row = $result_evento->fetch_assoc()) {
      // Mostrar la información del evento
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
      // Es para cambiar la manera de enseñar la fecha 
      $datetime = $fecha_inicio;
      $date = DateTime::createFromFormat('j F, Y H:i', $datetime);

      if ($date === false) {
        // Manejar el error si la fecha no pudo ser creada
        echo "Error al analizar la cadena de tiempo.";
      } else {
        // Establecer la configuración regional a español
        setlocale(LC_TIME, 'es_ES.UTF-8');

        // Formatear la fecha al formato deseado
        $formattedDate = strftime("%A %e de %B", $date->getTimestamp());

        // Convertir la primera letra de la cadena a mayúscula
        $formattedDate = ucfirst($formattedDate);
      }
      //Para solo coger la hora
      $dateHora = DateTime::createFromFormat('j F, Y H:i', $datetime);

      if ($dateHora === false) {
        // Manejar el error si la fecha no pudo ser creada
        echo "Error al analizar la cadena de tiempo.";
      } else {
        // Obtener solo la hora en formato de 24 horas (H:i)
        $time = $dateHora->format('H:i');
      }

      echo "
   <section>
   <div class='image-container'>
   <img src='$imagen_evento' class='imagenEventoInfo blur'>
   <img src='$imagen_evento' class='imagenEventoInfo clear'>
</div>
    <p class='tituloEvento'>$nombre_evento</p>
    <div>
  
    <p class='titulo'>Fecha y hora</p>
     
     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-calendar-event' viewBox='0 0 16 16'>
  <path d='M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z'/>
  <path d='M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z'/>
</svg> </span>
$formattedDate
$time
    </div></br>
    <div>
    <p class='titulo'> 
    Ubicación
    </p> 
    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-geo-alt' viewBox='0 0 16 16'>
  <path d='M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10'/>
  <path d='M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6'/>
</svg></span>
  
    $provincia</div></br>

    <div>
    <p class='titulo'>Precio</p>
    $coste
    </div>
    <div>
    <p class='titulo'>Acerca de este evento</p>
    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock' viewBox='0 0 16 16'>
  <path d='M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z'/>
  <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0'/>
</svg>
    poner duracion
    <p>$info_evento</p>
    </div>

       ";
      if ($web_evento != '') {
        echo "<div>Web: <a href='$web_evento'>$web_evento</a></div>";
      }

      if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
        echo "<div class='d-flex justify-content-end'><button type='submit' name='add_favorito' style='border: none; background: none;'><img id='star-icon' src='../img/star.svg' alt='Star'/></button></div>";
      }
    } else {
      echo "<div class='alert alert-danger'>No se encontró el evento.</div>";
    }
    $stmt->close();
  } else {
    echo "<div class='alert alert-danger'>No se proporcionó ningún ID de evento.</div>";
  }

  echo "</section>";
  ?>

  <footer class='bg-success text-white text-center text-lg-start footer '>
    <!-- Grid container -->


    <!-- Copyright -->
    <div class='text-center p-3 footerCopyright' style='background-color: rgba(0, 0, 0, 0.2);'>
      © 2024 Copyright:
      <a class='text-white' href=''>ApePlanner</a>
    </div>
    <!-- Copyright -->
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>