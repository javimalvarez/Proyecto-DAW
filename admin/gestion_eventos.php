<link rel="stylesheet" href="../css/styleNavbar.css" />
<link rel="stylesheet" href="../css/styleAdmins.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();
/*Para acceder al panel de administrador se requiere que el usuario haya iniciado sesion
y si ha iniciado sesión que tenga perfil de admistrador*/
if (!isset($_SESSION['usuario']) || $_SESSION['tipoUsuario'] != 0) {
    header("Location: ../index.php");
}
require("../database/datos.php");
echo "<head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <title>City Planner</title>
</head>
</div>
<!-- Popup de inicio de sesión -->
<nav id='barra_navegacion' class='nav navbar navbar-expand-lg navbar-light bg-light'id='main-navbar'>
    <a class='navbar-brand mr-auto' href='../index.php'>
    <!-- Esto hay que programarlo mas adelante por si estamos en otro sitio -->
    <img src='../img/LogoSinFondo.png' alt='Logo' width='80' class='d-inline-block align-text-top fotoNavbar' /></a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
    </button>

    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav mr-auto'>
         <li class='nav-item'>
            <a class='nav-link' href='../index.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
                Inicio
            </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='admin.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
                    Gestión de usuarios
                </a>
            </li>
            <li class='nav-item dropdown'>
              <a class='nav-link dropdown-toggle' href='#' id='navbarEventos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Eventos
              </a>
              <div class='dropdown-menu' aria-labelledby='navbarEventos'>
                <a class='dropdown-item' href='alta_eventos.php'>Alta de eventos</a>
                <a class='dropdown-item' href='gestion_eventos.php'>Gestión de eventos</a>
              </div>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../admin/editor.php' id='navbarEventos' role='button' aria-haspopup='true' aria-expanded='false'>
                    Publicar noticia
                </a>
            </li>
        </ul>
    </div>
    <div class='nav-item'>
        <a  href='../login/logout.php'>
            <img id='profile-icon' src='../img/box-arrow-right.svg' />
            <!-- Aquí puedes agregar lógica para mostrar el formulario de inicio de sesión -->
        </a>
    </div>
</nav>
";
if (isset($_POST['salir'])) {
    session_destroy();
    header("Location: ../index.php");
}
$resultado = mostrar_eventos($con);
$num_filas = obtener_num_filas($resultado);
echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<h2 class='tituloUsuarios' >Modificar eventos</h2>";
if ($num_filas == 0) {
    echo "No hay eventos registrados";
} else {
    echo "<div class='content'>
    <div>
    <div  class='table-responsive pp' id='eventos'>
    <table class='container'>
    <tr><th></th><th>ID</th><th>Evento</th><th>Ubicación</th><th>Inicio</th>
    <th>Fin</th><th>Precio</th><th>Web</th><th>Imagen</th><th>Información</th><th colspan='2'></th></tr>";
    while ($evento = obtener_resultados($resultado)) {
        extract($evento);
        echo "<tr id='evento$id_evento'>
        <td><input type='checkbox' name='evento[]' value='$id_evento'/></td>
        <td>$id_evento</td>
        <td>$nombre_evento</td>
        <td  style='width: auto'>$ubicacion</td>
        <td>$fecha_inicio</td>
        <td>$fecha_fin</td>
        <td>$precio</td>
        <td><a href='$web_evento'>$web_evento</a></td>
        <td>$imagen_evento</td>
        <td>$info_evento</td>
        <td><button type='submit' name='borrar_evento' style='background-color:transparent; border:none'>
        <img src='../img/trash.svg' alt='borrar'/></button></td>
        <td><button type='submit' name='editar_evento' style='background-color:transparent; border:none'>
        <img src='../img/pencil.svg' alt='editar'/></button></td></tr>";
    }
    echo "<tr><td colspan='9'></td><td>Borrar seleccionados</td><td colspan='2'>
    <button type='submit' name='borrar' style='background-color:transparent; border:none'>
    <img id='borrar' src='../img/trash.svg' alt='borrar'/></button></td></tr>
    </table></div>";
}

