<?php
error_reporting(E_ERROR | E_PARSE);

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['tipo'] != 'Admin'){
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
<div style="display: inline-flex; height: 100%; width:100%">
<?PHP 
include("../menu/menu.php");
?>

<div id="separa" style="align-items: center; margin: 5px; border-radius: 5px;">
<div id="test1" style="text-align: center; width: 100%;">

<H2>Comandos de Link Zabbix com SCL</H2>

<?PHP 

    $sql = "SELECT id, title_command, edit, user, command FROM comandos;";
    $result = $connect->prepare($sql);
    $result->execute();
    while($fetch = $result->fetch(/* PDO::FETCH_ASSOC */)) {

        $yy = 0;
        foreach ($fetch as $value){
            if($yy == 1){
                echo $value . " - ";
            }elseif($yy == 2){
                echo '<input style="width: auto" type="text" value="' . $value . '">';
            }elseif($yy == 8){
                echo '<br>';
                echo '<textarea style="width: 100%;">' . $value . '</textarea>';
            }elseif($yy == 4){
                echo '<input type="text" value="' . $value . '">';
            }elseif($yy == 6){
                echo '<input type="text" value="' . $value . '">';
            }
            $yy = $yy + 1;
        }
        echo "<br>";
    }

?>


</div>
</div>
 

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>

<script>

</script>

</body>
</html>
