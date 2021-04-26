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
<?PHP
    if($_SESSION['admLink'] == 1 or $_SESSION['tipo'] == 'Admin'){
        echo '<a href="/SCL/planta/newunidade.php" class="myButton">Criar Unidade</a>&nbsp;';
        echo '<a href="#" class="myButton">Criar Link</a>';
    }
?>
    <a id="donwload" href="#" class="myButton">Download Base</a>
    <a id="limparid" href="#" class="myButton">Limpar Filtro</a>
</div>

<div id="mobileFilter">
    <select id="saidaselect" class="form-control" aria-label="Default select">
    <option selected disabled>Selecione Opção</option>
    </select>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Digite..." aria-label="Pesquisar" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button">Filtrar</button>
        </div>
    </div>
    <span id="filtrarid"></span>
</div>

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Unidade</th>
                <th>UF</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th class="titulo1">Unidade Ativa</th>
                <th class="titulo1">Link Ativo</th>
                <th>Tipo</th>
                <th>Operadora</th>
                <th>Vel. (MB)</th>
                <th>Circuito</th>
                <th>IP Link</th>
                <th>FortiGate</th>
                <th>IP FortiGate</th>
                <th class="titulo1">Interface FortiGate</th>
                <th>IP Operadora</th>
                <th>Unidade Concentradora</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Unidade</th>
                <th>UF</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th>Unidade Ativa</th>
                <th>Link Ativo</th>
                <th>Tipo</th>
                <th>Operadora</th>
                <th>Vel. (MB)</th>
                <th>Circuito</th>
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
<script src="/SCL/js/consulta.js"></script>

<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>

<script>
$("#limparid").click(function() {

$('input').val("");

});
</script>
</body>
</html>
