//CREANDO AJAX PARA EL BOTON EDITAR
$('#btnMostrarFormulario').click(function() {
    $.ajax({
        url:'{{ route("secuencias.edit")'+ idsecuencias,
        type: 'GET',
        dataType: 'html',
        success: function(response) {
            $('#divFormulario').html(response);
        }
    });
});



//href="{{ route('secuencias.edit',$secuencia->idsecuencia) }}"

