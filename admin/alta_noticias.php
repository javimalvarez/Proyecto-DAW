<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<?php
session_start();
/*Para acceder al panel de administrador se requiere que el usuario haya iniciado sesion
y si ha iniciado sesión que tenga perfil de admistrador*/
if (!isset($_SESSION['usuario']) || $_SESSION['tipoUsuario'] != 0) {
  header("Location: ../index.php");
}
require("../database/datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name);
echo"<form action='".$_SERVER['PHP_SELF']."' method='post'>
    <input type='text' name='titular' placeholder='Título de la noticia' required><br/><br/>
    <textarea id='texto' name='texto' placeholder='Escribe aquí el texto de la noticia' required></textarea>
    <input type='submit' value='Enviar' name='enviar'></form>";
echo"<script>
    ClassicEditor
        .create( document.querySelector( '#texto' ) )
        .catch( error => {
        console.error( error );
        } );
</script>";
$query="INSERT INTO noticias (titular, texto) VALUES('$_POST[titular]', '$_POST[texto]')";
mysqli_query($con, $query) or die("Error en la consulta: ".mysqli_error($con));
mysqli_close($con);
?>
