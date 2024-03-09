<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
session_start();
/*Para acceder al panel de administrador se requiere que el usuario haya iniciado sesion
y si ha iniciado sesión que tenga perfil de admistrador*/
if (!isset($_SESSION['usuario'])||$_SESSION['tipoUsuario']!='0') {
    header("Location: ../index.php");
}
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
#$query = mysqli_query($con, "SHOW DATABASES LIKE '$db_name'");


$resultado = obtener_usuarios($con);
$num_filas = obtener_num_filas($resultado);

echo "<h1>Panel de administrador</h1>
<h2>Gestión de usuarios</h2>";
    if($num_filas == 0) {
        echo "No hay usuarios registrados";
    }
    else {
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'><table border='1'>
            <tr><th></th><th></th><th>Nombre</th><th>Apellidos</th><th>email</th><th>Perfil</th><th></th><th></th></tr>";
            while($fila = obtener_resultados($resultado)) {
                extract($fila);
                if($tipo==0){
                    $tipo="Administrador";
                }
                else if($tipo==1){
                    $tipo="Usuario";
                }
                else{
                    $tipo="Alta eventos";
                }
                echo "<tr id='$id_usuario'><td><input type='checkbox' name='user[]' value='$id_usuario'/></td>
                <td>$id_usuario</td>
                <td>$nombre</td>
                <td>$apellidos</td>
                <td>$email</td>
                <td>$tipo</td>
                <td><input type='submit' name='eliminar' value='borrar'/></td>
                <td><input type='submit' name='editar' value='editar'/></td></tr>";
            }
            echo "</table>";
    }
    echo "<h3>Alta de administrador</h3>
    <label for='name'>Nombre:</label>
    <input type='text' name='nombre'>
    <label for='apellidos'>Apellidos:</label>
    <input type='text' name='apellidos'><br/>
    <label for='email'>Email:</label>
    <input type='email' name='email'>
    <label for='contraseña'>Contraseña:</label>
    <input type='password' name='contraseña'><br/>
    <input type='submit' name='alta' value='Alta de administrador'/>";

   
if(isset($_POST['user'])&&!empty($_POST['user'])&&isset($_POST['eliminar'])||isset($_POST['eliminarSeleccionados'])) {
    foreach ($_POST['user'] as $user) {
        /*$query ="DELETE FROM usuarios WHERE id_usuario=$user";
        mysqli_query($con, $query);*/
        borrar_usuario($user);
        echo"<script>alert('Usuario borrado')</script>";
    }
    header("Location: admin.php");
    exit;
}
else if(empty($_POST['user'])&&isset($_POST['eliminar'])||isset($_POST['eliminarSeleccionados'])) {
    echo"<script>alert('Debes seleccionar al menos un usuario')</script>";
    header("Location: admin.php");
    exit;
}

if(isset($_POST['user'])&&!empty($_POST['user'])&&isset($_POST['editar'])) {
    foreach ($_POST['user'] as $user) {
        $query ="SELECT * FROM usuarios WHERE id_usuario=$user";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        extract($row);
        echo"<script> 
        let filaEditable=\"<td><input type='checkbox' name='user[]' value='$user' checked/></td><td>$user</td><td><input style='border: none;' type='text' name='nombre' value='$nombre'/></td><td><input style='border: none;' type='text' name='apellidos'value='$apellidos'/></td><td><input style='border: none;' type='email' name='correo' value='$email'/></td><td><select style='border: none;' name='tipo'><option value='0'>Administrador</option><option value='1'selected>Usuario</option><option value='2'>Alta eventos</option></select></td><td><input type='submit' name='eliminar' value='borrar'/></td><td><input type='submit' name='actualizar' value='Guardar'/></td>\";
        document.getElementById('$user').innerHTML = filaEditable;
        </script>";
    }

}else if(empty($_POST['user'])&&isset($_POST['editar'])) {
    echo"<script>alert('Debes seleccionar un usuario')</script>";
    header("Location: admin.php");
    exit;
}

if (isset($_POST['actualizar'])&&isset($_POST['user'])&&!empty($_POST['user'])) {
    foreach($_POST['user'] as $user){
        actualizar_usuario($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['contraseña'], $_POST['tipo'], $user);
        /*$query_update ="UPDATE usuarios SET nombre = '".$_POST['nombre']."', apellidos = '".$_POST['apellidos']."', email = '".$_POST['correo']."', tipo = ".$_POST['tipo']." WHERE id_usuario = $user";
        mysqli_query($con, $query_update)or die("Error: ".mysqli_error($con));*/
        echo"<script>alert('Datos cambiados')</script>";
        header("Location: admin.php");
        exit;
    }
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['alta'])&&isset($_POST['nombre'])&&!empty($_POST['nombre'])&&isset($_POST['apellidos'])&&!empty($_POST['apellidos'])&&isset($_POST['email'])&&!empty($_POST['email'])&&isset($_POST['contraseña'])&&!empty($_POST['contraseña'])) {
        if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[\w\W]{8,}$/', $_POST['contraseña'])) {
            $passEncrypted = password_hash($_POST['contraseña'],PASSWORD_DEFAULT);
            insertar_usuario($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $passEncrypted);
            echo"<script>alert('Nuevo administrador dado de alta')</script>";
        }else{
            echo"<script>alert('La contraseña debe contener al menos una mayúscula, una minúscula y un número')</script>";
        }
    }else{
        echo"<script>alert('No es posible enviar el formulario con campos vacios')</script>";
    }
}    
echo"</form>";
/* Funciones */
function obtener_usuarios($con) {
    $resultado = mysqli_query($con, "SELECT * FROM usuarios;");
    return $resultado;
}

function insertar_usuario($nombre, $apellido, $email, $contraseña) {
    global $con;
    mysqli_query($con, "INSERT INTO usuarios(nombre, apellidos, email, contraseña, tipo)
                        VALUES 
                        ('$nombre', '$apellido', '$email', '$contraseña', 0)");
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
<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>