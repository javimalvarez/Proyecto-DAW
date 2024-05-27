<link rel="stylesheet" href="css/styleNavbar.css" />

<link rel="stylesheet" href="css/styleCards.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

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

      <a class='nav-link' href='noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
        Noticias
      </a>
    </li>
    </li class='nav-item'>
   
  </li>
  </li class='nav-item'>
  <a class='nav-link' href='map.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
    Mapa
  </a>
</li>";

echo"
  </ul>
  <form class='d-flex mx-auto  col-md-4'>
    <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' />
    <button class='btn btn-outline-success' type='submit'>
      Search</button>
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
            <div class='row justify-content-center align-items-center' style='margin-top: 10px;'><button type='button' style='border: none; background: none;'><a href='eventos/alta_eventos.php' target='_blank' style='text-decoration: none; color: black'><img src='img/journal-text.svg' alt='alta eventos'/> Alta de eventos</div>
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
        <p><input type='button' class='registro' onclick='window.location.href = 'login/registro.php'' value='Regístrate'></p>
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
      </ul>

    </div>
  </div>
</nav>
<section>
<div class='divFondo'>
<div class='divFondoTexto'>
<p class='tituloIndex'>Festivales, conciertos, teatro y más...</p></div></div>
";
  //Mostrará una lista de eventos
  echo"<section>
  <!--Cambiados filtros formulario -->
    <div style='padding: 10px; margin: 10px'>
      <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
        <label for='f_inicio'>Desde:</label>
        <input type='date' id='f_inicio' name='f_inicio' id='f_inicio' value='$fecha'>
        <label for='f_fin'>hasta:</label>
        <input type='date' id ='f_fin' name='f_fin' id='f_fin' value='" . date('Y-m-d', strtotime('+4 months')) . "'>
        <input type='checkbox' id='gratis' name='gratis' value='0' data-toggle='toggle' data-on='Gratis' data-off='Todos' data-onstyle='primary' data-offstyle='secondary'>
        <input class='btn btn-primary' type='submit' id='consultar' name='consultar' value='Consultar'/>
        <button class='btn btn-secondary' type='reset' id='eliminar' name='eliminar'>Eliminar seleccion</button>
      </form></div>";

  //Añadido div eventos para poder modificar consulta según filtros
  echo "<div id='eventos'>";
  //Mostrará una lista de eventos
  $query_eventos = "SELECT DISTINCT e.id_evento, e.nombre_evento, e.fecha_inicio, e.fecha_fin, e.precio, e.web_evento, e.imagen_evento, e.info_evento, g.nombre_grupo, g.web_grupo, g.info_grupo, p.provincia FROM eventos e LEFT JOIN grupos g ON e.id_grupo = g.id_grupo  INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE id_festival IS NULL AND e.fecha_inicio BETWEEN '$fecha' AND '" . date('Y-m-d', strtotime('+4 months')) . "' ORDER BY e.fecha_inicio ASC";
  $result_eventos = mysqli_query($con, $query_eventos);  while ($row = mysqli_fetch_array($result_eventos)) {
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
  
    echo "
    <div class='card mb-3 mx-auto cardGeneral shadow-sm p-3 mb-5 bg-white rounded' onclick='redirectToEvent($id_evento)'>
      <div class='row g-0'>
        <div class='col-md-4 cardDiv'>
          <div><img src='$imagen_evento' class='responsive-img'></div>
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
    if (!empty($web_evento)) {
      echo "<div>Web: <a href='$web_evento'>$web_evento</a></div>";
    }
    echo "<div>Entrada: $coste</div>";
    if ($info_evento != '') {
      echo "<div>Otra información: $info_evento</div>";
    }
    if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
      echo "<div class='d-flex justify-content-end'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><input type='hidden' name='id_evento' value='$id_evento'><button type='submit' name='add_favorito' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
    }
    echo "</div>
        </div>
      </div>
    </div>";
  }
  //Obtenemos el id_festival
  $query="SELECT DISTINCT e.id_festival, p.provincia, f.* FROM eventos e INNER JOIN provincias p ON p.id_provincia = e.id_provincia LEFT JOIN festivales f ON f.id_festival=e.id_festival WHERE e.id_festival IS NOT NULL AND e.fecha_inicio BETWEEN '$fecha' AND '" . date('Y-m-d', strtotime('+4 months')) . "'";
  $result_festivales = mysqli_query($con, $query);
  while ($row = mysqli_fetch_array($result_festivales)) {
    $fecha_inicio = date("j F, Y", strtotime($fecha_inicio));
    $fecha_fin = date("j F, Y", strtotime($fecha_fin));
    extract($row);
    echo "<div class='card mb-3 mx-auto cardGeneral' onclick='redirectToFestivales($id_festival)' > 
      <div class='row g-0'>
        <div class='col-md-4'>
          <img class='responsive-img' src='$imagen_festival'>
        </div>
        <div class='col-md-8'>
          <div class='card-body'>
          <h3>$nombre_festival</h3>
          <div>Provincia: $provincia</div>";
          // <div>
          // <details><summary>Conciertos:</summary>
          // <table>";
          // $query_conciertos="SELECT e.fecha_inicio AS f_concierto, g.* FROM eventos e LEFT JOIN grupos g ON e.id_grupo = g.id_grupo WHERE id_festival = $id_festival";
          // $result_conciertos = mysqli_query($con, $query_conciertos);
          // while ($concierto = mysqli_fetch_array($result_conciertos)) {
          //   extract($concierto);
          //   if (!empty($f_concierto)) {
          //     $f_concierto = date("j F, Y H:i", strtotime($f_concierto));
          //   } else {
          //     $f_concierto = "Sin fecha";
          //   }
          //   echo"<tr>";
          //     if ($web_grupo != "") {
          //       echo "<td><a href='$web_grupo'>$nombre_grupo</a></td>";
          //     } else {
          //       echo "<td><a href='#'>$nombre_grupo</a></td>";
          //     }
          //     echo "<td>$f_concierto</td>
          //   </tr>";
          // }
          // echo"</table></details>
          // </div>
          echo"
          <div>
            <span>Fecha: $fecha_inicio</span>
            <span>- $fecha_fin</span>
          </div>
          <div>Precio abono: $abono</div>
          <div>Web: <a href='$web_festival'>$web_festival</a></div>";
    if ($info_festival != '') {
      echo "<div>Otra información: $info_festival</div>";
    }

    //Solo se muestra el botón para añadir como favorito si el usuario está registrado
    if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
      echo "<div class='d-flex justify-content-end'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><input type='hidden' name='id_festival' value='$id_festival'><button type='submit' name='favoritoF' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
    }
    echo "</div>
        </div>
      </div>
    </div>";
  }
  echo"</div>";
  //Consulta todos los eventos por rango de fechas
  if (isset($_POST['f_inicio']) && isset($_POST['f_fin']) && isset($_POST['consultar'])) {
    //Se elimina el contenido del div que se muestra al usuario en función de los resultados del filtro aplicado
    echo "<script>document.getElementById('eventos').innerHTML='';</script>";
    //Mostrará una lista de eventos por rango de fechas
    $query_eventos = "SELECT e.*, g.nombre_grupo, g.web_grupo, g.info_grupo, p.provincia FROM eventos e LEFT JOIN grupos g ON e.id_grupo = g.id_grupo  INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE id_festival IS NULL AND e.fecha_inicio BETWEEN '$_POST[f_inicio]' AND '$_POST[f_fin]' ORDER BY e.fecha_inicio ASC";
    $result_eventos = mysqli_query($con, $query_eventos);
    while ($row = mysqli_fetch_array($result_eventos)) {
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

      echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'><div class='row g-0'><div class='col-md-4'><div><img src='$imagen_evento' style='border-radius: 10px; padding: 5px' width='240px'></div></div><div class='col-md-8'><div class='card-body'><h3>$nombre_evento</h3><div>Provincia: $provincia</div><div><span><a href='$web_grupo'>$nombre_grupo</a></span></div><div><span>Fecha: $fecha_inicio</span><span>$fecha_fin</span></div>";
      if(!empty($web_evento)){
        echo"<div>Web: <a href='$web_evento'>$web_evento</a></div>";
      }
      echo"<div>Entrada: $coste</div>";
      if ($info_evento != '') {
        echo "<div>Otra información: $info_evento</div>";
      }
      //Solo se muestra el botón para añadir como favorito si el usuario está registrado
      if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
        echo "<div class='d-flex justify-content-end'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><input type='hidden' name='id_evento' value='$id_evento'><button type='submit' name='favoritoE' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
      }
      echo "</div></div>\";</script>
      </div>
    </div>";
    }
    //Se muestra información de los festivales por rango de fechas
    $query_festivales = "SELECT DISTINCT  e.id_festival, p.provincia, f.* FROM eventos e INNER JOIN provincias p ON p.id_provincia = e.id_provincia LEFT JOIN festivales f ON f.id_festival=e.id_festival WHERE e.id_festival IS NOT NULL AND e.fecha_inicio BETWEEN '$_POST[f_inicio]' AND '$_POST[f_fin]'";
    $result_festivales = mysqli_query($con, $query_festivales);
    while ($row = mysqli_fetch_array($result_festivales)) {
      $fecha_inicio = date("j F, Y", strtotime($fecha_inicio));
      $fecha_fin = date("j F, Y", strtotime($fecha_fin));
      extract($row);
      echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'> <div class='row g-0'><div class='col-md-4'><img style='border-radius: 10px; padding: 5px' width='240px' height='auto' src='$imagen_festival'></div><div class='col-md-8'><div class='card-body'><h3>$nombre_festival</h3><div>Provincia: $provincia</div>";
      $query_conciertos="SELECT e.fecha_inicio AS f_concierto, g.* FROM eventos e LEFT JOIN grupos g ON e.id_grupo = g.id_grupo WHERE id_festival = $id_festival";
      $result_conciertos = mysqli_query($con, $query_conciertos);
      //Conciertos festival
      // echo "<div><details><summary>Conciertos:</summary><table>";
      // while ($concierto = mysqli_fetch_array($result_conciertos)) {
      //   extract($concierto);
      //   if (!empty($f_concierto)) {
      //     $f_concierto = date("j F, Y H:i", strtotime($f_concierto));
      //   } else {
      //     $f_concierto = "Sin fecha";
      //   }
      //   echo"<tr>";
      //     if ($web_grupo != "") {
      //       echo "<td><a href='$web_grupo'>$nombre_grupo</a></td>";
      //     } else {
      //       echo "<td><a href='#'>$nombre_grupo</a></td>";
      //     }
      //     echo "<td>$f_concierto</td></tr'>";
      // }
      // echo "</table></details>
      echo"</div><div><span>Fecha: $fecha_inicio</span><span>- $fecha_fin</span></div><div>Precio abono: $abono</div><div>Web: <a href='$web_festival'>$web_festival</a></div>";
      if ($info_festival != '') {
        echo "<div>Otra información: $info_festival</div>";
      }

      //Solo se muestra el botón para añadir como favorito si el usuario está registrado
      if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
        echo "<div class='d-flex justify-content-end'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><input type='hidden' name='id_festival' value='$id_festival'><button type='submit' name='favoritoF' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
      }
      echo "</div></div>\";</script>
        </div>
      </div>";
    }
  }

  //Consulta todos los eventos por rango de fechas y gratuitos
  if (isset($_POST['f_inicio']) && isset($_POST['f_fin']) && isset($_POST['consultar']) && isset($_POST['gratis'])) {
    //Se elimina el contenido del div que se muestra al usuario en función de los resultados del filtro aplicado
    echo "<script>document.getElementById('eventos').innerHTML='';</script>";
    //Mostrará una lista de eventos por rango de fechas
    $query_eventos = "SELECT e.*, g.nombre_grupo, g.web_grupo, g.info_grupo, p.provincia FROM eventos e LEFT JOIN grupos g ON e.id_grupo = g.id_grupo  INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE id_festival IS NULL AND e.fecha_inicio BETWEEN '$_POST[f_inicio]' AND '$_POST[f_fin]' AND e.precio = 0 ORDER BY e.fecha_inicio ASC";
    $result_eventos = mysqli_query($con, $query_eventos);
    while ($row = mysqli_fetch_array($result_eventos)) {
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
      // < style='border: 1px solid black; margin: 10px; padding: 10px; border-radius: 10px;'>

      echo "<script>document.getElementById('eventos').innerHTML += \"<div class='card mb-3 mx-auto' style='max-width: 40%; border-radius: 10px'><div class='row g-0'><div class='col-md-4'><div><img src='$imagen_evento' style='border-radius: 10px; padding: 5px' width='240px'></div></div><div class='col-md-8'><div class='card-body'><h3>$nombre_evento</h3><div>Provincia: $provincia</div><div><span><a href='$web_grupo'>$nombre_grupo</a></span></div><div><span>Fecha: $fecha_inicio</span><span>$fecha_fin</span></div>";
      if(!empty($web_evento)){
        echo"<div>Web: <a href='$web_evento'>$web_evento</a></div>";
      }
      echo"<div>Entrada: $coste</div>";
      if ($info_evento != '') {
        echo "<div>Otra información: $info_evento</div>";
      }
      //Solo se muestra el botón para añadir como favorito si el usuario está registrado
      if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] != 0) {
        echo "<div class='d-flex justify-content-end'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><input type='hidden' name='id_evento' value='$id_evento'><button type='submit' name='favoritoE' style='border: none; background: none;'><img id='star-icon' src='img/star.svg' alt='Star'/></button></div>";
      }
      echo "\";</script></div>
        </div>
      </div>
    </div>";
    }
    //No se muestra información de los festivales con este filtro ya que los conciertos asociados a los festivales tienen coste y su coste coincide con el coste del abono del festival

  }
  echo "</section>";
 
