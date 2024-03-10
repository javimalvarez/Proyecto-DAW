<link rel="stylesheet" href="styleAdministrador.css">
<?php
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
#$query = mysqli_query($con, "SHOW DATABASES LIKE '$db_name'");

session_start();
$resultado = obtener_usuarios($con);
$num_filas = obtener_num_filas($resultado);

echo "<h2>Usuarios registrados</h2>";

if ($num_filas == 0) {
    echo "No hay usuarios registrados";
}
else {
    echo "<table>";
    echo "<tr><th>ID USUARIO</th><th>NOMBRE</th><th>APELLIDOS</th><th>EMAIL</th><th>TIPO</th><th>BORRAR</th></tr>";
    
    while ($fila = obtener_resultados($resultado)) {
        extract($fila);
        echo "<tr><td>$id_usuario</td>";
        echo "<td>$nombre</td>";
        echo "<td>$apellidos</td>";
        echo "<td>$email</td>";
        echo "<td>$tipo</td>";
        echo "<td><input type='checkbox' name='borrar[]' value='$id_usuario'/></td></tr>";
    }

    echo "<tr><td colspan='6' style='text-align: right'><input type='submit' value='Borrar'/></td></tr>";
    echo "</table>";
}


/* Funciones */

function obtener_usuarios($con) {
    $resultado = mysqli_query($con, "SELECT * FROM usuarios;");
    return $resultado;
}

function insertar_usuario($nombre, $apellido, $email, $contraseña, $tipo) {
    global $con;
    mysqli_query($con, "INSERT INTO usuarios(nombre, apellidos, email, contraseña, tipo)
                        VALUES 
                        ('$nombre', '$apellido', '$email', '$contraseña', '$tipo')");
}

function borrar_usuario($referencias) {
    global $con;
    $query = "DELETE FROM usuarios 
              WHERE id_usuario IN (";
    foreach($referencias as $referencia) {
        $query = $query.$referencia.", ";
    }
    $query = $query."0)";
    mysqli_query($con, $query);
}

function actualizar_usuario($nombre, $apellido, $email, $contraseña, $tipo, $id) {
    global $con;
    mysqli_query($con, "UPDATE usuarios 
                        SET nombre='$nombre', apellidos='$apellido', email='$email', contraseña='$contraseña', tipo='$tipo'
                        WHERE id_usuario='$id'");
}

function monstrar_eventos_usuario($id_usuario) {
    global $con;
    $query = mysqli_query($con, "SELECT * FROM eventos 
                                WHERE 
                                id_usuario_creador='$id_usuario'");
    return obtener_resultados($query);
}


function obtener_num_filas($resultado) {
    return mysqli_num_rows($resultado);
}

function obtener_resultados($resultado) {
    return mysqli_fetch_array($resultado);
}

?>