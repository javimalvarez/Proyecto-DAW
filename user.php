<link rel="stylesheet" href="css/styleNavbar.css" />
<link rel="stylesheet" href="css/styleCards.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();
if (!isset($_SESSION['usuario'])||$_SESSION['tipoUsuario']==0){
  header('Location: index.php');
}
require("database/datos.php");
date_default_timezone_set('Europe/Madrid');
$fecha = date("Y-m-d");
$coste="";
setlocale(LC_TIME, 'es_ES.UTF-8');
echo"<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>".$_SESSION['nombre'] . " " . $_SESSION['apellidos'] . "</title>
</head><body>
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
  <li class='nav-item'>
    <a class='nav-link' href='index.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
    Inicio
  </a>
  </li>
  <li class='nav-item'>
      <a class='nav-link' href='noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
        Noticias
      </a>
    </li>";

echo"
  </ul>
  <form class='d-flex mx-auto  col-md-4' method='GET' action='" . $_SERVER['PHP_SELF'] . "'>
    <input class='form-control me-2' type='text' placeholder='Search' name='busqueda' aria-label='Search' />
    <input class='btn btn-outline-success' type='submit' name='buscar' value='Buscar'>
  </form>";
  
  if(isset($_SESSION['usuario'])) {
    if($_SESSION['tipoUsuario'] == 0){
      echo "<li class='nav-item'>
      <a class='nav-link navlink' href='admin/admin.php' role='button' aria-haspopup='true' aria-expanded='false'>Panel administrador
      </a>
    </li>";
    }else{
      echo "<li class='nav-item'>
      <a class='nav-link navlink' href='user.php' role='button' aria-haspopup='true' aria-expanded='false' style='font-weight: bold;'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."
      </a>
    </li>";
    }
  }
  //ml-auto
  echo"  <ul class='navbar-nav  align-items-center'>
    <li class='nav-item'>
      <div class='profile-icon-container'>
        <img id='profile-icon' src='img/person.svg' alt='Profile' />
        <div class='login' id='login-form'>
          <div class='login-triangle'></div>";
            //Cambio se muestra login del usuario administrador en index.php
  if (isset($_SESSION['usuario'])) {
    echo "<div class='login-container' style='min-width: 200px;'>
    <div class='row justify-content-center align-items-center'><img src='img/person.png' alt='profile_image'/></div>";
          if(isset($_SESSION['usuario'])){
            if($_SESSION['tipoUsuario'] == 0){
              echo"<div class='row justify-content-center align-items-center'><a href='admin/admin.php' target='_blank'><div class='row justify-content-center align-items-center' style='margin-top: 10px;'><a href='user.php' target='_blank'><div class='row justify-content-center align-items-center'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."</div><div class='row justify-content-center align-items-center'>(".$_SESSION['usuario'].")</div></a></div></a></div>
              <div class='row justify-content-center align-items-center' style='margin-top: 10px;'>Administrador</div>";
            }else{
              //Solo se muestra enlace al perfil de usuario si no es administrador
              echo"<div class='row justify-content-center align-items-center' style='margin-top: 10px;'><a href='user.php' target='_blank'><div class='row justify-content-center align-items-center'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."</div><div class='row justify-content-center align-items-center'>(".$_SESSION['usuario'].")</div></a></div>";
            }
          }
          if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] == 2) {
            echo"<div class='	row justify-content-center align-items-center' style='margin-top: 10px;'>Accede desde a aquí a la gestión de eventos</div>
            <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='admin/alta_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='img/journal-text.svg' alt='alta eventos'/> Alta de eventos</div>
            <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='admin/gestion_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='img/pencil.svg' alt='editar eventos'/> Editar eventos</a></button></div>";
          }
          echo"<div class='row justify-content-center align-items-center' style='margin-top: 10px;'>
          <a href='login/logout.php'><button type='button' class='btn btn-primary'>Salir</button></a></div>
          </div>";
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
        <p><input type='button' class='registro' onclick='window.location.href = \"login/registro.php\"' value='Regístrate'></p>
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
    <li class='nav-item'>
      <a class='nav-link' href='eventos/event_pages/otros_eventos.php'>Más</a>
    </li>
      </ul>

    </div>
  </div>
</nav>
<section class'main-content'>
<div style='padding:20px'><h2>¡Hola ". $_SESSION['nombre'] ." ". $_SESSION['apellidos']."!</h2></div>
<p style='padding:20px'>Este es tu calendario de eventos</p>
<div class='row justify-content-center align-items-center' >
<div id='calendar'></div>
  </div>
</section>
<section>
<div style='padding:20px'><h4 style='font-weight: bold'>Favoritos de ".$_SESSION['nombre']."</h4>
<p>Aquí estan tus eventos favoritos</p></div>
<div id='eventos'>";

$query_eventos_fav="SELECT * FROM usuarios_eventos WHERE id_usuario =". $_SESSION['id_usuario']." AND id_evento IS NOT NULL";
$result_eventos_fav = mysqli_query($con, $query_eventos_fav) or die("Error ".mysqli_error($con));