//Comprueba si el evento ha sido como añadido como favorito y lo asigna al usuario
 if(isset($_POST['favoritoE'])&&isset($_SESSION['id_usuario'])&&isset($_POST['id_evento'])&&!empty($_POST['id_evento'])) {
    $result=mysqli_query($con, "SELECT * FROM usuarios_eventos WHERE id_evento=" . $_POST['id_evento'] . " AND id_usuario=" . $_SESSION['id_usuario']);
    $num_eventos=mysqli_num_rows($result);
    //Comprobamos si existe el registro en la base de datos
    if($num_eventos==0){
      $query_fav="INSERT INTO usuarios_eventos (id_usuario, id_evento) VALUES (".$_SESSION['id_usuario'].",". $_POST['id_evento'].")";
      mysqli_query($con, $query_fav);
      echo"<script>alert('Favorito añadido');</script;>";
    }else{
      echo"<script>alert('Favorito ya añadido');</script;>";
    }
   }else if (isset($_POST['favoritoF'])&&isset($_SESSION['id_usuario'])&&isset($_POST['id_festival'])&&!empty($_POST['id_festival'])) {
    $result=mysqli_query($con, "SELECT * FROM usuarios_eventos WHERE id_festival=" . $_POST['id_festival'] . " AND id_usuario=" . $_SESSION['id_usuario']);
    $num_eventos=mysqli_num_rows($result);
    //Comprobamos si existe el registro en la base de datos 
    if($num_eventos==0){
      $query_fav="INSERT INTO usuarios_eventos (id_usuario, id_festival) VALUES (".$_SESSION['id_usuario'].",". $_POST['id_festival'].")";
      mysqli_query($con, $query_fav);
      echo"<script>alert('Favorito añadido');</script>";
    }else{
      echo"<script>alert('Favorito ya añadido');</script>";
    }
  }
    
  ?>

  <footer class='text-white text-center text-lg-start footer '>
    <!-- Grid container -->
    <div class='container p-4 footerInfo'>
      <!--Grid row-->
      <div class='row'>
        <!--Grid column-->
        <div class='col-lg-8 col-md-12  md-0'>
          <h5 class='text-uppercase tituloFooter'>Sobre Nosotros</h5>

          <p>
            Somos un equipo de cuatro estudiantes apasionados por la tecnología y el desarrollo web. Actualmente, estamos cursando el ciclo formativo de Desarrollo de Aplicaciones Web (DAW) y este proyecto es una oportunidad para aplicar nuestros conocimientos y habilidades en un entorno real.
          </p>
        </div>
        <!--Grid column-->

       
        <!--Grid column-->
        <div class='col-lg-4 col-md-6  md-0'>
          <h5 class='text-uppercase tituloFooter md-0'>Nosotros  </h5>

          <ul class='list-unstyled'>
            <li>
              <a href='#!' class='text-white'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg> Javier Martinez</a>
            </li>
            <li>
              <a href='#!' class='text-white'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg> Itziar Esteban</a>
            </li>
            <li>
              <a href='#!' class='text-white'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg> David Rodriguez</a>
            </li>
            <li>
              <a href='#!' class='text-white'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg> Arantxa Ordoyo</a>
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
      <a class='text-white' href=''>CityPlanner</a>
    </div>
    <!-- Copyright -->
  </footer>

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>