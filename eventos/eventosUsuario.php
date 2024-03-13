<?php
session_start();
//Requiere que el usuario haya iniciado sesion
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}
require_once("../database/datos.php");
$con=mysqli_connect($host, $user, $pass, $db_name) or die("Error ".mysqli_error($con));


// Obtener el nombre del usuario de la sesión
$nombre_usuario = $_SESSION['usuario'];

//Obtengo el id_usuario mediante consultas para usarlo en la consulta principal
$query_id_usuario = "SELECT id_usuario FROM usuarios WHERE email = '$nombre_usuario'";
$result_id_usuario = mysqli_query($con, $query_id_usuario);
$row_id_usuario = mysqli_fetch_assoc($result_id_usuario);

$id_usuario = $row_id_usuario['id_usuario'];

//consulta principal
$query_eventosUsuario="SELECT u.id_usuario, u.nombre, e.id_evento, e.nombre AS nombre_evento, e.id_tipo, e.ubicacion, e.fecha_comienzo, e.fecha_fin, e.info
FROM usuarios u
JOIN usuarios_eventos ue ON u.id_usuario = ue.id_usuario
JOIN eventos e ON ue.id_evento = e.id_evento
WHERE u.id_usuario = $id_usuario";


$result_eventosUsuarios = mysqli_query($con, $query_eventosUsuario) or die("Error ".mysqli_error($con));


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos de Usuarios</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h2>Eventos de:
<?php echo $nombre_usuario; ?> 
</h2>

<table>
    <thead>
    <tr>
        <th>Evento</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Informacion</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($result_eventosUsuarios)) {
        echo "<tr>";
        echo "<td>" . $row['nombre_evento'] . "</td>";
        echo "<td>" . $row['fecha_comienzo'] . "</td>";
        echo "<td>" . $row['fecha_fin'] . "</td>";
        echo "<td>" . $row['info'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>