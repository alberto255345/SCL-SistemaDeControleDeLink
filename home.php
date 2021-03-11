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
<div style="text-align: center; width: 182vh;">

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

</div>
</div>

</div>

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="./js/coreMenu.js"></script>
</body>
</html>

