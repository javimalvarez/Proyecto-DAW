<?php
echo"<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
    <!--Este formulario se mostrara en cada evento y las opiniones se pueden asociar tanto al evento como el usuario
    Habra una tabla que guarde las opiniones donde se asocia usuario y evento-->
    <!--El usuario se puede recuperar de la variable de sesión de PHP-->
    <textarea name='opinion' id='user_opinion' cols='60' rows='7' placeholder='Deja aquí tu comentario'></textarea><br/>
    <input type='submit' name='enviar' value='Enviar comentario'>
</form>";
?>