while($evento_fav = mysqli_fetch_array($result_eventos_fav)) {
  extract($evento_fav);
  $query_eventos="SELECT e.*, g.*, p.provincia FROM eventos e INNER JOIN provincias p ON p.id_provincia = e.id_provincia LEFT JOIN grupos g ON g.id_grupo = e.id_grupo WHERE e.id_evento = $id_evento";
  $result_eventos = mysqli_query($con, $query_eventos) or die("Error ".mysqli_error($con));
  while ($evento = mysqli_fetch_array($result_eventos)) {
    extract($evento);
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
    echo "<div id='favorito_$id_favorito' class='card mb-3 mx-auto cardGeneral shadow-sm p-3 mb-5 bg-white rounded' onclick='redirectToEvent($id_evento)'>
        <div class='row g-0'>
          <div class='col-md-4'>
            <div><img src='$imagen_evento'style='border-radius: 10px; padding: 5px' width='240px'></div>
          </div>
          <div class='col-md-8'>
            <div class='card-body'>
                <h3>$nombre_evento</h3>
                <div>Provincia: $provincia</div>
                <div>
                    <span><a href='$web_grupo'>$nombre_grupo</a></span>
                </div>
                <div>
                    <span>Fecha: $fecha_inicio</span>
                    <span>$fecha_fin</span>
                </div>";
                if(!empty($web_evento)){
                  echo"<div>Web: <a href='$web_evento'>$web_evento</a></div>";
                }
                
                echo"<div>Entrada: $coste</div>";
    if ($info_evento != '') {
      echo "<div>Otra información: $info_evento</div>";
    }
    echo "<div class='d-flex justify-content-end' onclick='event.stopPropagation()'>
    <form action='". $_SERVER['PHP_SELF']. "' method='post'>
    <button type='submit' name='eliminarF' value='$id_favorito' style='border: none; background: none; 'onclick='eliminar() '>
    <img src='img/trash.svg' alt='Papelera'/>
    </button>
    </div>
    </form>
          </div>
        </div>
      </div>
    </div>";
  }
}

$query_festivales_fav="SELECT * FROM usuarios_eventos WHERE id_usuario =". $_SESSION['id_usuario']." AND id_festival IS NOT NULL";
$result_festivales_fav = mysqli_query($con, $query_festivales_fav) or die("Error ".mysqli_error($con));

while($festival_fav = mysqli_fetch_array($result_festivales_fav)) {
  extract($festival_fav);
  $query="SELECT DISTINCT e.id_festival, p.provincia, f.* FROM eventos e INNER JOIN provincias p ON p.id_provincia = e.id_provincia LEFT JOIN festivales f ON f.id_festival=e.id_festival WHERE e.id_festival = $id_festival";
  $result_festivales = mysqli_query($con, $query);
  while ($row = mysqli_fetch_array($result_festivales)) {
    $fecha_inicio = date("j F, Y", strtotime($fecha_inicio));
    $fecha_fin = date("j F, Y", strtotime($fecha_fin));
    extract($row);
    echo "<div id='favorito_$id_favorito' class='card mb-3 mx-auto cardGeneral shadow-sm p-3 mb-5 bg-white rounded' onclick='redirectToEvent($id_festival)'>
      <div class='row g-0'>
        <div class='col-md-4'>
          <img style='border-radius: 10px; padding: 5px' width='240px' height='auto' src='$imagen_festival'>
        </div>
        <div class='col-md-8'>
          <div class='card-body'>
          <h3>$nombre_festival</h3>
          <div>Provincia: $provincia</div>
          <div>
            <span>Fecha: $fecha_inicio</span>
            <span>- $fecha_fin</span>
          </div>
          <div>Precio abono: $abono</div>
          <div>Web: <a href='$web_festival'>$web_festival</a></div>";
    if ($info_festival != '') {
      echo "<div>Otra información: $info_festival</div>";
    }
    
    echo"<div class='d-flex justify-content-end' onclick='handleClick(event)'>

    <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
    <button type='submit' name='eliminarF' value='$id_favorito' style='border: none; background: none;'>
    <img src='img/trash.svg' alt='Papelera' onclick='eliminar()'/>
    </button></div>
          </div>
        </div>
      </div>
    </div>";
  }
}


 if (isset($_POST['eliminarF']) && !empty($_POST['eliminarF'])) {
  $query = "DELETE FROM usuarios_eventos WHERE id_favorito=".$_POST['eliminarF']."";
  mysqli_query($con, $query);
  ?>
  <script>
    alert("Registro eliminado correctamente");
    setTimeout(function() {
      window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>";
    }, 0); 
  </script>
  <?php
}

echo"<div class='d-flex justify-content-center'>Puedes volver a consultar todos los eventos desde la página de<a style='text-decoration: none; color: black' href='index.php'>&nbsp<img src='img/house-door-fill.svg' alt='Inicio'/> inicio</a></div>
</div>";
 ?>
  
  <footer>
    <div class="text-center p-3 footerCards" >
        © 2024 Copyright:
        <a class="text-white" href="">City Planner</a>
    </div>
  </footer>
  <script>
        function handleClick(event) {
        event.stopPropagation();
    }
  </script>


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: 'database/user_events.php',
        headerToolbar: {
          right: 'dayGridMonth,timeGridWeek,timeGridDay today prev,next'
        },
        buttonText: {
          today: 'Hoy',
          month: 'Mes',
          week: 'Semana',
          day: 'Día',
          list: 'Lista'
        },
        firstDay: 1,
        weekNumbers: true,
        weekText: '',
        navLinks: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        updateSize: true,
        eventClick: function(info) {
          if (info.event.url !== "") {
            info.jsEvent.preventDefault();
            Swal.fire({
              title: info.event.title,
              text: info.event.extendedProps.info,
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ir al evento',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
                window.open(info.event.url, '_blank');
              }
            })
          } else {
            Swal.fire({
              title: info.event.title,
              text: info.event.extendedProps.info,
              icon: 'info',
            })
          }
        },
        themeSystem: 'bootstrap',
      });
      calendar.render();
    });
  </script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>