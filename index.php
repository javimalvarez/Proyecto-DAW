<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>City Planner</title>
  <link rel="stylesheet" href="css/styleNavbar.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div id="alerta">
    <?php
    session_start();
    //Mensajes a mostrar en el index.php
    if (isset($_SESSION['mensaje'])) {
      echo "<script> alert('" . $_SESSION['mensaje'] . "')</script>";
      unset($_SESSION['mensaje']);
    }
    ?>
  </div>
  <!-- Popup de inicio de sesión -->
  <nav class=" nav navbar navbar-expand-lg navbar-light bg-light " id="main-navbar">
    <a class="navbar-brand mr-auto" href="index.php">
      <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
      <img src="img/LogoSinFondo.png" alt="Logo" width="80" class="d-inline-block align-text-top fotoNavbar" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarEventos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Eventos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarEventos">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarLugar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Lugar
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarLugar">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
          </div>
        </li>

        </li>

        <li>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </li>
      </ul>
    </div>


    <div class="navbar-nav ml-auto">
      <div class="nav-item">
        <img id="profile-icon" src="img/person.svg" />
        <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
      </div>

  </nav>
  <div class="login" id="login-form">
    <div class="login-triangle"></div>
    <form class="login-container" action="login/login.php" method="post">
      <h2 class="login-header">Iniciar Sesion</h2>
      <p><input type="email" id="correo" name="correo" placeholder="Correo"></p>
      <p><input type="password" id="pass" name="pass" placeholder="Contraseña"></p>
      <p><input class="botonLogin" type="submit" value="Acceder"></p>
      <a id="enlaceContraseña" href="#">No recuerdo mi contraseña</a>
      <hr>
      <p>¿Aún no tienes cuenta?</p>
      <!-- Tenemos que poner type button porque si ponemos type submit necesitamos el rellenar el email y pass -->
      <p><input type="button" class="registro" onclick="window.location.href = 'login/registro.php'" type="submit" value="Regístrate"></p>
    </form>
  </div>



  <!-- 
    <section>

<div class="card" style="width: 30rem; text-align: center; position:center;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
      </section>
      <section>
        <div class="card text-center">
            <div class="card-header">
              Featured
            </div>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-body-secondary">
              2 days ago
            </div>
          </div>
      </section>
      <section>
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
          </div>
          
          
      </section>
    <h1>Hello, world!</h1>
    <section> <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </section> -->

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>