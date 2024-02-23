<!-- prueba para verificar -->
<form action="" method="POST">
    <input type="email" id="usuario" name="usuario" placeholder="Email" value="aordoyo@msn.com">
    <input type="password" id="password" name="password" placeholder="Contraseña" value="1234">
    <input type="submit" name="formulario" value="Entrar">
</form>
<?php
require("utils/bd.php");
session_start();


if(isset($_POST['formulario'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    login($usuario, $password);
};

?>