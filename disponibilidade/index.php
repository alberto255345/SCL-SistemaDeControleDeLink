<?php
error_reporting(E_ERROR | E_PARSE);

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);



if($_SESSION['admDisp'] != 1 and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}

$sql = "Select u.avatar, u.nome, u.setor, u.telefone, u.email, u.edicao, l.data, u.hash from user as u left join last_login as l on u.cod = l.cod_user where u.cod = '" . $_SESSION['usuario_log'] . "';";
$stmt2 = $connect->prepare($sql);
$stmt2->execute();
$dado = $stmt2->fetch();

include("../linkgeral.php");
?>

    <link rel="stylesheet" href="/SCL/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/SCL/css/jquery-ui.css">
</head>
<body>
<div>
    <div class="pamens">
    </div>
    <div class="pamens2"></div>
</div>
<div style="display: inline-flex; height: 100%;">
<?PHP 
include("../menu/menu.php");
?>

<div id="separa" style="align-items: center; margin: 5px; border-radius: 5px;">
<div style="text-align: center;">

<div style="text-align: left;">
<a href="/SCL/disponibilidade/newdisp.php" class="myButton">Inserir Disponibilidade</a>&nbsp;
<a id="filtrar" href="#" class="myButton">Filtrar Disponibilidade</a>
<a id="donwload" href="#" class="myButton">Download Base da Disponibilidade</a>
</div>



<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Link</th>
                <th>Disponibilidade</th>
                <th>IP</th>
                <th>UF</th>
                <th>Operadora</th>
                <th>Link Ativo</th>
            </tr>
        </thead>
      

    </table>

</div>
</div>
 

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>

<script src="/SCL/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="/SCL/js/jquery-ui.js"></script>

<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>

<script>


$(document).ready(function() {


    $("#donwload").click(function() {
        var table = $('#example').DataTable();
 
        alert( 'Column index 0 is '+
            (table.column( 0 ).visible() === true ? 'visible' : 'not visible')
        );

        table.column( 0 ).visible( false );
    });

    $('#example thead tr').clone(true).appendTo( '#example thead' );
    var table = $('#example').DataTable({
        processing: true,
        lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'Todos']],
              ajax: {
                url: '/SCL/disponibilidade/dados.php?inicio=valor&fim=valor',
                dataSrc: 'data'
                },
                orderCellsTop: true,
                fixedHeader: true,
                columnDefs: [      
                {
                    "targets": 1,
                    "data": "DATA",
                    "type": 'extract-date',
                    "render": function ( data, type, row ) {
                        var dateSplit = data.split('-');
                        return dateSplit[2] +'/'+ dateSplit[1] +'/'+ dateSplit[0];
                }
            }
             ],
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

    
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Pesquisar '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
    $('input').eq(1).css("width","3rem");
    $('input').eq(2).css("width","5rem");
    // $('input').eq(4).css("width","4rem");
    $('input').eq(5).css("width","5rem");
    $('input').eq(6).css("width","3rem");
    $('input').eq(7).css("width","3rem");
    $('input').eq(8).css("width","3rem");
} );

</script>
</body>
</html>
