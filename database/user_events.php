<?php
//Calendario de eventos favoritos
session_start();
require("datos.php");
$queryFestivalesFav="SELECT id_festival FROM usuarios_eventos WHERE id_usuario =". $_SESSION['id_usuario']." AND id_festival IS NOT NULL";
$resultFestivalesFav = mysqli_query($con, $queryFestivalesFav) or die("Error en la consulta: " . mysqli_error($con));
while ($favorito = mysqli_fetch_assoc($resultFestivalesFav)) {
    $query_festivales = "SELECT f.nombre_festival AS title, f.fecha_inicio AS start, f.fecha_fin AS end, COALESCE(f.web_festival, '') url FROM festivales f WHERE f.id_festival = ".$favorito['id_festival'];
    $result_festivales = mysqli_query($con, $query_festivales) or die("Error en la consulta: " . mysqli_error($con));
    while ($festival = mysqli_fetch_assoc($result_festivales)) {
        $festival['end'] = date('Y-m-d', strtotime($festival['end'].' + 1 days'));
        $eventos[] = $festival;
    };
}

$queryEventosFav="SELECT id_evento FROM usuarios_eventos WHERE id_usuario =". $_SESSION['id_usuario']." AND id_evento IS NOT NULL";
$resultEventosFav = mysqli_query($con, $queryEventosFav) or die("Error en la consulta: " . mysqli_error($con));
while ($favorito = mysqli_fetch_assoc($resultEventosFav)) {
    $query = "SELECT e.nombre_evento AS title, e.fecha_inicio AS start, e.fecha_fin AS end, COALESCE(e.web_evento, '') url FROM eventos e WHERE e.id_evento = ".$favorito['id_evento'];
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    while ($evento = mysqli_fetch_assoc($result)) {
        //Eventos sin fecha de fin
        if ($evento['end'] == null) {
            $evento['end'] = date('Y-m-d', strtotime($evento['start']));
        } 
        else {
            $evento['end'] = date('Y-m-d', strtotime($evento['end'].' + 1 days'));
        }
        $eventos[] = $evento;
};
}
echo json_encode($eventos);
?>