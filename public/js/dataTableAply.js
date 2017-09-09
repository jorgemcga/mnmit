jQuery(document).ready(function() {
    jQuery('#table').DataTable({
        "language": {
            "lengthMenu": '<select class="form-control">'+
            '<option value="10">10</option>'+
            '<option value="25">20</option>'+
            '<option value="50">50</option>'+
            '<option value="-1">Todos</option>'+
            '</select>',
            "sLoadingRecords": "Carregando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearchPlaceholder": "Pesquisar...",
            "sSearch": "",
            "infoEmpty": "Nenhum item para exibir",
            "sInfo": "Mostrando _START_ à _END_ de _TOTAL_ itens",
            "sInfoFiltered": "(Filtrado de _MAX_ total de itens)",
            "paginate": {
                "previous": "Anterior",
                "next" : "Próxima",
                "last" : "Última",
                "first" : "Primeira"
            }
        }
    });
} );