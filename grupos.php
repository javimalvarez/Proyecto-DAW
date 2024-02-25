<?php
require("datos.php");
echo"<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<h3>Grupos:</h3>
<label for='nombre_grupo'>Nombre:</label>
<input type='text' name='nombre_grupo'><br/>
<label for='genero'>Género:</label>
<input type='text' name='generoo'><br/>
<label for='url_grupo'>Web:</label>
<input type='url' name='url_grupo' placeholder='URL grupo'><br/>
<input type='file' name='imagen_grupo' acept='image/*'><br/>
<label for='info_festival'>Otra información:</label><br/>
<textarea name='info_festival' id='info_festival' cols='30' rows='3'></textarea><br/>
<input type='submit' name='enviar' value='Alta grupo'>
</form>";
$con=mysqli_connect($host, $user, $pass, $db_name) or die("Error ".mysqli_error($con));
if (isset($_POST['nombre_grupo'])&&isset($_POST['genero'])&&isset($_POST['url_grupo'])&&isset($_POST['info_festival'])){
    $query="INSERT INTO grupos (nombre, genero, web, imagen, otra_info) 
    VALUES ('" . $_POST['nombre_grupo'] . "', '" . $_POST['genero'] . "', '" . $_POST['url_grupo'] . "', '" . $_POST['imagen_grupo'] . "', '" . $_POST['info_festival'] . "')";
    mysqli_query($con, $query) or die("Error ".mysqli_error($con));
if (isset($_POST['enviar'])){
    echo"<script>alert('El grupo ha sido dado de alta')</script>";
    header("location: eventos.php");
}
}
?>