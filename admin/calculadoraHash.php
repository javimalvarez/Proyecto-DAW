<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora hash</title>
    <style>
        html{
            font-family:Arial, Helvetica, sans-serif;
        }
        #hash, #pass {
            color: #000;
            background-color: #fff;
            border-radius: 5px;
            padding: 5px;
        }
        #calculadora, #contenedor{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        #button{
            border-radius: 5px;
            padding: 5px;
            background-color: #000;
            color: #fff;
            font-weight: bold;
        }
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    echo"<div id='contenedor'><h3>Calculadora hash</h3><form id='calculadora' method='post' action='" . $_SERVER['PHP_SELF'] . "'>
    <input type='password' id='pass' name='pass' id='pass' placeholder='Introduce tu contraseña'><br/><br/>
    <button id='button' type='submit'><img src='../img/calculator.svg'>&nbspCalcular hash</button><br></form></div>";
    if($_SERVER['REQUEST_METHOD']==='POST'){
        if(isset($_POST['pass']) && !empty($_POST['pass'])){
            $hash=password_hash($_POST['pass'],PASSWORD_DEFAULT);
            echo "<script>document.getElementById('calculadora').innerHTML+=\"<label for='hash'>Este es el resultado del hash:</label><br/><textarea id='hash' name='hash' cols='62' rows='1' disabled>$hash</textarea>\";</script>";
        }
    }
    ?>
    <footer>2024 Calculadora hash</footer>
</body>
</html>