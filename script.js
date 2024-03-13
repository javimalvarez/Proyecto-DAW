function showContent(contentId) {

    // Obtén todas las pestañas
  
    const tabs = document.querySelectorAll('.nav-link');
  
  
    // Recorre todas las pestañas y quita la clase 'active'
  
    tabs.forEach(tab => {
  
      tab.classList.remove('active');
  
    });
  
  
    // Agrega la clase 'active' al enlace seleccionado
  
    const selectedTab = document.querySelector(`[onclick="showContent('${contentId}')"]`);
  
    selectedTab.classList.add('active');
  
  
    // Oculta y muestra el contenido correspondiente
  
    const contents = document.querySelectorAll('.card-body > div');
  
    contents.forEach(content => {
  
      content.style.display = 'none';
  
    });
  
    document.getElementById(contentId).style.display = 'block';
  
  }



// $('.message a').click(function(){
//     $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
//  });


// DISEÑO ARANTXA
var profileIcon = document.getElementById('profile-icon');
var loginForm = document.querySelector('.login');

// Función para abrir y cerrar el formulario de inicio de sesión
function toggleLoginForm() {
    if (loginForm.style.display === 'block') {
        loginForm.style.display = 'none';
    } else {
        loginForm.style.display = 'block';
    }
}

// Event listener para abrir y cerrar el formulario al hacer clic en el icono profile-icon
profileIcon.addEventListener('click', toggleLoginForm);

// Event listener para cerrar el formulario si se hace clic fuera de él
document.addEventListener('click', function(event) {
     let targetElement = event.target; // Elemento en el que se hizo clic
    console.log(targetElement.id);
    // Verificar si el clic ocurrió dentro del formulario de inicio de sesión o en el icono del perfil
    if (!loginForm.contains(targetElement) && targetElement.id !== 'profile-icon'&&targetElement.id !== 'enlaceContraseña'&&targetElement.id !== 'atras') {
        loginForm.style.display = 'none';
        
    }
    
});



//Comprobacion campos vacios login
/*function comprobarLogin(){
   const divErrores=document.createElement("div");
   divErrores.setAttribute("class", "errores");
   divErrores.style.color="red";
    if (document.getElementById("correo").value == ""&&document.getElementById("pass").value == "") {
        return false;
        divErrores.innerHTML="Todos los campos son obligatorios";
        document.querySelector("reset-pass").appendChild(divErrores);
    }
}
document.querySelector('.botonLogin').addEventListener("click",comprobarLogin);*/
//PROGRAMAR CODIGO
let enlaceContraseña=document.getElementById("enlaceContraseña");
function reemplazoLogin(){
    loginForm.innerHTML="<div class='login-triangle'></div><a id='atras' href='#'style='text-decoration:none'>\< Iniciar sesión</a><form class='login-container' action='login/resetPassword.php' method='post'><h2 class='login-header'>¿Has olvidado tu contraseña?</h2><p>Por favor introduce tu correo,<br/>te enviaremos una nueva contraseña</p><p><input type='email' id='correo' name='correo_recuperacion' placeholder='Dirección de correo'></p><p><input class='botonLogin' type='submit' value='Solicitar nueva Contraseña'></p></form>";
    function mostrarAnterior(){
        loginForm.innerHTML="<div class='login-triangle'></div><form class='login-container' action='login/login.php' method='post'><h2 class='login-header'>Iniciar Sesion</h2><p><input type='email' id='correo' name='correo' placeholder='Correo'></p><p><input type='password' id='pass' name='pass' placeholder='Contraseña'></p><p><input class='botonLogin' type='submit' value='Acceder'></p><?php session_start(); if (isset($_SESSION['mensaje'])) {echo $_SESSION['mensaje']; unset($_SESSION['mensaje']);}?><a id='enlaceContraseña' href='#'>No recuerdo mi contraseña</a><hr><p>¿Aún no tienes cuenta?</p><p><input type='button' class='registro' onclick=\"window.location.href = 'login/registro.php'\" type='submit' value='Regístrate'></p></form>";
        document.getElementById("enlaceContraseña").addEventListener("click", reemplazoLogin);
    
    }
    document.getElementById("atras").addEventListener("click", mostrarAnterior);
}

document.getElementById("enlaceContraseña").addEventListener("click", reemplazoLogin);



