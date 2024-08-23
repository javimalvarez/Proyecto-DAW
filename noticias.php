<link rel="stylesheet" href="css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
session_start();
require("database/datos.php");
echo "<html><head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>City Planner</title>
</head><body>";

echo "</div>
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
      <a class='nav-link active' style='font-weight: bold; color:gray;' href='noticias.php' id='navbarLugar' role='button' aria-haspopup='true' aria-expanded='false'>
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
</nav>";
$query_noticias="SELECT * FROM noticias";
$result_noticias = mysqli_query($con, $query_noticias) or die("Error en la consulta: ".mysqli_error($con));
$numNoticias=mysqli_num_rows($result_noticias);
if($numNoticias>0){
  echo"<section>
  <div class='col align-items-center'>
  <div class='row justify-content-center' style='margin-top: 10px; margin-bottom: 10px; padding: 5px;'>";
  while($noticias = mysqli_fetch_assoc($result_noticias)){
      extract($noticias);
      echo"<article><div class='card' style=' border: none; border-radius: 10px'>
      <div class='card-body' border: none'>
      <h3 style='font-weight: bold'>$titular</h3>
      <div>Publicado el $fecha_publicacion</div>";
      $query_autor = "SELECT nombre, apellidos FROM usuarios WHERE id_usuario = $id_usuario";
      $result_autor = mysqli_query($con, $query_autor) or die("Error en la consulta: ".mysqli_error($con));
      $autor = mysqli_fetch_assoc($result_autor);
      echo"<div style='font-style: italic'>$autor[nombre] $autor[apellidos]</div>
      <div>$texto</div>";
      //Solo en el caso del usuario administrador se muestra el botón para borrar o editar las noticias
      if(isset($_SESSION['usuario']) && $_SESSION['tipoUsuario']==0){
        echo "<div class='d-flex justify-content-end'><form action='admin/editor.php' method='post'><button type='submit' name='editar' value='$id_noticia' style='border: none; background: none'><img  src='img/pencil-square.svg' alt='editar'/> Editar entrada</button></form><form method='post' action='".$_SERVER['PHP_SELF']."'><button type='submit' name='eliminar' value='$id_noticia' style='border: none; background: none;' onclick='eliminar($id_noticia)'><img  src='img/trash.svg' alt='borrar'/> Borrar entrada</button></form></div>";
      }
      echo"</div></div></article>";
  }
}
echo"</div></div></section>";
if(isset($_POST['editar'])&&!empty($_POST['editar'])){
  //Se redirecciona al administrador al editor del blog de noticias si pulsa en la opción editar
  echo"<script>window.location.href = 'admin/editor.php';</script>";
}
else if(isset($_POST['eliminar'])&&!empty($_POST['eliminar'])){
  $query="DELETE FROM noticias WHERE id_noticia =". $_POST['eliminar']."";
  mysqli_query($con, $query);
  exit();
}


mysqli_close($con);
?>
<footer>
    <div class="text-center p-3 footerCards" >
        © 2024 Copyright:
        <a class="text-white" href="">City Planner</a>
    </div>
</footer>
<script>
  function eliminar(id_noticia) {
      const xhttp = new XMLHttpRequest();
      const eliminar = "eliminar=&id_noticia="+id_noticia;
      xhttp.open("POST", "", true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send(eliminar);
      alert("Noticia eliminada");
  }
</script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>