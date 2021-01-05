$(document).ready(function () {        
    $('#proveedores').dataTable({
        responsive: true,
        "order": [0,'desc'],
        "language": {
            "lengthMenu": "Mostrar _MENU_ proveedores",
            "zeroRecords": "Los resultados aprobados aparecerán en esta tabla.",
            "info": "Mostrando del _START_ al _END_ de un total de _TOTAL_",
            "infoEmpty": "Mostrando del 0 al 0 de un total de 0",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }        
    });
});


$(document).ready(function () {        
    $('#misproveedores').dataTable({
        responsive: true,
        "order": [0,'desc'],
        "language": {
            "lengthMenu": "Mostrar _MENU_ proveedores",
            "zeroRecords": "Tus proveedores aparecerán en esta tabla.",
            "info": "Mostrando del _START_ al _END_ de un total de _TOTAL_",
            "infoEmpty": "Mostrando del 0 al 0 de un total de 0",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }        
    });
});

$(document).ready(function () {        
    $('#usuarios').dataTable({
        responsive: true,        
        "language": {
            "lengthMenu": "Mostrar _MENU_ usuarios",
            "zeroRecords": "Los usuarios aparecerán en esta tabla.",
            "info": "Mostrando del _START_ al _END_ de un total de _TOTAL_",
            "infoEmpty": "Mostrando del 0 al 0 de un total de 0",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }        
    });
});


$(document).ready(function () {        
    $('#cotizacion').dataTable({       
        responsive: true,        
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "Los registros aparecerán en esta tabla.",
            "info": "Mostrando del _START_ al _END_ de un total de _TOTAL_",
            "infoEmpty": "Mostrando del 0 al 0 de un total de 0",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }        
    });
});

