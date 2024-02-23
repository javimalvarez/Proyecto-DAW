<?php
require("datos_conex.php");

$con = mysqli_connect($host, $usuario, $pass, $db_nombre) or die("Error al conectar a la BD");



function obtener_num_filas($resultado) {
    return mysqli_num_rows($resultado);
}

function obtener_resultados($resultado) {
    return mysqli_fetch_array($resultado);
}

//LOGIN
function login($usuario, $password) {
    global $con;

    $query = mysqli_prepare($con, "SELECT * FROM usuarios WHERE email = ? AND contrasenya = ?");
    mysqli_stmt_bind_param($query, "ss", $usuario, $password);
    mysqli_stmt_execute($query);
    $resultado = mysqli_stmt_get_result($query);

    if(obtener_num_filas($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario'] = $usuario;
        
        if($usuario['tipo'] == 1) {
            header("location: ../administrador/index.php");
        } else {
            header("location: ../usuarioRegistrado/index.php");
        }
        
        var_dump($_SESSION['usuario']);
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>