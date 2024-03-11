<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
session_start();
//Requiere que el usuario haya iniciado sesion
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}
require_once("../database/datos.php");
$con=mysqli_connect($host, $user, $pass, $db_name) or die("Error ".mysqli_error($con));
echo"<form id='eventos' method='post' action='" . $_SERVER['PHP_SELF'] . "''>
<label for='nombre_evento' required>Evento:</label>
<input type='text' id='nombre_evento' name='nombre_evento'>
<select name='tipo_evento' id='tipo_evento' autofocus>
    <option value='' selected>Indica tipo de evento</option>";
    $query_tipoEvento="SELECT * FROM tipo_eventos";
    $result_tipoEvento = mysqli_query($con, $query_tipoEvento) or die("Error ".mysqli_error($con));
    while($row = mysqli_fetch_array($result_tipoEvento)){
        extract($row);
        echo "<option value='$id_tipo'>$categoria_evento</option>";
    }
    echo"</select><br/>
<span id='grupo' style='visibility:hidden;'><select name='grupo' id='grupo'>
<option value=''>Grupo</option>";
$query_grupo="SELECT id_grupo, nombre FROM grupos";
$result_grupo=mysqli_query($con, $query_grupo) or die("Error ".mysqli_error($con));
while($row = mysqli_fetch_array($result_grupo)){
    extract($row);
    echo "<option value='$id_grupo'>$nombre</option>";
}
echo"</select>
*Si el grupo no aparece en la lista pulsa aquí <button type='button'><a href='grupos.php' style='text-decoration:none; color:black;'>Nuevo grupo</a></button></span><br/>
<span id='festival' style='visibility:hidden;'><select name='festival' id='festival'><option value=''>Festival</option>";
$query_festival="SELECT id_festival, nombre FROM festivales";
$result_festival=mysqli_query($con, $query_festival) or die("Error ".mysqli_error($con));
while($row = mysqli_fetch_array($result_festival)){
    extract($row);
    echo "<option value='$id_festival'>$nombre</option>";
}
echo "</select>*Si el festival no aparece en la lista lo puedes dar de alta desde aquí 
<button type='button'><a href='festivales.php' style='text-decoration:none; color:black;'>Alta festival</a></button></span><br/>
<select name='provincia'><option value=''>Provincia</option>";
$query_provincia="SELECT * FROM provincias";
$result_provincia=mysqli_query($con, $query_provincia) or die("Error ".mysqli_error($con));
while($row = mysqli_fetch_array($result_provincia)){
    extract($row);
    echo "<option value='$id_provincia'>$provincia</option>";
}

echo"</select><br/>
<label for='ubicacion' title='Indica coordenadas'>Ubicación:</label>
<input type='text' name='ubicacion' placeholder='ejemplo: {lat:42.54992, lng:-6.59791}'><br/>
<input type='checkbox' id='varios_dias' onchange='marcar()'>Marca esta opción si el evento tiene una duración de varios días (no disponible para conciertos)<br/>
<label for='fecha_inicio'>Fecha/hora evento:</label>
<input type='datetime-local' name='fecha_inicio'>
<span id='fecha_fin'style='visibility: hidden;'>
    <label for='fecha_fin'>Fecha fin:</label>
    <input type='date' name='fecha_fin'>
</span><br/>
<label for='web'>Web:</label>
<input type='url' name='web' placeholder='URL evento'><br/>
<span>Puedes añadir una imagen del evento pulsando aqui <input type='file' name='archivo' acept='image/*'></span><br/>
<label for='info'>Otra información:</label><br/>
<textarea name='info' id='info_festival' cols='60' rows='7'></textarea><br/>
<input type='submit' id='enviar' value='Enviar'></form>";
?>
<script src='eventos.js'></script>
<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>