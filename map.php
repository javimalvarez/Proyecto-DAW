<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleNavbar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <title>Localización</title>
</head>
<body>
    <?php
    session_start();
    require ("database/datos.php");
    //Mapa con ubicación por defecto
    $coordenadas='{lat:40.41679923924473, lng:-3.703788645105496}';
    $evento="prueba";
    echo "
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
          <div class='login-triangle'></div>";
  if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
    echo "<div class='login-triangle'></div>
              <img src='img/user.svg'/>
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
            <p><input type='button' class='registro' onclick='window.location.href = 'login/registro.php'' value='Regístrate'></p>
          </form>";
  }
  echo "</div>
      </div>
    </li>
  </ul>
</div>
</div>
</nav>";
    echo"<div style='padding: 10px; margin: 10px'>Aquí puedes consultar la localización en Google Maps de los distintos eventos</div>";
    echo"<div style='padding: 10px; margin: 10px'><form action='".$_SERVER['PHP_SELF']."' method='POST'><select class='custom-select w-25' name='evento'>
    <option value='' disabled selected>Selecciona un evento...</option><optgroup label='eventos'>";
    $query ="SELECT * FROM eventos WHERE id_festival IS NULL";
    $eventos = mysqli_query($con, $query);
    while($evento=mysqli_fetch_assoc($eventos)){
        extract($evento);
        echo"<option value='$nombre_evento'>$nombre_evento</option>";
    }
    echo"</optgroup>";
    $query_festivales="SELECT * FROM festivales";
    $festivales=mysqli_query($con, $query_festivales);
    echo"<optgroup label='festivales'>";
    while($festival=mysqli_fetch_assoc($festivales)){
        extract($festival);
        echo"<option value='$nombre_festival'>$nombre_festival</option>";
    }
    echo"</optgroup></select><input type='submit' class='btn btn-primary' name='ubicacion' value='ver ubicación'></form></div>";
    if(isset($_POST['ubicacion'])&&isset($_POST['evento'])&&!empty($_POST['evento'])){
        /*Comprueba el id_festival de la tabla eventos si el nombre del evento coincide 
        un nombre de evento de la tabla de eventos
        solo cuentan con id_festival los eventos asociados a un festival de música
        En caso contrario la variable num_resultados es igual a 0*/

        $query="SELECT id_festival FROM eventos WHERE nombre_evento='$_POST[evento]'";
        $result = mysqli_query($con, $query);
        $num_resultados=mysqli_num_rows($result);
        //En caso de que  el numero de resultados sea 0 será un festival
        if($num_resultados==0){
            //Se busca el id_festival de la tabla festivales en base al nombre del evento recuperado del formulario
            $query="SELECT id_festival FROM festivales WHERE nombre_festival='$_POST[evento]'";
            $result = mysqli_query($con, $query);
            $festival=mysqli_fetch_assoc($result);
            extract($festival);
            //Se obtiene la ubicación del festival desde la tabla de eventos
            $query="SELECT DISTINCT ubicacion FROM eventos WHERE id_festival=$id_festival";
            $result = mysqli_query($con, $query);
            $evento = mysqli_fetch_assoc($result);
            extract($evento);
            $coordenadas = $ubicacion;
            $evento = $_POST['evento'];
        }else{
            //Se obtiene la ubicación del evento para el resto de eventos que no sean festivales
            $query="SELECT ubicacion FROM eventos WHERE nombre_evento='$_POST[evento]'";
            $result = mysqli_query($con, $query);
            $evento = mysqli_fetch_assoc($result);
            extract($evento);
            $coordenadas = $ubicacion;
            $evento = $_POST['evento'];
        }
    } 
    ?>
    <div id="map" style="width: 400px; height: 400px; margin: 10px; padding: 10px; border-radius: 10px"></div>
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
  </footer>
    <!--API key de Google Maps-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCKiIqCdZGrVxx06LSbe7uG3zXOq1Cz5k&callback=initMap" async defer></script>
    <script>
        var map; 
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center:  <?php echo $coordenadas?>,
                zoom: 15
            });
            var marker = new google.maps.Marker({
                position: <?php echo $coordenadas?>,
                map: map, 
                title: '<?php echo $evento?>'
            });
        }
        window.initMap=initMap;
    </script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>