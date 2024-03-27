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



//PROGRAMAR CODIGO
