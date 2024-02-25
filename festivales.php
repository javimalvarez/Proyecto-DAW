<?php
require("datos.php");
echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<h3>Festivales:</h3>
<label for='ini_festival' required>Fecha comienzo:</label>
<input type='date' name='ini_festival'>
<label for='fin_festival'>Fecha fin:</label>
<input type='date' name='fin_festival' required><br/>
<label for='url_festival'>Web:</label>
<input type='url' name='url_festival' placeholder='URL festival'><br/>
<input type='file' name='imagen_festival'acept='image/*'><br/>
<label for='info_festival'>Otra información:</label><br/>
<textarea name='info_festival' id='info_festival' cols='30' rows='3'></textarea><br/>
<input type='submit' name='enviar' value='Alta festival'>
</form>";
$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error " . mysqli_error($con));
if (isset($_POST['enviar']) && isset($_POST['ini_festival']) && isset($_POST['fin_festival']) && isset($_POST['url_festival']) && isset($_POST['info_festival'])) {
    $query = "INSERT INTO festivales (inicio, fin, web, imagen, otra_info) 
    VALUES ('" . $_POST['ini_festival'] . "', '" . $_POST['fin_festival'] . "', '" . $_POST['url_festival'] . "', '" . $_POST['imagen_festival'] . "', '" . $_POST['info_festival'] . "')";
    mysqli_query($con, $query) or die("Error " . mysqli_error($con));
}
