<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>City Planner</title>
  <link rel="stylesheet" href="styleNavbar.css" />
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
                  <p><input type="button" class="registro" onclick="window.location.href = 'login/registro.php'" value="Regístrate"></p>
                </form>
              </div>

</body>
</html>
