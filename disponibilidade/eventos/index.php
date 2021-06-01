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

include("../../linkgeral.php");
?>

    <link rel="stylesheet" href="/SCL/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/SCL/css/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
</head>
<body>
<div>
    <div class="pamens">
    </div>
    <div class="pamens2"></div>
</div>
<div style="display: inline-flex; height: 100%;">
<?PHP 
include("../../menu/menu.php");
?>

<div id="separa" style="align-items: center; margin: 5px; border-radius: 5px;">
<div id="test1" style="text-align: center;">

<div style="text-align: left;">
    <a id="donwload" href="#" class="myButton">Download Base</a>
    <a id="limparid" href="#" class="myButton">Limpar Filtro</a>
</div>
<br>
<div id="mobileFilter">
    <select id="saidaselect" class="form-control" aria-label="Default select">
        <option selected disabled>Selecione Opção</option>
    </select>
    <div class="input-group mb-3">
        <input type="text" id="textfilter" class="form-control" placeholder="Digite..." aria-label="Pesquisar"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" id="buttonmobilefilter" type="button">Filtrar</button>
        </div>
    </div>
    <span id="filtrarid"></span>
</div>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Opções</th>
            <th>BA</th>
            <th>HOST</th>
            <th>Falha</th>
            <th>ID do Evento</th>
            <th>Hora da Falha</th>
            <th>ID de Recuperação</th>
            <th>Hora do Clear</th>
            <th>Tempo de Interrupção</th>
            <th>Grupo de Falha</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th>Opções</th>
            <th>BA</th>
            <th>HOST</th>
            <th>Falha</th>
            <th>ID do Evento</th>
            <th>Hora da Falha</th>
            <th>ID de Recuperação</th>
            <th>Hora do Clear</th>
            <th>Tempo de Interrupção</th>
            <th>Grupo de Falha</th>
        </tr>
    </tfoot>

</table>

</div>
<div id="inpudt"></div>
</div>
</div>

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>

<script src="/SCL/js/jquery.dataTables.min.js"></script>
<script src="/SCL/js/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/filtering/type-based/accent-neutralise.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
<script src="/SCL/js/consulta2.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>

</body>
</html>
