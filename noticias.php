<link rel="stylesheet" href="css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
require("database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
echo "<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>City Planner</title>
</head>";

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
          <a class='nav-link' href='../../noticias.php' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Noticias
          </a>
      </li>
    </ul>
    <form class='d-flex mx-auto  col-md-4'>
        <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' />
        <button class='btn btn-outline-success' type='submit'>
            Search</button>
    </form>
  </div>
  
    <div class='nav-item'>
      <img id='profile-icon' src='img/person.svg' />
      <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
    </div>
</nav>";
if (isset($_SESSION['usuario'])) {
  echo " <div class='login'>
      <div class='login-triangle'></div>
      <img src='img/user.svg'/>
      <div>" . $_SESSION['nombre'] . "(" . $_SESSION['usuario'] . ")</div>
      <form action='" . $_SERVER['PHP_SELF'] . "' method='post' class='form-container'>
        <input type='submit' class='exit' name='salir' value='Salir'></form>
      </form>
    </div>";
  if (isset($_POST['salir'])) {
    session_destroy();
    header("Location: conciertos.php");
  }
} else {
  echo "<div class='login' id='login-form'>
    <div class='login-triangle'></div>
    <form class='login-container' action='../../login/login.php' method='post'>
    <h2 class='login-header'>Iniciar Sesion</h2>
    <p><input type='email' id='correo' name='correo' placeholder='Correo'></p>
    <p><input type='password' id='pass' name='pass' placeholder='Contraseña'></p>
    <p><input class='botonLogin' type='submit' value='Acceder'></p>
    <a id='enlaceContraseña' href='#'>No recuerdo mi contraseña</a>
    <hr>
    <p>¿Aún no tienes cuenta?</p>
    <!-- Tenemos que poner type button porque si ponemos type submit necesitamos el rellenar el email y pass -->
    <p><input type='button' class='registro' onclick='window.location.href = \"../../login/registro.php\"' value='Regístrate'></p></form>
  </div>";
}
$query_noticias="SELECT * FROM noticias";
$result_noticias = mysqli_query($con, $query_noticias) or die("Error en la consulta: ".mysqli_error($con));
while($noticias = mysqli_fetch_assoc($result_noticias)){
    extract($noticias);
    echo"<article>
    <h3>$titulo</h3>
    <div>$fecha_publicacion</div>
    <div>$texto</div>
    </article>";
}
mysqli_close($con);
?>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>