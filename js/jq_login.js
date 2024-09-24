$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            type: 'POST',
            url: '../php/login.php',
            data: formData,
            dataType: 'json',
            encode: true
        })
        .done(function(response) {
            if (response.status == 'success') {
                window.location.href = '../index.html'; // Redirigir a la vista principal
            } else {
                $('#response').html('<p>' + response.message + '</p>');
            }
        })
        .fail(function(data) {
            $('#response').html('<p>Ha ocurrido un error. Por favor, inténtelo de nuevo.</p>');
        });
    });
});
