<!--Esto es una plantilla de PHP -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
session_start();
require("../database/datos.php");
$con=mysqli_connect($host,$user,$pass,$db_name);
echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
//Consulta de las categorias de eventos a la base de datos
$query_tipo="SELECT * FROM tipo_eventos";
$result_tipo = mysqli_query($con, $query_tipo);
while($row = mysqli_fetch_array($result_tipo)){
    extract($row);
    echo "<button type='checkbox' name='categoria[]'value='$id_tipo'>$categoria_evento</button>";
}
echo"<br/><label for='provincia'>Eventos en</label>
<select name='provincia'>";
//Consulta de las provincias a la base de datos
$query_provincia="SELECT * FROM provincias";
$result_provincia= mysqli_query($con, $query_provincia);
while($row = mysqli_fetch_array($result_provincia)){
    extract($row);
    echo "<option value='$id_provincia'>$provincia</option>";
}
echo"</select><br/>";
date_default_timezone_set('Europe/Madrid');
$fecha=date("Y-m-d");
echo"<button type='checkbox' name='fecha[]' value='$fecha'>Hoy</button>
<button type='checkbox' name='coste[]' value='0'>Gratis</button>
<label for='f_inicio'>Fecha inicio:</label>
<input type='date' name='f_inicio' id='f_inicio' min='$fecha' value='$fecha'>
<label for='f_fin'>Fecha fin:</label>
<input type='date' name='f_fin' id='f_fin'>
<input type='submit' name='enviar' value='Filtrar' id='filtrar'/></form>";
if (isset($_POST['filtro'])){
    foreach ($_POST['filtro'] as $filtro){
        echo "$filtro<br/>";
    }
}
?>
<script>
    function comprobar(){
        if(document.getElementById('f_inicio').value > document.getElementById('f_fin').value){
            return false;
        }
    }
    document.getElementById('filtrar').addEventListener('click', function(event){event.preventDefault();if(!comprobar()){alert("La fecha de inicio debe ser menor a la fecha de fin");return false;}});
</script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>