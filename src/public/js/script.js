var tableUsers;

$(document).ready(function () {
    tableUsers = $('#table-users').DataTable({
        'destroy' : true,
        "order": [[0, "asc"]],
        paging: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
        dom: 'Blfrtip',
        fixedColumns:   true,
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-success',
                messageTop: 'Lista de Usuarios',
                filename: 'Usuarios',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            }, {
                extend: 'pdf',
                text: 'PDF',
                className: 'btn btn-primary',
                messageTop: 'Lista de Usuarios',
                filename: 'Usuarios',
                exportOptions: {
                    modifier: {
                        selected: true
                    },
                    columns: [ 0, 1, 2, 3, 4]
                }
            }
        ],
        "language": {
            "url":"//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        "initComplete": function( settings, json ) {
            $('.dt-buttons').css({
                'justify-content':'center',
                'padding-bottom': '20px',
            });

            $('.btn-group>.btn-group:not(:last-child)>.btn, .btn-group>.btn.dropdown-toggle-split:first-child, .btn-group>.btn:not(:last-child):not(.dropdown-toggle)').css({
                'border-top-right-radius': 'inherit',
                'border-bottom-right-radius': 'inherit',
                'width' : '75px'
            });

            $('.btn-group>.btn-group:not(:first-child)>.btn, .btn-group>.btn:nth-child(n+3), .btn-group>:not(.btn-check)+.btn').css({
                'border-top-left-radius': 'inherit',
                'border-bottom-left-radius': 'inherit',
                'width' : '75px'
            });

            $('.buttons-pdf').css({
                'margin-left':'10px',
            });

            $( tableUsers.table().container() ).on( 'keyup', 'thead input', function () {
                tableUsers
                    .column( $(this).data('index') )
                    .search( this.value )
                    .draw();
            });
        }
    });
});
