<link rel="stylesheet" href="css/styleNavbar.css" />
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
  <title>City Planner</title>
</head>
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
    </li class='nav-item'>
        <a class='nav-link' href='index.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
          Inicio
        </a>
      </li>
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
      </li class='nav-item'>
        <a class='nav-link' href='calendario.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
          Calendario
        </a>
      </li>
      </li class='nav-item'>
        <a class='nav-link' href='map.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
          Mapa
        </a>
      </li>";
      if(isset($_SESSION['usuario'])) {
        if($_SESSION['tipoUsuario'] == 0){
          echo "<li class='nav-item'>
          <a class='nav-link' href='admin/admin.php' role='button' aria-haspopup='true' aria-expanded='false'>Panel administrador
          </a>
        </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='user.php' role='button' aria-haspopup='true' aria-expanded='false' style='font-weight: bold;'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."
          </a>
        </li>";
        }
      }
      echo"</ul><form class='d-flex mx-auto  col-md-4'>
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
        <div class='login-container' style='min-width: 200px;'>
        <div class='row justify-content-center align-items-center'><img src='img/person.png' alt='profile_image'/></div>
  <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><a href='user.php' target='_blank'><div class='row justify-content-center align-items-center'>".$_SESSION['nombre']." ".$_SESSION['apellidos']."</div><div class='row justify-content-center align-items-center'>(".$_SESSION['usuario'].")</div></a></div>";
  if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] == 2) {
    echo"<div class='	row justify-content-center align-items-center' style='margin-top: 10px;'>Accede desde a aquí a la gestión de eventos</div>
    <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='eventos/alta_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='img/journal-text.svg' alt='alta eventos'/> Alta de eventos</div>
    <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='admin/gestion_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='img/pencil.svg' alt='editar eventos'/> Editar eventos</a></button></div>";
  }
  echo"<div class='row justify-content-center align-items-center' style='margin-top: 10px;'>
  <a href='login/logout.php'><button type='button' class='btn btn-primary'>Salir</button></a></div>
</div>";
echo "</div>
      </div>
    </li>
  </ul>
</div>
</div>
</nav>
</section><section>
<div>Hola! ". $_SESSION['nombre'] ." ". $_SESSION['apellidos']. "</div>
<h3>Calendario de ". $_SESSION['nombre'] ."</h3>
<div class='row justify-content-center align-items-center' >
<div id='calendar'style='background-color:white; padding:30px; margin: 5px; border-radius: 10px'></div>
  </div>
