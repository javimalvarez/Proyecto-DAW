<link rel="stylesheet" href="css/styleNavbar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();
require("database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
date_default_timezone_set('Europe/Madrid');
$fecha = date("Y-m-d");
echo"<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>City Planner</title>
</head>
<div id='alerta'>";
   
echo"</div>
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
      <li>
        <form class='d-flex' role='search'>
          <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' />
          <button class='btn btn-outline-success' type='submit'>
            Search
          </button>
        </form>
      </li>
    </ul>
  </div>


  <div class='navbar-nav ml-auto'>
    <div class='nav-item'>
      <img id='profile-icon' src='img/person.svg' />
      <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
    </div>
    <div class='login'>
      <div class='login-triangle'></div>
      <img src='img/user.svg'/>
      <div>".$_SESSION['nombre'] ."(" . $_SESSION['usuario'] .")</div>
      <form action='".$_SERVER['PHP_SELF']."' method='post' class='form-container'>
        <input type='submit' class='exit' name='salir' value='Salir'></form>
      </form>
    </div>
</nav>";
if (isset($_POST['salir'])) {
    session_destroy();
    header("Location: index.php");
}
//Filtros
echo"<details><summary>Personaliza tu plan</summary><div><form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
<input type='checkbox' name='festival' value='festival'>Festivales";
//Consulta de las categorias de eventos a la base de datos
$query_tipo = "SELECT * FROM tipo_eventos";
$result_tipo = mysqli_query($con, $query_tipo);
while ($row = mysqli_fetch_array($result_tipo)) {
    extract($row);
    echo "<input type='checkbox' name='categoria[]'value='$id_tipo'/>$categoria_evento";
}
echo "<br/><label for='provincia'>Eventos en</label>
<select class='form-select' name='provincia' id='provincia'>
<option value='' selected disabled>Provincia</option>";
//Consulta de las provincias a la base de datos
$query_provincia = "SELECT * FROM provincias";
$result_provincia = mysqli_query($con, $query_provincia);
while ($row = mysqli_fetch_array($result_provincia)) {
    extract($row);
    echo "<option value='$id_provincia'>$provincia</option>";
}

echo "</select><br/><input type='checkbox' name='coste' value='0'>Gratis
<input type='checkbox' name='f_hoy' value='$fecha'>Hoy 
<label for='f_inicio'>Fecha inicio:</label>
<input type='date' name='f_inicio' id='f_inicio'>
<label for='f_fin'>Fecha fin:</label>
<input type='date' name='f_fin' id='f_fin'>
<input type='submit' name='consultar' value='Consultar' id='consultar'/>
<button type='reset'>Eliminar seleccion</button></form></div></details>";

//Mostrará una lista de eventos de la base de datos a partir de la fecha actual
$query="SELECT e.evento, e.ubicacion, e.fecha_inicio, e.fecha_fin, e.precio, e.web_evento, e.imagen_evento, e.info_evento, t.categoria_evento, g.nombre_grupo, g.web_grupo, g.info_grupo, f.nombre_festival, f.web_festival, f.info_festival, p.provincia FROM eventos e LEFT JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo LEFT JOIN festivales f ON f.id_festival = e.id_festival INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.id_provincia='".$_SESSION['provincia_usuario']."'";
$result = mysqli_query($con, $query);
$numEventos=mysqli_num_rows($result);
if ($numEventos > 0) {
  while($row = mysqli_fetch_array($result)){
      extract($row);
      echo "<h3>Planes en $provincia</h3>
      <div id='eventos'><div style='border: 1px solid black; margin: 10px; padding: 10px; border-radius: 10px;'>
          <div><img src='$imagen_evento'></div>
          <div><img src='$imagen_festival'></div>
          <div>
              <h3>$evento</h3>
              <span><a href='#'>$categoria_evento</a></span>
              <div>
                  <span><a href='$web_grupo'>$nombre_grupo</a></span>
                  <span>$info_grupo</span>
                  <span><a href='$web_festival'>$nombre_festival</a></span>
                  <span>$info_festival</span>
              </div>
              <div>
                  <span>Fecha:$fecha_inicio</span>
                  <span>$fecha_fin</span>
              </div>
              <div><a href='$web_evento'>$web_evento</a></div>";
              if($precio==0){
                  $precio="Gratuita";
              }else{
                  $precio=$precio."€";
              }
              echo "<span>Entrada: $precio</span>
              <div>Otra información: $info_evento</div>

          </div>
          </div></div>
        <script>document.getElementById('provincia').value=".$_SESSION['provincia_usuario'].";</script>";
  }
}else{
    echo "No hay eventos en esta provincia";
}
 /* <!-- 
    <section>

<div class='card' style='width: 30rem; text-align: center; position:center;'>
  <img src='...' class='card-img-top' alt='...'>
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
    </section> -->*/
?>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>