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
document.addEventListener('click', function (event) {
    let targetElement = event.target; // Elemento en el que se hizo clic
    console.log(targetElement.id);
    // Verificar si el clic ocurrió dentro del formulario de inicio de sesión o en el icono del perfil
    if (!loginForm.contains(targetElement) && targetElement.id !== 'profile-icon' && targetElement.id !== 'enlaceContraseña' && targetElement.id !== 'atras') {
        loginForm.style.display = 'none';

    }

});
document.addEventListener("DOMContentLoaded", function() {
    console.log('DOM fully loaded and parsed');
    var navLinks = document.querySelectorAll('.nav-link');
    console.log('navLinks:', navLinks);

    function setActiveLink(link) {
        // Añadir la clase 'active' al enlace
        link.classList.add('active');
        // Guardar el enlace activo en localStorage
        localStorage.setItem('activeNavLink', link.getAttribute('href'));
        console.log('activeNavLink set to:', link.getAttribute('href'));
    }

    // Restaurar el enlace activo de localStorage
    var activeLink = localStorage.getItem('activeNavLink');
    console.log('activeLink from localStorage:', activeLink);
    if (activeLink) {
        const url = new URL(activeLink, window.location.href);
        const link = [...navLinks].find(link => {
          const linkUrl = new URL(link.getAttribute('href'), window.location.href);
          return linkUrl.href === url.href;
        });
        console.log('Found active link:', link);
        if (link) {
            setActiveLink(link);
        } else {
            // If no matching link is found, set the first link as active
            setActiveLink(navLinks[0]);
        }
    } else {
        // Agregar la clase active al primer enlace si no hay ninguno guardado en localStorage
        console.log("No active link found in localStorage. Adding 'active' class to the first link.");
        setActiveLink(navLinks[0]);
    }
    

    navLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            console.log('Link clicked:', this.getAttribute('href'));
            // Eliminar la clase 'active' de todos los enlaces
            navLinks.forEach(function(otherLink) {
                if (otherLink!== link && otherLink.classList.contains('active')) {
                    otherLink.classList.remove('active');
                }
            });
            // Establecer este enlace como activo
            setActiveLink(link);
        });
    });
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
let enlaceContraseña = document.getElementById("enlaceContraseña");
function reemplazoLogin() {
    loginForm.innerHTML = "<div class='login-triangle'></div><a id='atras' href='#'style='text-decoration:none'>\< Iniciar sesión</a><form class='login-container' action='login/resetPassword.php' method='post'><h2 class='login-header'>¿Has olvidado tu contraseña?</h2><p>Por favor introduce tu correo,<br/>te enviaremos una nueva contraseña</p><p><input type='email' id='correo' name='correo_recuperacion' placeholder='Dirección de correo'></p><p><input class='botonLogin' type='submit' value='Solicitar nueva Contraseña'></p></form>";
    function mostrarAnterior() {
        loginForm.innerHTML = "<div class='login-triangle'></div><form class='login-container' action='login/login.php' method='post'><h2 class='login-header'>Iniciar Sesion</h2><p><input type='email' id='correo' name='correo' placeholder='Correo'></p><p><input type='password' id='pass' name='pass' placeholder='Contraseña'></p><p><input class='botonLogin' type='submit' value='Acceder'></p><?php session_start(); if (isset($_SESSION['mensaje'])) {echo $_SESSION['mensaje']; unset($_SESSION['mensaje']);}?><a id='enlaceContraseña' href='#'>No recuerdo mi contraseña</a><hr><p>¿Aún no tienes cuenta?</p><p><input type='button' class='registro' onclick=\"window.location.href = 'login/registro.php'\" type='submit' value='Regístrate'></p></form>";
        document.getElementById("enlaceContraseña").addEventListener("click", reemplazoLogin);

    }
    document.getElementById("atras").addEventListener("click", mostrarAnterior);
}


//ESTO ES PARA LAS CARDS
function redirectToEvent(idEvento) {
    // Redirige a la página del evento específico
    setTimeout(function() {
        location.href = './eventos/informacionEvento.php?id_evento=' + idEvento;
    }, 0);
}
function redirectToEventGeneral(idEvento) {
    // Redirige a la página del evento específico
    setTimeout(function() {
        location.href = '../../eventos/informacionEvento.php?id_evento=' + idEvento;
    }, 0);
}
function redirectToFestival(idFestival) {
    // Redirige a la página del evento específico
    setTimeout(function() {
        location.href = '../../eventos/informacionFestival.php?id_festival=' + idFestival;
    }, 0);
}
function redirectToFestivales(idFestival) {
    // Redirige a la página del evento específico
    setTimeout(function() {
        location.href = './eventos/informacionFestival.php?id_festival=' + idFestival;
    }, 0);
}
//document.getElementById("enlaceContraseña").addEventListener("click", reemplazoLogin);

