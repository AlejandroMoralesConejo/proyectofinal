$(document).ready(function() {
    $("#buscador").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#fila .card").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#busca").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".buscar").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});