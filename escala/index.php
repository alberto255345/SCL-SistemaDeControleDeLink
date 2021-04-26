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
include("../menu/menu.php");
?>

<div id="separa" style="align-items: center; margin: 5px; border-radius: 5px;">
<div style="text-align: center;">

<div style="text-align: left;">
<?PHP
    if($_SESSION['admLink'] == 1 or $_SESSION['tipo'] == 'Admin'){
        echo '<a href="/SCL/planta/newunidade.php" class="myButton">Criar Unidade</a>&nbsp;';
        echo '<a href="/SCL/planta/newlink.php" class="myButton">Criar Link</a>';
    }
?>
    <a id="donwload" href="#" class="myButton">Download Base</a>
    <a id="limparid" href="#" class="myButton">Limpar Filtro</a>
</div>


<div id="ganttescala" ></div>


</div>
</div>
</div>

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/gantt-schedule-timeline-calendar"></script>

<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>


<script src="/SCL/js/gantt-js.js"></script>

</body>
</html>
