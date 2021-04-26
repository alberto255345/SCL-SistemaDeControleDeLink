<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

include("linkgeral.php");

?>
</head>
<body>
<div>
    <div class="pamens"></div>
    <div class="pamens2"></div>
</div>
<div style="display: inline-flex; height: 100%;">
<?PHP 
include("./menu/menu.php");
?>

<div id="separa" style="align-items: center; margin: 5px; border-radius: 5px;">
<div style="text-align: center; width: 100%;">

<h3>Sistema de Controle de Links</h3>
<?PHP 
if(isset($_SESSION['mensagem'])){
    if($_SESSION['mensagem'] != ""){
        echo $_SESSION['mensagem'];
        $_SESSION['mensagem'] = "";
        unset($_SESSION['mensagem']);
    }
}
?>
<div id="saindamenu" >
<div class="card clickmenu" >Usuário</div>
<div class="card clickmenu" >Gráficos</div>
<div class="card clickmenu" >Disponibilidade</div>
<div class="card clickmenu" >Consulta de Links</div>
<div class="card clickmenu" >Link Grafana</div>
<div class="card clickmenu" >Gestão de Os</div>
<div class="card clickmenu" >Zabbix</div>
</div>

</div>
</div>

</div>

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="./js/coreMenu.js"></script>
<script src="/SCL/js/geral.js"></script>
<script>
$('#accordion li').each( function () {
        // var title = $('#accordion li').eq( $(this).index() ).clone().appendTo("#saindamenu");
} );
</script>
</body>
</html>

