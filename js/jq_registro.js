$(document).ready(function() {
    $('#registroForm').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            phone: $('#phone').val(),
            address: $('#address').val()
        };

        $.ajax({
            type: 'POST',
            url: '../php/registro.php',
            data: formData,
            dataType: 'json',
            encode: true
        })
        .done(function(response) {
            $('#response').html('<p>' + response.message + '</p>');
        })
        .fail(function(data) {
            $('#response').html('<p>Ha ocurrido un error. Por favor, inténtelo de nuevo.</p>');
        });
    });
});