</section>
<section>
<h3>Eventos favoritos de ".$_SESSION['nombre']."</h3>
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
    echo "<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'>
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
    echo"<div class='d-flex justify-content-end'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><button type='submit' name='eliminarF' value='$id_favorito' style='border: none; background: none;'><img src='img/trash.svg' alt='Papelera'/></button></div>
    
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
    echo "<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'> 
      <div class='row g-0'>
        <div class='col-md-4'>
          <img style='border-radius: 10px; padding: 5px' width='240px' height='auto' src='$imagen_festival'>
        </div>
        <div class='col-md-8'>
          <div class='card-body'>
          <h3>$nombre_festival</h3>
          <div>Provincia: $provincia</div>
          <div>
          <details><summary>Conciertos:</summary>
          <table>";
          $query_conciertos="SELECT e.fecha_inicio AS f_concierto, g.* FROM eventos e LEFT JOIN grupos g ON e.id_grupo = g.id_grupo WHERE id_festival = $id_festival";
          $result_conciertos = mysqli_query($con, $query_conciertos);
          while ($concierto = mysqli_fetch_array($result_conciertos)) {
            extract($concierto);
            if (!empty($f_concierto)) {
              $f_concierto = date("j F, Y H:i", strtotime($f_concierto));
            } else {
              $f_concierto = "Sin fecha";
            }
            echo"<tr>";
              if ($web_grupo != "") {
                echo "<td><a href='$web_grupo'>$nombre_grupo</a></td>";
              } else {
                echo "<td><a href='#'>$nombre_grupo</a></td>";
              }
              echo "<td>$f_concierto</td>
            </tr>";
          }
          echo"</table></details>
          </div>
          <div>
            <span>Fecha: $fecha_inicio</span>
            <span>- $fecha_fin</span>
          </div>
          <div>Precio abono: $abono</div>
          <div>Web: <a href='$web_festival'>$web_festival</a></div>";
    if ($info_festival != '') {
      echo "<div>Otra información: $info_festival</div>";
    }
    
    echo"<div class='d-flex justify-content-end'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><button type='submit' name='eliminarF' value='$id_favorito' style='border: none; background: none;'><img src='img/trash.svg' alt='Papelera' onclick='eliminar($id_favorito)'/></button></div>
          </div>
        </div>
      </div>
    </div>";
  }
}
if(isset($_POST['eliminarF'])&&!empty($_POST['eliminarF'])) {
  $query = "DELETE FROM usuarios_eventos WHERE id_favorito=".$_POST['eliminarF']."";
  mysqli_query($con, $query);
  exit();
}



   
    /*echo "<div class='card mb-3 mx-auto' style='max-width: 90%'>;
      <div class='row g-0'>
        <div class='col-md-4'>
          <div><img src='$imagen_evento>'></div>
        </div>
          <div class='col-md-8'>
            <div class='card-body'>        
            <h3>$nombre_evento</h3>
            <span>Provincia: $provincia</span>
            <div>
              <span>Fecha: $fecha_inicio</span>
              <span>$fecha_fin</span>
            </div>
          <div>
            <a href='$web_evento'>$web_evento</a>
          </div>
          <span>Entrada: $coste</span>
          <div>Otra información:$info_evento</div>
          <a href='>Maps</a>
          <div class='row'>
            <div class='col-md-11'>
              <button onclick='window.location.href'>Ir al enlace</button>
            </div>
            <div >
            <input type='button' name='eliminar' id='eliminar' value='Eliminar' onclick='eliminar($id_evento)'/>
            </div>
            <div class='star-icon-container col-md-4 col-md-offset-1'>
              <a href='/maps.js'>
                <img id='star-icon' src='../img/star.svg' alt='Star'/>
              </a>
            </div>
        </div>
          </div>
            </div>
        </div>
      </div>";
}

/*$query_festivales_favoritos="SELECT * FROM usuarios_eventos WHERE id_usuario =". $_SESSION['id_usuario']."AND id_festival IS NOT NULL";
$result = mysqli_query($con, $query_eventos_favoritos) or die("Error ".mysqli_error($con));

//consulta principal
// $query = "SELECT u.id_usuario, u.nombre, e.*, p.provincia, e.imagen_evento
//           FROM usuarios u
//           JOIN usuarios_eventos ue ON u.id_usuario = ue.id_usuario
//           JOIN eventos e ON ue.id_evento = e.id_evento
//           INNER JOIN provincias p ON p.id_provincia = e.id_provincia
//           WHERE u.id_usuario = $id_usuario";
$query = "SELECT u.id_usuario, u.nombre, e.*, p.provincia, f.*
            FROM usuarios u
            JOIN usuarios_eventos ue ON u.id_usuario = ue.id_usuario
            LEFT JOIN eventos e ON ue.id_evento = e.id_evento
            LEFT JOIN festivales f ON ue.id_festival = f.id_festival
            LEFT JOIN provincias p ON p.id_provincia = e.id_provincia
            WHERE u.id_usuario =$_SESSION[id_usuario]"; */

echo"
<div class='d-flex justify-content-center'>Puedes volver a consultar todos los eventos desde la página de<a style='text-decoration: none; color: black' href='index.php'>&nbsp<img src='img/house-door-fill.svg' alt='Inicio'/> inicio</a></div>
</div>";
 ?>
  <!-- <div id="map"></div>
    <div id="weather"></div>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVUzOB6wRZiGOYfFuuTqDOPJKP3u048mE&callback=initMap&v=weekly"
    defer
    ></script> -->

<script>
  function eliminar(id_favorito) {
      const xhttp = new XMLHttpRequest();
      const eliminar = "eliminar=&id_favorito="+id_favorito;
      xhttp.open("POST", "", true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send(eliminar);
      alert("Evento eliminado de favoritos");
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