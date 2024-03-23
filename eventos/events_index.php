<!--Esto es una plantilla de PHP -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
session_start();
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
date_default_timezone_set('Europe/Madrid');
$fecha = date("Y-m-d");
function mostrarFiltros(){

    if(isset($_SESSION['provincia_usuario'])&&$_SESSION['tipoUsuario']==1||$_SESSION['tipoUsuario']==2){
        //echo"<script>document.getElementById('eventos').innerHTML='';</script>";
        $query="SELECT e.evento, e.ubicacion, e.fecha_inicio, e.fecha_fin, e.precio, e.web_evento, e.imagen_evento, e.info_evento, t.categoria_evento, g.nombre_grupo, g.web_grupo, g.info_grupo, f.nombre_festival, f.web_festival, f.info_festival, p.provincia FROM eventos e LEFT JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo LEFT JOIN festivales f ON f.id_festival = e.id_festival INNER JOIN provincia p ON p.id_provincia = e.id_provincia WHERE e.id_provincia ='".$_SESSION['provincia_usuario']."';)";
        $result = mysqli_query($con, $query);
        $numEventos=mysqli_num_rows($result);
        if($numEventos==0){
          echo"<h1>No hay eventos en esta provincia</h1>";
        }else{
          while($row = mysqli_fetch_array($result)){
            extract($row);
              echo"<h1>Planes en $provincia</h1>
              <div style='border: 1px solid black; margin: 10px; padding: 10px;'>
                  <div><img src='$imagen_evento'></div>
                  <div><img src='$imagen_festival'></div>
                  <div>
                      <h3>$evento</h3>
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
                  </div>";
          }
        }
      
        echo"<script>document.getElementById('provincia').value = '" . $_SESSION['provincia_usuario'] . "';</script>";
      }
   
}
    
    //echo count($_POST['categoria']);
    /*if(!empty($_POST['provincia'])){
        echo $_POST['provincia'];
    }else if(empty($_POST['provincia'])){
        echo "no has seleccionado ninguna provincia";
    }*/
    //Consulta provincia del usuario si ha iniciado sesión. Se muestran los planes para esa provincia

    /*if (isset($_POST['categoria'])&&isset($_POST['provincia'])&&isset($_POST['coste'])&&isset($_POST['f_hoy'])&&!isset($_POST['f_inicio'])&&!isset($_POST['f_fin'])) {
        $query="SELECT * FROM eventos WHERE id_provincia = '" . $_POST['provincia'] . "' AND id_coste = '" . $_POST['coste'] . "' AND id_tipo IN (" . implode(',', $_POST['categoria']) . ")";
        return $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            extract($row);
            echo "<tr><td>$nombre_evento</td><td>$provincia</td><td>$coste</td><td>$tipo_evento</td><td>$fecha_fin</td><td>$id_coste</td><td>$id_provincia</td><td>$idtipo</td></tr>";
        }
    }else if (isset($_POST['categoria'])&&isset($_POST['provincia'])) {
        $query="SELECT * FROM eventos WHERE id_provincia = '" . $_POST['provincia'] . "' AND id_tipo IN (" . implode(',', $_POST['categoria']) . ")";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            extract($row);
            echo "<tr><td>$nombre_evento</td><td>$provincia</td><td>$coste</td><td>$fecha_fin</td><td>$id_coste</td><td>$id_provincia</td><td>$idtipo</td></tr>";
        }
    } else if (isset($_POST['provincia'])) {
        $query="SELECT * FROM eventos WHERE id_provincia = '" . $_POST['provincia'] . "'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            extract($row);
            echo "<tr><td>$nombre_evento</td><td>$provincia</td><td>$coste</td><td>$fecha_fin</td><td>$id_coste</td><td>$id_provincia</td><td>$idtipo</td></tr>";
        }
    }else if (isset($_POST['provincia'])&&isset($_POST['coste'])) {
        $query="SELECT * FROM eventos WHERE id_provincia = '" . $_POST['provincia'] . "' AND id_coste = '" . $_POST['coste'] . "'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            extract($row);
            echo "<tr><td>$nombre_evento</td><td>$provincia</td><td>$coste</td><td>$fecha_fin</td><td>$id_coste</td><td>$id_provincia</td><td>$idtipo</td></tr>";
        }
        
    }else if
    */
    echo "</div>";
?>
<script>
    function comprobar() {
        if (document.getElementById('f_inicio').value != "" && document.getElementById('f_inicio').value > document.getElementById('f_fin').value) {
            return true;
        }
    }
    document.getElementById('filtrar').addEventListener('click', function(event) {
        event.preventDefault();
        if (comprobar()) {
            alert("La fecha de inicio debe ser menor a la fecha de fin");
            return true;
        }
    });
</script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>