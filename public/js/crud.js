jQuery(document).ready(function($){
    ////----- Open the modal to CREATE a match -----////
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#modalFormData').trigger("reset");
        jQuery('#linkEditorModal').modal('show');
    });
 
    ////----- Open the modal to UPDATE a match -----////
    jQuery('body').on('click', '.open-modal', function () {
        var link_id = $(this).val();
        $.get(`admin/find/${link_id}`, function (data) {
            jQuery('#link_id').val(data.idPartido);
            jQuery('#nombre').val(data.nombre);
            jQuery('#fecha').val(data.fecha);
            jQuery('#hora').val(data.hora);
            jQuery('#limite').val(data.limite);
            jQuery('#idPista').val(data.idPista);
            jQuery('#btn-save').val("update");
            jQuery('#linkEditorModal').modal('show');
        })
    });
 
    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            nombre: jQuery('#nombre').val(),
            fecha: jQuery('#fecha').val(),
            hora: jQuery('#hora').val(),
            limite: jQuery('#limite').val(),
            idPista: jQuery('#idPista').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var link_id = jQuery('#link_id').val();
        var ajaxurl = 'admin/add';
        if (state == "update") {
            type = "PUT";
            ajaxurl = `admin/update/${link_id}`;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

                var link = '<tr class="buscar" id="link' + data.idPartido + '"><th scope="row">' + data.idPartido + '</th><td>' + data.nombre + '</td><td value="'+ data.fecha +'">';
                link += '<strong>' + data.fecha + '</strong></td>';
                // if (typeof data.limite == "undefined") {
                //     data.limite == 0;
                // }
                link += '<td>' + data.hora + '</td><td>0</td><td>' + data.idPista + '</td>';
                link += '<td><button class="btn btn-info open-modal" value="' + data.idPartido + '">Editar</button>&nbsp;';
                link += '<button class="btn btn-danger delete-link" value="' + data.idPartido + '">Borrar</button></td></tr>';
                if (state == "add") {
                    jQuery('#links-list').append(link);
                } else {
                    $(`#link${link_id}`).replaceWith(link);
                }
                jQuery('#modalFormData').trigger("reset");
                jQuery('#linkEditorModal').modal('hide');
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
 
    ////----- DELETE a link and remove from the page -----////
    jQuery('.delete-link').click(function () {
        var link_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: `admin/delete/${link_id}`,
            success: function (data) {
                console.log(data);
                $("#link" + link_id).fadeOut(500,function(){$(this).remove();});
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});