echo "<h5 style='font-weight: bold;'>Festivales</h5>";
$resultado = mostrar_festivales($con);
$num_festivales = obtener_num_filas($resultado);
if ($num_festivales == 0) {
    echo "No hay festivales registrados";
} else {
    echo "<div  class='table-responsive pp'>
    <table class='container'>
    <thead><tr><th></th><th>ID</th><th>Festival</th><th>Inicio</th><th>Fin</th><th>Precio</th><th>Web</th
    ><th>Imagen</th><th>Información</th><th colspan='2'></th></tr></thead><tbody>";
    while ($festival = obtener_resultados($resultado)) {
        extract($festival);
        echo "<tr id='festival$id_festival'>
        <td><input type='checkbox' name='festival[]' value='$id_festival'/></td>
        <td>$id_festival</td>
        <td>$nombre_festival</td>
        <td>$fecha_inicio</td>
        <td>$fecha_fin</td>
        <td>$abono</td>
        <td><a href='$web_festival'>$web_festival</a></td>
        <td>$imagen_festival</td>
        <td>$info_festival</td>
        <td><button type='submit' name='borrar_festival' style='background-color:transparent; border:none'>
        <img id='borrar' src='../img/trash.svg' alt='borrar'/></button></td>
        <td><button type='submit' name='editar_festival' style='background-color:transparent; border:none'>
        <img id='borrar' src='../img/pencil.svg' alt='editar'/></button></td></tr>";
    }
    echo "<tr><td colspan='8'></td><td>Borrar seleccionados</td><td colspan='2'>
    <button type='submit' name='borrar_festival' style='background-color:transparent; border:none'>
    <img src='../img/trash.svg' alt='borrar'/></button></td></tr>
    </tbody></table></div>";
}
echo "</form></div></div>";

//Edicion información eventos
if (isset($_POST['evento']) && !empty($_POST['evento']) && isset($_POST['borrar_evento'])) {
    foreach ($_POST['evento'] as $evento) {
        $query = "DELETE FROM eventos WHERE id_evento=$evento";
        mysqli_query($con, $query);
        echo "<script>let confirm = window.confirm('¿Seguro que quieres borrar este evento?'); if (confirm) {alert('Evento borrado');window.location.reload();} else {window.location.reload();}</script>";
    }
    //header("refresh:0; url=admin.php");
} else if (empty($_POST['evento']) && isset($_POST['borrar_evento'])) {
    echo "<script>alert('Debes seleccionar al menos un evento')</script>";
} else if (isset($_POST['evento']) && !empty($_POST['evento']) && isset($_POST['editar_evento'])) {
    foreach ($_POST['evento'] as $evento) {
        $query = "SELECT * FROM eventos WHERE id_evento=$evento";
        $resultado = mysqli_query($con, $query);
        $evento_editado = obtener_resultados($resultado);
        extract($evento_editado);
        if ($fecha_fin != null) {
            echo "<script>
            document.getElementById('evento$evento').innerHTML = \"<td><input type='checkbox' name='nuevo_evento[]' value='$evento' checked/></td><td>$evento</td><td><input style='border: none;' type='text' name='nuevo_nombre' value='$nombre_evento'/></td><td><input style='border: none;' type='text' name='nueva_ubicacion' value='$ubicacion'/></td><td><input style='border: none;' type='datetime' name='nuevo_inicio' value='$fecha_inicio'/></td><td><input style='border: none;' type='date' name='nuevo_fin' value='$fecha_fin'/></td><td><input style='border: none;' type='number' name='nuevo_precio' value='$precio'/></td><td><input style='border: none;' type='url' name='nueva_web' value='$web_evento'/></td><td><input style='border: none;' type='url' name='nueva_imagen' value='$imagen_evento'/></td><td><input style='border: none;' type='text' name='nueva_info' value='$info_evento'/></td><td colspan='2' align='left'><button type='submit' name='guardar_evento' style='background-color:transparent; border:none'><img src='../img/floppy.svg' alt='guardar'/></button></td>\";
            </script>";
        } else {
            echo "<script>
            document.getElementById('evento$evento').innerHTML = \"<td><input type='checkbox' name='nuevo_evento[]' value='$evento' checked/></td><td>$evento</td><td><input style='border: none;' type='text' name='nuevo_nombre' value='$nombre_evento'/></td><td><input style='border: none;' type='text' name='nueva_ubicacion' value='$ubicacion'/></td><td><input style='border: none;' type='datetime' name='nuevo_inicio' value='$fecha_inicio'/></td><td>$fecha_fin</td><td><input style='border: none;' type='number' name='nuevo_precio' value='$precio'/></td><td><input style='border: none;' type='url' name='nueva_web' value='$web_evento'/></td><td><input style='border: none;' type='url' name='nueva_imagen' value='$imagen_evento'/></td><td><input style='border: none;' type='text' name='nueva_info' value='$info_evento'/></td><td colspan='2' align='left'><button type='submit' name='guardar_evento' style='background-color:transparent; border:none'><img src='../img/floppy.svg' alt='guardar'/></button></td>\";
            </script>";
        }
    }
} else if (empty($_POST['evento']) && isset($_POST['editar_evento'])) {
    echo "<script>alert('Debes seleccionar un evento')</script>";
} else if (isset($_POST['guardar_evento']) && isset($_POST['nuevo_evento']) && !empty($_POST['nuevo_evento'])) {
    foreach ($_POST['nuevo_evento'] as $evento) {
        actualizar_eventos($con, $_POST['nuevo_nombre'], $_POST['nueva_ubicacion'], $_POST['nuevo_inicio'], $_POST['nuevo_fin'], $_POST['nuevo_precio'], $_POST['nueva_web'], $_POST['nueva_imagen'], $_POST['nueva_info'], $evento);
    }
    echo "<script>window.location.reload();</script>";
    exit();
}

