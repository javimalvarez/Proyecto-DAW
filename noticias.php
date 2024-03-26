<?php
require("database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
$query_noticias="SELECT * FROM noticias";
$result_noticias = mysqli_query($con, $query_noticias) or die("Error en la consulta: ".mysqli_error($con));
while($noticias = mysqli_fetch_assoc($result_noticias)){
    extract($noticias);
    echo"<article>
    <h3>$titulo</h3>
    <div>$texto</div>
    </article>";
}
mysqli_close($con);
?>