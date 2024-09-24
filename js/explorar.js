$(document).ready(function() {
    $('#searchForm').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            location: $('#location').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
            guests: $('#guests').val()
        };

        $.ajax({
            type: 'POST',
            url: 'php/search.php',
            data: formData,
            dataType: 'json',
            encode: true
        })
        .done(function(response) {
            var results = $('#results');
            results.empty();
            if (response.status == 'success') {
                response.data.forEach(function(property) {
                    results.append('<p>' + property.name + ' - ' + property.city + ' - ' + property.price_per_night + '€/noche</p>');
                });
            } else {
                results.html('<p>' + response.message + '</p>');
            }
        })
        .fail(function(data) {
            $('#results').html('<p>Ha ocurrido un error. Por favor, inténtelo de nuevo.</p>');
        });
    });
});