//Edición información festivales
else if (isset($_POST['festival']) && !empty($_POST['festival']) && isset($_POST['borrar_festival'])) {
    foreach ($_POST['festival'] as $festival) {
        $query = "DELETE FROM festivales WHERE id_festival=$festival";
        mysqli_query($con, $query);
        echo "<script>let confirm = window.confirm('¿Seguro que quieres borrar este festival?'); if (confirm) {alert('Festival borrado');window.location.reload();} else {window.location.reload();}</script>";
    }
    //header("refresh:0; url=admin.php");
} else if (empty($_POST['festival']) && isset($_POST['borrar_festival'])) {
    echo "<script>alert('Debes seleccionar al menos un festival')</script>";
} else if (isset($_POST['festival']) && !empty($_POST['festival']) && isset($_POST['editar_festival'])) {
    foreach ($_POST['festival'] as $festival) {
        $query = "SELECT * FROM festivales WHERE id_festival=$festival";
        $resultado = mysqli_query($con, $query);
        $festival_edit = obtener_resultados($resultado);
        extract($festival_edit);
        echo "<script>
            document.getElementById('festival$festival').innerHTML = \"<td><input type='checkbox' name='nuevo_festival[]' value='$festival' checked/></td><td>$festival</td><td><input style='border: none;' type='text' name='nuevo_nombref' value='$nombre_festival'/></td><td><input style='border: none;' type='datetime' name='nuevo_iniciof' value='$fecha_inicio'/></td><td><input style='border: none;' type='date' name='nuevo_finf' value='$fecha_fin'/></td><td><input style='border: none;' type='number' name='nuevo_abono' value='$abono'/></td><td><input style='border: none;' type='text' name='nueva_webf' value='$web_festival'/></td><td><input style='border: none;' type='text' name='nueva_imagenf' value='$imagen_festival'/></td><td><input style='border: none;' type='text' name='nueva_infof' value='$info_festival'/></td><td colspan='2' align='left'><button type='submit' name='guardar_festival' style='background-color:transparent; border:none'><img src='../img/floppy.svg' alt='guardar'/></button></td>\";
        </script>";
    }
} else if (empty($_POST['festival']) && isset($_POST['editar_festival'])) {
    echo "<script>alert('Debes seleccionar un festival')</script>";
} else if (isset($_POST['guardar_festival']) && isset($_POST['nuevo_festival']) && !empty($_POST['nuevo_festival'])) {
    foreach ($_POST['nuevo_festival'] as $festival) {
        actualizar_festivales($con, $_POST['nuevo_nombref'], $_POST['nuevo_iniciof'], $_POST['nuevo_finf'], $_POST['nuevo_abono'], $_POST['nueva_webf'], $_POST['nueva_imagenf'], $_POST['nueva_infof'], $festival);
        echo "<script>window.location.reload();</script>";
        exit();
    }
}
mysqli_close($con);

?>
<footer>
    <div class='text-center p-3 footerCopyright' style='background-color: rgba(0, 0, 0, 0.2);'>
        © 2024 Copyright:
        <a class='text-white' href=''>CityPlanner</a>
    </div>
    <!-- Copyright -->
</footer>
<?php
/* Funciones */
function mostrar_eventos($con)
{
    $resultado = mysqli_query($con, "SELECT e.* FROM eventos e INNER JOIN usuarios u ON e.id_usuario = u.id_usuario  WHERE u.tipo=0");
    return $resultado;
}

function actualizar_eventos($con, $evento_nombre, $ubicacion, $f_inicio, $f_fin, $precio, $web, $imagen, $info, $id_evento)
{
    mysqli_query($con, "UPDATE eventos SET evento_nombre='$evento_nombre', ubicacion='$ubicacion', fecha_inicio='$f_inicio', fecha_fin='$f_fin', precio='$precio', web_evento='$web', imagen_evento='$imagen', info_evento='$info' WHERE id_evento=$id_evento");
}

function actualizar_festivales($con, $nombre, $f_inicio, $f_fin, $precio, $web, $imagen, $info, $id_festival)
{
    mysqli_query($con, "UPDATE festivales SET nombre_festival='$nombre', fecha_inicio='$f_inicio', fecha_fin='$f_fin', abono=$precio, web_festival='$web', imagen_festival='$imagen', info_festival='$info' WHERE id_festival=$id_festival");
}

function mostrar_festivales($con)
{
    $resultado = mysqli_query($con, "SELECT * FROM festivales;");
    return $resultado;
}

function obtener_num_filas($resultado)
{
    return mysqli_num_rows($resultado);
}

function obtener_resultados($resultado)
{
    return mysqli_fetch_array($resultado);
}
?>
<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>