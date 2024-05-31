<?php

//Función que devuelve la consulta de eventos provincia y fecha que no esten asociados a festivales
function categoriaProvinciaFecha($con, $categoria, $provincia, $f_inicio, $f_fin)
{
    $query = "SELECT e.*, g.*, f.web_festival, f.info_festival, p.provincia FROM eventos e INNER JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo LEFT JOIN festivales f ON f.id_festival = e.id_festival INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE  e.id_tipo IN (" . implode(',', $categoria) . ") AND e.id_provincia = $provincia AND e.fecha_inicio BETWEEN '$f_inicio' AND '$f_fin' AND e.id_festival IS NULL";
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    return $result;
}

//Devuelve información de todos los eventos que hay en una determinada provincia que no esten asociados a festivales
function categoriaProvincia($con, $categoria, $provincia)
{
    $query = "SELECT e.*, g.web_grupo, g.info_grupo, p.provincia FROM eventos e INNER JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.id_tipo IN (" . implode(',', $categoria) . ") AND e.id_provincia = $provincia AND e.id_festival IS NULL";
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    return $result;
}

//Devuelve información de todos los eventos no esten asociados a festivales
function categoria($con, $categoria)
{
    $query = "SELECT e.*, g.*, p.provincia FROM eventos e INNER JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo  INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.id_tipo IN (" . implode(',', $categoria) . ")AND e.id_festival IS NULL";
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    return $result;
}
//Devuelve información de todos los eventos gratuitos que no esten asociados a festivales
function categoriaGratis($con, $categoria)
{
    $query = "SELECT e.*, g.*, p.provincia FROM eventos e INNER JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.id_tipo IN (" . implode(',', $categoria) . ") AND e.precio = 0 AND e.id_festival IS NULL";
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    return $result;
}

function categoriaFecha($con, $categoria, $f_inicio, $f_fin){
    $query = "SELECT e.*, g.*, p.provincia FROM eventos e INNER JOIN tipo_eventos t ON e.id_tipo = t.id_tipo LEFT JOIN grupos g ON e.id_grupo = g.id_grupo INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.id_tipo IN (" . implode(',', $categoria) . ") AND e.fecha_inicio BETWEEN '$f_inicio' AND '$f_fin' AND e.id_festival IS NULL";
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    return $result;
}
##Festivales    
//Devuelve información de un festival
function festivales($con, $id_festival)
{
    $query = "SELECT e.fecha_inicio AS f_concierto, f.*, g.* FROM eventos e LEFT JOIN festivales f ON e.id_festival = f.id_festival LEFT JOIN grupos g ON e.id_grupo = g.id_grupo WHERE e.id_tipo = 1 AND e.id_festival = $id_festival ORDER BY e.fecha_inicio ASC";
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    return $result;
}
//Devuelve información de todos los festivales por fecha
function festivalesFecha($con, $f_inicio, $f_fin)
{
    
    $query = "SELECT e.fecha_inicio AS f_concierto, f.*, g.* FROM eventos e LEFT JOIN festivales f ON e.id_festival = f.id_festival LEFT JOIN grupos g ON e.id_grupo = g.id_grupo WHERE e.id_tipo = 1 AND f.fecha_inicio BETWEEN '$f_inicio' AND '$f_fin' GROUP BY e.id_festival ORDER BY e.fecha_inicio ASC";
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    return $result;
}
//Devuelve información de todos los festivales de una provincia por fecha
function festivalesProvincia($con, $provincia, $f_inicio, $f_fin)
{
    $query = "SELECT e.*, f.*, g.*, p.provincia  FROM eventos e LEFT JOIN festivales f ON e.id_festival = f.id_festival LEFT JOIN grupos g ON e.id_grupo = g.id_grupo INNER JOIN provincias p ON p.id_provincia = e.id_provincia WHERE e.id_provincia = '$provincia' AND e.id_tipo = 1 AND f.fecha_inicio BETWEEN '$f_inicio' AND '$f_fin' GROUP BY e.id_festival ORDER BY e.fecha_inicio ASC";
    $result = mysqli_query($con, $query) or die("Error en la consulta: " . mysqli_error($con));
    return $result;
}
