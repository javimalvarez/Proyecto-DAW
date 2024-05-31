<link rel="stylesheet" href="../css/styleNavbar.css" />

<link rel="stylesheet" href="../css/styleInfoEventos.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<html>

<body>
  <?php
  session_start();
  require("../database/datos.php");
  date_default_timezone_set('Europe/Madrid');
  $fecha = date("Y-m-d");
  $coste = "";
  setlocale(LC_TIME, 'es_ES.UTF-8');
  $query_nombre="SELECT * FROM festivales WHERE id_festival =".$_GET['id_festival']."";
  $result = mysqli_query($con, $query_nombre);
  $festival = mysqli_fetch_array($result);
  echo "<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>".$festival['nombre_festival']."</title>
  <head>
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
    <li class='nav-item'>
      <a class='nav-link' href='../index.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
    Inicio
    </a>
    </li>
    <li class='nav-item'>
        <a class='nav-link' href='../noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
          Noticias
        </a>
      </li>
    </ul>
    <div class='d-flex mx-auto  col-md-4'>
      
    </div>";
    if(isset($_SESSION['usuario'])) {
      if($_SESSION['tipoUsuario'] == 0){
        echo "<li class='nav-item'>
        <a class='nav-link navlink' href='../admin/admin.php' role='button' aria-haspopup='true' aria-expanded='false'>Panel administrador
        </a>
      </li>";
      }else{
        echo "<li class='nav-item'>
        <a class='nav-link navlink' href='../user.php' role='button' aria-haspopup='true' aria-expanded='false' style='font-weight: bold;'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."
        </a>
      </li>";
      }
    }
    //ml-auto
    echo"  <ul class='navbar-nav  align-items-center'>
      <li class='nav-item'>
        <div class='profile-icon-container'>
          <img id='profile-icon' src='../img/person.svg' alt='Profile' />
          <div class='login' id='login-form'>
            <div class='login-triangle'></div>";
              //Cambio se muestra login del usuario administrador en index.php
    if (isset($_SESSION['usuario'])) {
      echo "<div class='login-container' style='min-width: 200px;'>
      <div class='row justify-content-center align-items-center'><img src='../img/person.png' alt='profile_image'/></div>";
            if(isset($_SESSION['usuario'])){
              if($_SESSION['tipoUsuario'] == 0){
                echo"<div class='row justify-content-center align-items-center'><a href='../admin/admin.php' target='_blank'><div class='row justify-content-center align-items-center' style='margin-top: 10px;'><a href='../user.php' target='_blank'><div class='row justify-content-center align-items-center'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."</div><div class='row justify-content-center align-items-center'>(".$_SESSION['usuario'].")</div></a></div></a></div>
                <div class='row justify-content-center align-items-center' style='margin-top: 10px;'>Administrador</div>";
              }else{
                //Solo se muestra enlace al perfil de usuario si no es administrador
                echo"<div class='row justify-content-center align-items-center' style='margin-top: 10px;'><a href='../user.php' target='_blank'><div class='row justify-content-center align-items-center'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."</div><div class='row justify-content-center align-items-center'>(".$_SESSION['usuario'].")</div></a></div>";
              }
            }
            if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] == 2) {
              echo"<div class='	row justify-content-center align-items-center' style='margin-top: 10px;'>Accede desde a aquí a la gestión de eventos</div>
              <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='../eventos/alta_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='../img/journal-text.svg' alt='alta eventos'/> Alta de eventos</div>
              <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='../admin/gestion_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='../img/pencil.svg' alt='editar eventos'/> Editar eventos</a></button></div>";
            }
            echo"<div class='row justify-content-center align-items-center' style='margin-top: 10px;'>
            <a href='../login/logout.php'><button type='button' class='btn btn-primary'>Salir</button></a></div>
            </div>";
  } else {
  echo "<form class='login-container' action='../login/login.php' method='post'>
          <h2 class='login-header'>Iniciar Sesion</h2>
          <p><input type='email' id='correo' name='correo' placeholder='Correo'></p>
          <p><input type='password' id='pass' name='pass' placeholder='Contraseña'></p>
          <p><input class='botonLogin' type='submit' value='Acceder'></p>
          <a id='enlaceContraseña' href=\"#\" onclick=\"reemplazoLogin()\">No recuerdo mi contraseña</a>
          <hr>
          <p>¿Aún no tienes cuenta?</p>
          <!-- Tenemos que poner type button porque si ponemos type submit necesitamos el rellenar el email y pass -->
          <p><input type='button' class='registro' onclick='window.location.href = \"../login/registro.php\"' value='Regístrate'></p>
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
            <a class='nav-link'  href='./event_pages/festivales.php'>Festivales</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='./event_pages/conciertos.php'>Conciertos</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='./event_pages/teatro.php'>Teatro</a>
          </li>
          <li class='nav-item'>
          <a class='nav-link' href='./event_pages/cine.php'>Cine</a>
        </li>   <li class='nav-item'>
        <a class='nav-link' href='./event_pages/ferias.php'>Ferias</a>
      </li>
      <li class='nav-item'>
      <a class='nav-link' href='./event_pages/otros_eventos.php'>Más</a>
    </li>
        </ul>
  
      </div>
    </div>
  </nav>
  <section>
  ";
  // Conexión a la base de datos

  if (isset($_GET['id_festival'])) {
    $id_festival = $_GET['id_festival'];
    $query_festival = "SELECT e.id_festival, e.ubicacion, p.provincia, f.* FROM eventos e INNER JOIN provincias p ON p.id_provincia = e.id_provincia LEFT JOIN festivales f ON f.id_festival=e.id_festival WHERE e.id_festival= ?";
    $stmt = $con->prepare($query_festival);
    $stmt->bind_param("i", $id_festival);
    $stmt->execute();
    $result_festival = $stmt->get_result();

    if ($row = $result_festival->fetch_assoc()) {
      // Mostrar la información del festival
      extract($row);

      //REVISAR PRECIO
    //   if ($precio == 0) {
    //     $coste = "Gratuita";
    //   } else {
    //     $coste = $precio . "€";
    //   }
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
   <section class='main-content'>
   <div class='image-container'>
   <img src='$imagen_festival' class='imagenEventoInfo blur'>
   <img src='$imagen_festival' class='imagenEventoInfo clear'>
</div>

    <p class='tituloEvento'>$nombre_festival</p>
    <div class='infoEventoPrincipal'>
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
    <div><p class='titulo'>Conciertos</p><div class='centrarTexto me'><table class='centrarTexto'>";
      $query_conciertos="SELECT e.fecha_inicio AS f_concierto, g.* FROM eventos e LEFT JOIN grupos g ON e.id_grupo = g.id_grupo WHERE id_festival = $id_festival";
      $result_conciertos= $con->query($query_conciertos);
      while($concierto=$result_conciertos->fetch_assoc()){
        extract($concierto);
        $f_concierto = date("j F, Y H:i", strtotime($f_concierto));
        echo "<tr><td>
         <a href='$web_grupo'>$nombre_grupo</a>&nbsp</td><td>&nbsp$f_concierto</td></tr>";
      }
      echo"</table></div></div>";
    echo"<div><br/>
    <p class='titulo'>Precio</p>".
    $abono."€
    </div><br/>
    <div>
    <p class='titulo'>Acerca de este evento</p>
    
    <p>$info_festival</p>
    </div>

       ";
      if ($web_festival != '') {
        echo "<div>Web: <a href='$web_festival'>$web_festival</a></div>";
      }

      
    } else {
      echo "<div class='alert alert-danger'>No se encontró el festival.</div>";
    }
    $stmt->close();
  } else {
    echo "<div class='alert alert-danger'>No se proporcionó ningún ID de festival.</div>";
  }
  echo"<div id='map' class='mapa'></div>";
  echo"</div>";
  echo "</section>";
  ?>
  <footer>
      <div class="text-center p-3 footerCards" >
          © 2024 Copyright:
          <a class="text-white" href="">City Planner</a>
      </div>
  </footer>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCKiIqCdZGrVxx06LSbe7uG3zXOq1Cz5k&callback=initMap" async defer></script>
  <script>
    var map; 
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center:  <?php echo $ubicacion?>,
            zoom: 15
        });
        var marker = new google.maps.Marker({
            position: <?php echo $ubicacion?>,
            map: map, 
            title: '<?php echo $nombre_festival?>'
        });
    }
    window.initMap=initMap;
  </script>
  <script src="../script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>