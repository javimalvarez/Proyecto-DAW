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
    var targetElement = event.target; // Elemento en el que se hizo clic

    // Verificar si el clic ocurrió dentro del formulario de inicio de sesión o en el icono del perfil
    if (!loginForm.contains(targetElement) && targetElement.id !== 'profile-icon') {
        loginForm.style.display = 'none'; // Cerrar el formulario si se hace clic fuera de él
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

function reemplazoLogin(){
//     var producto1 = document.getElementById('inicio');
//     var producto2 = document.getElementById('contra');
  
  
  
//    switch(idButton) {
//    case 1:
  
//             producto1.style.display = 'block';
//             producto2.style.display = 'none';
//       break;
  
//    case 2:
//             producto1.style.display = 'none';
//             producto2.style.display = 'block';
//       break;
  

  
//   default:
//             alert("hay un problema: No existe el producto.")
//           }
            $('.inicio').hide();

         $('.contra').show();


        //  $('.login-container').toggle();
    // const loginForm = document.getElementById("login-form");
    // loginForm.innerHTML="<div class='login-triangle'></div><form class='login-container' action='login/resetPassword.php' method='post'><h2 class='login-header'>¿Has olvidado tu contraseña?</h2><p>Por favor introduce tu correo,<br/>te enviaremos una nueva contraseña</p><p><input type='email' id='correo' name='correo_recuperacion' placeholder='Dirección de correo'></p><p><input class='botonLogin' type='submit' value='Solicitar nueva Contraseña'></p></form>"
}
function volverLogin(){
    $('.inicio').show();

    $('.contra').hide();
}

 document.getElementById("recuperar_contraseña").addEventListener("click",reemplazoLogin);
