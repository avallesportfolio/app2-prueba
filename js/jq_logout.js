$(document).ready(function() {
    $('#logoutButton').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'php/logout.php',
            encode: true
        })
        .done(function(response) {
            window.location.href = 'login.html'; // Redirigir a la vista de inicio de sesión
        })
        .fail(function(data) {
            alert('Ha ocurrido un error. Por favor, inténtelo de nuevo.');
        });
    });
});
