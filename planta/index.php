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
            <th>anexo</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
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
            <th>anexo</th>
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
<script src="/SCL/js/consulta.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>
<script>
    $("#separa").css('overflow','scroll');

     $(function() {
        $.contextMenu({
            selector: '#example tbody tr', 
            callback: function(key, options) {
                var m = "clicked: " + key;
                window.console && console.log(m);
                var table = $('#example').DataTable();
                var saida = $(this).html().split('</td>');
                var data1 = table.row( $(this) ).data();

                if (key == "op1") {
                    // alert(saida[4].substr(4));

                    if(window.matchMedia("(max-width: 767px)").matches){
                        // Mobile
                        $.post("dado2.php", {saida: 'endereco', id: data1[0]}, function(data){
                            copiarclipboard(data);
                        });
                    } else{
                        // Normal
                        copiarclipboard(saida[4].substr(4));
                    }

                }else if(key == "op2"){
                    // alert(saida[10].substr(4));
                    
                    if(window.matchMedia("(max-width: 767px)").matches){
                        // Mobile
                        $.post("dado2.php", {saida: 'circuito', id: data1[0]}, function(data){
                            copiarclipboard(data);
                        });
                    } else{
                        // Normal
                        copiarclipboard(saida[10].substr(4));
                    }

                }else if(key == "op3"){
                    // alert(saida[11].substr(4));
                    
                    if(window.matchMedia("(max-width: 767px)").matches){
                        // Mobile
                        $.post("dado2.php", {saida: 'ip_link', id: data1[0]}, function(data){
                            copiarclipboard(data);
                        });
                    } else{
                        // Normal
                        copiarclipboard(saida[11].substr(4));
                    }

                }else if(key == "op4"){
                    // alert(saida[13].substr(4));
                    
                    if(window.matchMedia("(max-width: 767px)").matches){
                        // Mobile
                        $.post("dado2.php", {saida: 'ip_firewall', id: data1[0]}, function(data){
                            copiarclipboard(data);
                        });
                    } else{
                        // Normal
                        copiarclipboard(saida[13].substr(4));
                    }

                }
                alert("Copiado");
            },
            items: {
                "valor": {name: "Copiar para o ClipBoard", icon: "fa-align-center", disabled: true},
                "sep1": "----Copiar para o ClipBoard-----",
                "op1": {name: "Endereço", icon: "fa-address-card"},
                "op2": {name: "Circuito", icon: "fa-key"},
                "op3": {name: "IP Link", icon:  "fa-network-wired"},
                "op4": {name: "IP Firewall", icon: "fa-network-wired"}
            }
        });

        function copiarclipboard(valor) {
            var ghg = $('#inpudt').html('<input type="text" value="' + valor + '">');
            var sds = ghg.children( "input" );
            sds.select();
            document.execCommand("copy");
            $('#inpudt').html('');
        };

    });
</script>
</body>
</html>
