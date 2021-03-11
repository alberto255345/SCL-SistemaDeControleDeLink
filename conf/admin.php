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
        <div class="containerMenu" onclick="myFunctionMenu(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </div>
    <div class="pamens2"></div>
</div>
<div style="display: inline-flex; height: 100%; width:100%">
<?PHP 
include("../menu/menu.php");
?>

<div id="separa" style="align-items: center; margin: 5px; border-radius: 5px;">
<div style="text-align: center; width: 100%;">

<H2>Acessos dos Usuários</H2>

<?PHP 

$sql = "Select * from user";
$stmt3 = $connect->prepare($sql);
$stmt3->execute();

while ($row = $stmt3->fetch()) {
    echo '<button type="button" class="collapsible card">' . $row['nome'] . '</button><div class="content card">';
    echo '<form class="">';
        echo '<div class="container">';
            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                    echo '<label for="entradanome">Nome Completo</label>';
                    echo '<input class="form-control" id="entradanome" placeholder="Nome" value="' . $row['nome'] . '">';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                        echo '<label for="ativo">Ativo?</label>';
                        echo '<select class="form-control" id="ativo">';
                        echo '<option value="0" ' . (($row['ativo'] == "0") ? "selected" : "") . ' >Não</option>';
                        echo '<option value="1" ' . (($row['ativo'] == "1") ? "selected" : "") . ' >Sim</option>';
                        echo '</select>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                    echo '<label for="telefoneid">Numero de Telefone</label>';
                    echo '<input class="form-control" id="telefoneid" placeholder="Telefone" value="' . $row['telefone'] . '">';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                    echo '<label for="entradaemail">Email / Login</label>';
                    echo '<input class="form-control" id="entradaemail" placeholder="Email" value="' . $row['email'] . '">';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                        echo '<label for="ativo">Tipo de Usuário</label>';
                        echo '<select class="form-control" id="ativo">';
                        echo '<option value="Admin" ' . (($row['tipo'] == "Admin") ? "selected" : "") . ' >Administrador</option>';
                        echo '<option value="User" ' . (($row['tipo'] == "User") ? "selected" : "") . ' >Usuário Comum</option>';
                        echo '<option value="View" ' . (($row['tipo'] == "View") ? "selected" : "") . ' >Vizualização</option>';
                        echo '</select>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                    echo '<label for="avatarentrada">Avatar</label>';
                    echo '<input class="form-control" id="avatarentrada" placeholder="Avatar" value="' . $row['avatar'] . '">';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                    echo '<label for="codigoid">Codigo de Recuperação</label>';
                    echo '<input class="form-control" id="codigoid" placeholder="codigo" value="' . $row['hash'] . '">';
                    echo '</div>';
                echo '</div>';
                echo '<div class="col">';
                    echo '<button type="submit" class="btn btn-primary">Copiar Url</button>';
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                        echo '<label for="ativo">Usuário Telecom</label>';
                        echo '<select class="form-control" id="ativo">';
                        echo '<option value="0" ' . (($row['telecom'] == "0") ? "selected" : "") . ' >Negado</option>';
                        echo '<option value="1" ' . (($row['telecom'] == "1") ? "selected" : "") . ' >Acesso</option>';
                        echo '</select>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                        echo '<label for="ativo">Alterar a Senha</label>';
                        echo '<select class="form-control" id="ativo">';
                        echo '<option value="0" ' . (($row['changepass'] == "0") ? "selected" : "") . ' >Negado</option>';
                        echo '<option value="1" ' . (($row['changepass'] == "1") ? "selected" : "") . ' >Acesso</option>';
                        echo '</select>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                        echo '<label for="ativo">Administração de OS</label>';
                        echo '<select class="form-control" id="ativo">';
                        echo '<option value="0" ' . (($row['admOS'] == "0") ? "selected" : "") . ' >Negado</option>';
                        echo '<option value="1" ' . (($row['admOS'] == "1") ? "selected" : "") . ' >Acesso</option>';
                        echo '</select>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                        echo '<label for="ativo">Administração da Planta de Links</label>';
                        echo '<select class="form-control" id="ativo">';
                        echo '<option value="0" ' . (($row['admLink'] == "0") ? "selected" : "") . ' >Negado</option>';
                        echo '<option value="1" ' . (($row['admLink'] == "1") ? "selected" : "") . ' >Acesso</option>';
                        echo '</select>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="row">';
                echo '<div class="col">';
                    echo '<div class="form-group">';
                        echo '<label for="ativo">Administração da Disponibilidade</label>';
                        echo '<select class="form-control" id="ativo">';
                        echo '<option value="0" ' . (($row['admDisp'] == "0") ? "selected" : "") . ' >Negado</option>';
                        echo '<option value="1" ' . (($row['admDisp'] == "1") ? "selected" : "") . ' >Acesso</option>';
                        echo '</select>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        echo '</div>';
        echo '<button type="submit" class="btn btn-primary">Salvar</button>&nbsp;';
        echo '<button type="submit" class="btn btn-primary">Deletar</button>';
    echo '</div>';
}

?>


</div>
</div>
 

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("activeT");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
        content.style.display = "none";
    } else {
        content.style.display = "block";
    }
  });
}
</script>

</body>
</html>
