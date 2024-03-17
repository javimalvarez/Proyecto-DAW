<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
session_start();
//Requiere que el usuario haya iniciado sesion
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}
require("../database/datos.php");
#Elimina los warning manteniendo el resto de errores
#error_reporting(E_ALL & ~E_WARNING);
echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<h3>Festivales:</h3>
<label for='nombre_festival'>Festival:</label>
<input type='text' name='nombre_festival' placeholder='Indica nombre festival'><br/>
<label for='ini_festival' required>Fecha comienzo:</label>
<input type='date' name='ini_festival' required>
<label for='fin_festival'>Fecha fin:</label>
<input type='date' name='fin_festival' required><br/>
<label for='url_festival'>Web:</label>
<input type='url' name='web_festival' placeholder='URL festival'><br/>
<input type='url' name='imagen_festival' placeholder='URL imagen'><br/>
<label for='info_festival'>Otra información:</label><br/>
<textarea name='info_festival' id='info_festival' cols='30' rows='3'></textarea><br/>
<input type='submit' name='enviar' value='Alta festival'>
</form>";
$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error " . mysqli_error($con));
$query = "INSERT INTO festivales (nombre_festival,fecha_inicio,fecha_fin, web_festival, imagen_festival, info_festival) 
VALUES ('".$_POST['nombre_festival']."','" . $_POST['ini_festival'] . "', '" . $_POST['fin_festival'] . "', '" . $_POST['web_festival'] . "', '" . $_POST['imagen_festival'] . "', '" . $_POST['info_festival'] . "')";
mysqli_query($con, $query) or die("Error " . mysqli_error($con));
if (isset($_POST['enviar'])){
    echo"<script>alert('El festival ha sido dado de alta')</script>";
    header("refresh:3; url=eventos.html");
}
?>

<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>