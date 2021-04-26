

$(document).ready(function() {


    $("#donwload").click(function() {
        var table = $('#example').DataTable();
 
        alert( 'Column index 0 is '+
            (table.column( 0 ).visible() === true ? 'visible' : 'not visible')
        );

        table.column( 0 ).visible( false );
    });

    // $('#example thead tr').clone(true).appendTo( '#example thead' );
    var table = $('#example').DataTable({
        processing: true,
        lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'Todos']],
              ajax: {
                url: '/SCL/planta/dados.php',
                dataSrc: 'data'
                },
                createdRow: function( row, data, dataIndex ) {
                    if ( data[5] == "Não" ) {
                      $(row).addClass( 'redClass' );
                    }
                },
                responsive: true,
                orderCellsTop: true,
                fixedHeader: true,
                columnDefs: [ {
                    "targets": 0,
                    "data": null,
                    "defaultContent": "<a href='#' class='myButton'>+</a>"
                },     
                {
                    "targets": 5,
                    "data": "ativo1",
                    "render": function ( data, type, row, meta ) {
                        if (data == "S"){
                            return 'Sim';
                        }else{
                            if(!$(row).hasClass('redClass')){
                                $(row).addClass('redClass');
                            }
                            return 'Não';
                        }
                    }
                },{
                    "targets": 6,
                    "data": "ativo2",
                    "render": function ( data, type, row, meta ) {
                        if (data == "S"){
                            return 'Sim';
                        }else{
                            if($(row).hasClass('redClass')){
                                $(row).addClass('redClass');
                            }
                            return 'Não';
                        }
                    }
                }, ],
                "language": {
                    sEmptyTable: "Nenhum registro encontrado",
                    sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
                    sInfoFiltered: "(Filtrados de _MAX_ registros)",
                    sInfoPostFix: "",
                    sInfoThousands: ".",
                    sLengthMenu: "_MENU_ resultados por página",
                    sLoadingRecords: "Carregando...",
                    sProcessing: "Processando...",
                    sZeroRecords: "Nenhum registro encontrado",
                    sSearch: "Pesquisar",
                    oPaginate: {
                        sNext: "Próximo",
                        sPrevious: "Anterior",
                        sFirst: "Primeiro",
                        sLast: "Último"
                    },
                    oAria: {
                        sSortAscending: ": Ordenar colunas de forma ascendente",
                        sSortDescending: ": Ordenar colunas de forma descendente"
                    }
                },
    });

    var corposelect = "<option selected disabled>Selecione Opção</option>";
    $('#example thead th').each( function () {
        var title = $('#example tfoot th').eq( $(this).index() ).text();
        corposelect = corposelect + "<option value='" + $(this).index() + "'>" + title + "</option>";
    } );
    $('#saidaselect').html(corposelect);

    $('#example tfoot tr').appendTo('#example thead');
    $('#example').css("border-bottom","solid 1px black");

    $('#example thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Pesquisar '+title+'" />' );
    } );
    

    $('#example input').eq(0).css("width","3rem");
    $('#example input').eq(2).css("width","3rem");
    $('#example input').eq(3).css("width","4rem");
    $('#example input').eq(4).css("width","17rem");
    $('#example input').eq(5).css("width","3rem");
    $('#example input').eq(6).css("width","3rem");
    $('#example input').eq(7).css("width","4rem");
    $('#example input').eq(8).css("width","4rem");
    $('#example input').eq(9).css("width","4rem");
    $('#example input').eq(12).css("width","4rem");
    $('#example input').eq(13).css("width","6rem");
    $('#example input').eq(14).css("width","6rem");


    if(window.matchMedia("(max-width: 767px)").matches){
        $("#mobileFilter").css("display","block");
        table.column( 3 ).visible( false );
        table.column( 4 ).visible( false );
        table.column( 5 ).visible( false );
        table.column( 6 ).visible( false );
        table.column( 7 ).visible( false );
        table.column( 8 ).visible( false );
        table.column( 9 ).visible( false );
        table.column( 10 ).visible( false );
        table.column( 11 ).visible( false );
        table.column( 12 ).visible( false );
        table.column( 13 ).visible( false );
        table.column( 14 ).visible( false );
        table.column( 15 ).visible( false );
        table.column( 16 ).visible( false );
    }else{
        $("#mobileFilter").css("display","none");
    }

    $('#example input').keyup( function() {
        // alert($(this).parent().index());
        table.column($(this).parent().index()).search($(this).val()).draw();
    });

    $('#example tbody').on( 'click', 'a', function () {
        var data = table.row( $(this).parents('tr') ).data();
        window.location.href = "link.php?id=" + data[0];
    } );


$("#limparid").click(function() {
    var table = $('#example').DataTable();
    $('input').val("");

    table
        .search('')
        .columns().search('')
        .draw();

    $("#example thead tr:eq(1) th").each( function () {
        table.column($(this).index()).search("").draw();    
    } );

});



} );