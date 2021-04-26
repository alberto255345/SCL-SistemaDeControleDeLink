<?php
error_reporting(E_ERROR | E_PARSE);

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['telecom'] != 1 and $_SESSION['tipo'] != 'Admin'){
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
    <div class="pamens"></div>
    <div class="pamens2"></div>
</div>
<div style="display: inline-flex; height: 100%;">
<?PHP 
include("../menu/menu.php");
?>
<div id="separa" style="align-items: center; margin: 5px; border-radius: 5px;">
<div style="text-align: center;">

<div style="display: inline-flex">
<label for="unidade">Unidade</label>
<input class="form-control" type="text" name="unifild" id="unifild">
<label for="endereco">Endereço</label>
<input class="form-control" type="text" name="endefild" id="endefild">
<button>Buscar</button>
</div>

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Unidade</th>
                <th>UF</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th>Nº</th>
                <th>Complemento</th>
                <th>Bairro</th>
                <th>CEP</th>
                <th>Tipo</th>
                <th>Serviço</th>
                <th>Operadora</th>
                <th>Vel. (MB)</th>
                <th>Circuito</th>
                <th>Data Ativação</th>
                <th>Rede Própria?</th>
                <th>IP Link</th>
                <th>FortiGate</th>
                <th>IP FortiGate</th>
                <th>Interface FortiGate</th>
                <th>IP Operadora</th>
                <th>Unidade Concentradora</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Hapclínica São Luis</td>
                <td>MA</td>
                <td>São Luis</td>
                <td>Av. Guaxenduba</td>
                <td>260</td>
                <td>-</td>
                <td>Centro</td>
                <td>65015-560</td>
                <td>MPLS</td>
                <td>MPLS</td>
                <td>OI</td>
                <td>10</td>
                <td>Circuito</td>
                <td>Data Ativação</td>
                <td>Rede Própria?</td>
                <td>IP Link</td>
                <td>FortiGate</td>
                <td>IP FortiGate</td>
                <td>Interface FortiGate</td>
                <td>IP Operadora</td>
                <td>Unidade Concentradora</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
            <th>Unidade</th>
                <th>UF</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th>Nº</th>
                <th>Complemento</th>
                <th>Bairro</th>
                <th>CEP</th>
                <th>Tipo</th>
                <th>Serviço</th>
                <th>Operadora</th>
                <th>Vel. (MB)</th>
                <th>Circuito</th>
                <th>Data Ativação</th>
                <th>Rede Própria?</th>
                <th>IP Link</th>
                <th>FortiGate</th>
                <th>IP FortiGate</th>
                <th>Interface FortiGate</th>
                <th>IP Operadora</th>
                <th>Unidade Concentradora</th>
            </tr>
        </tfoot>
    </table>

</div>
</div>
<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="/SCL/js/jquery.dataTables.min.js"></script>
<script src="/SCL/js/jquery-ui.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>
<script>
$("#separa").css('overflow','scroll');
$(document).ready(function() {
    $('#example').DataTable({
        processing: true,
              ajax: {
                url: '/SCL/link/dados.php',
                dataSrc: 'data'
                },
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
} );

$( function() {
    var availableTags = [
        <?PHP 
            $sql2 =  "SELECT unidade FROM unidade_hapvida order by unidade ";
            $saida = $connect->prepare($sql2);
            $saida->execute();
            while ($row = $saida->fetch()) {
                echo "\"" . $row[unidade] . "\",";
            } 

            ?>
      
    ];
    $( "#unifild" ).autocomplete({
      source: availableTags
    });
  } );
</script>
</body>
</html>
