<?php
echo"<h3>Calculadora hash</h3><form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
<input type='text' name='pass' id='pass' placeholder='Introduce tu contraseña'>
<input type='submit' value='Calcular hash'></form>";
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['pass']) && !empty($_POST['pass'])){
        $hash=password_hash($_POST['pass'],PASSWORD_DEFAULT);
        echo "<label for='hash'>Hash:</label><textarea name='hash' cols='62' rows='1' disabled>$hash</textarea>";
    }
}
?>