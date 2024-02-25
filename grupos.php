<?php
require("datos.php");
echo"<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<h3>Grupos:</h3>
<label for='nombre_grupo'>Nombre:</label>
<input type='text' name='nombre_grupo'><br/>
<label for='genero_grupo'>Género:</label>
<input type='text' name='genero_grupo'><br/>
<label for='url_grupo'>Web:</label>
<input type='url' name='url_grupo' placeholder='URL grupo'><br/>
<input type='file' name='imagen_grupo' acept='image/*'><br/>
<label for='info_festival'>Otra información:</label><br/>
<textarea name='info_festival' id='info_festival' cols='30' rows='3'></textarea><br/>
<input type='submit' name='enviar' value='Alta grupo'>
</form>";
$con=mysqli_connect($host, $user, $pass, $db_name) or die("Error ".mysqli_error($con));
$query="INSERT INTO grupos (nombre, genero, web, imagen, otra_info) 
VALUES ('" . $_POST['nombre_grupo'] . "', '" . $_POST['genero_grupo'] . "', '" . $_POST['url_grupo'] . "', '" . $_POST['imagen_grupo'] . "', '" . $_POST['info_festival'] . "')";
mysqli_query($con, $query) or die("Error ".mysqli_error($con));
?>