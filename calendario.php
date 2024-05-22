<link rel="stylesheet" href="css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<html>

<body>
  <?php
  session_start();
  require("database/datos.php");
  date_default_timezone_set('Europe/Madrid');
  $fecha = date("Y-m-d");
  $coste = "";
  setlocale(LC_TIME, 'es_ES.UTF-8');
  echo "<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Calendar</title>
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
        <a class='nav-link' href='noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
          Noticias
        </a>
      </li>
      <li class='nav-item'>
        <a class='nav-link'href='calendario.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
          Calendario
        </a>
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
              <a id='enlaceContraseña' href=\"#\" onclick=\"reemplazoLogin()\">No recuerdo mi contraseña</a>
              <hr>
              <p>¿Aún no tienes cuenta?</p>
              <!-- Tenemos que poner type button porque si ponemos type submit necesitamos el rellenar el email y pass -->
              <p><input type='button' class='registro' onclick='window.location.href=\"login/registro.php\"' type='submit' value='Regístrate'></p>
            </form>
          </div>
        </div>
      </li>
    </ul>
  </div>
  </div>
  </nav>
<section>
  <div class='container'>
    <div class='row'>
      <div id='calendar'style='width: 70%; background-color:white; padding:10px; margin: 10px; border-radius: 10px'></div>
    </div>
  </div>
</section>";
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


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: 'database/calendar_events.php',
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
</body>

</html>