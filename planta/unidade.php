<?php
error_reporting(E_ERROR | E_PARSE);

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['telecom'] != 1 and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}

$sql = "Select u.avatar, u.nome, u.setor, u.telefone, u.email, u.edicao, l.data from user as u left join last_login as l on u.cod = l.cod_user where u.cod = '" . $_SESSION['usuario_log'] . "';";
$stmt2 = $connect->prepare($sql);
$stmt2->execute();
$dado = $stmt2->fetch();

if(!empty($_GET['id']) and isset($_GET['id'])){
$saidaID = "SELECT un.visivel_u, un.apelido_u, un.ID, un.unidade, un.UF, un.cidade, un.endereco, un.N, un.complemento, un.bairro, un.CEP, un.endereco2, un.N2, un.complemento2, un.bairro2, un.CEP2, un.ativo AS 'unidadeativa', un.descricao_u, un.categoria FROM unidade_hapvida AS un WHERE un.ID = " . $_GET['id'] . ";";
$linksaindo = $connect->prepare($saidaID);
$linksaindo->execute();
$dadolink = $linksaindo->fetch(PDO::FETCH_OBJ);

if($dadolink->visivel_u == 0){
  header('Location: /SCL/planta/');
}

}

include("../linkgeral.php");
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- <link rel="stylesheet" href="/SCL/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" href="/SCL/css/jquery-ui.css"> -->
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
<div id="test1" style="text-align: center;">


<div id="accordion">


  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Unidade
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body  <?PHP echo ($dadolink->unidadeativa == "S") ? "" : "cordesativado"  ?>" style="text-align: initial;">
      <form id="form1serialize" action="">
      <input name="id" id="ID" type="hidden" value="<?PHP echo $dadolink->ID; ?>">

      <div class="input-field inline">
        <input style="width: 330px;" name="unidade" id="UNIDADE" type="text" value="<?PHP echo $dadolink->unidade; ?>" >
        <label for="UNIDADE">Unidade</label>
      </div>

      <div class="input-field inline">
        <input style="width: 330px;" name="apelido_u" id="APELIDO_U" type="text" value="<?PHP echo $dadolink->apelido_u; ?>" >
        <label for="APELIDO_U">Apelido</label>
      </div>
        
      <div class="input-field inline">
        <input style="width: 30px;" name="uf" id="UF" type="text" value="<?PHP echo $dadolink->UF; ?>" >
        <label style="width: 30px;" for="UF">UF</label>
      </div>

      <div class="input-field inline">
        <input name="cidade" id="CIDADE" type="text" value="<?PHP echo $dadolink->cidade; ?>" >
        <label for="CIDADE">Cidade</label>
      </div>
      <div class="input-field inline">
        <input name="id" id="ID" type="text" disabled value="<?PHP echo $dadolink->ID; ?>" >
        <label for="ID">ID Unidade</label>
      </div>
        <br>
      <div class="input-field inline">
        <input style="width: 330px;" name="endereco" id="ENDERECO" type="text" value="<?PHP echo $dadolink->endereco; ?>" >
        <label style="width: 330px;" for="ENDERECO">Endereço</label>
      </div>

      <div class="input-field inline">
        <input style="width: 100px;" name="N" id="N" type="text" value="<?PHP echo $dadolink->N; ?>" >
        <label style="width: 100px;" for="N">Número</label>
      </div>

      <div class="input-field inline">
        <input name="complemento" id="COMPLEMENTO" type="text" value="<?PHP echo $dadolink->complemento; ?>" >
        <label for="COMPLEMENTO">Complemento</label>
      </div>

      <div class="input-field inline">
        <input name="bairro" id="BAIRRO" type="text" value="<?PHP echo $dadolink->bairro; ?>" >
        <label for="BAIRRO">Bairro</label>
      </div>

      <div class="input-field inline">
        <input name="cep" id="CEP" type="text" value="<?PHP echo $dadolink->CEP; ?>" >
        <label for="CEP">CEP</label>
      </div>

      <br>
      <div class="input-field d-inline-flex">
        <input style="width: 330px;" name="endereco2" id="ENDERECO2" type="text" value="<?PHP echo $dadolink->endereco2; ?>" >
        <label style="width: 330px;" for="ENDERECO2">Endereço 2</label>
      </div>

      <div class="input-field d-inline-flex">
        <input style="width: 100px;" name="N2" id="N2" type="text" value="<?PHP echo $dadolink->N2; ?>" >
        <label style="width: 100px;" for="N2">Número 2</label>
      </div>

      <div class="input-field d-inline-flex">
        <input name="complemento2" id="COMPLEMENTO2" type="text" value="<?PHP echo $dadolink->complemento2; ?>" >
        <label for="COMPLEMENTO2">Complemento 2</label>
      </div>

      <div class="input-field d-inline-flex">
        <input name="bairro2" id="BAIRRO2" type="text" value="<?PHP echo $dadolink->bairro2; ?>" >
        <label for="BAIRRO2">Bairro 2</label>
      </div>

      <div class="input-field d-inline-flex">
        <input name="cep2" id="CEP2" type="text" value="<?PHP echo $dadolink->CEP2; ?>" >
        <label for="CEP2">CEP 2</label>
      </div>

      <div class="input-field inline">
                <select name="ativo">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->unidadeativa == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->unidadeativa == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>ATIVO?</label>
      </div>

      <div class="input-field inline">
                <select name="categoria">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="hospital" <?PHP echo ($dadolink->categoria == "hospital") ? "selected" : ""  ?> >Hospital</option>
                    <option value="vidaeimagem" <?PHP echo ($dadolink->categoria == "vidaeimagem") ? "selected" : ""  ?> >Vida & Imagem</option>
                    <option value="hapclinica" <?PHP echo ($dadolink->categoria == "hapclinica") ? "selected" : ""  ?> >Hapclínica</option>
                    <option value="prontoatendimento" <?PHP echo ($dadolink->categoria == "prontoatendimento") ? "selected" : ""  ?> >Pronto Atendimento</option>
                    <option value="centrodedistribuicao" <?PHP echo ($dadolink->categoria == "centrodedistribuicao") ? "selected" : ""  ?> >Centro de Distribuição</option>
                    <option value="medprev" <?PHP echo ($dadolink->categoria == "medprev") ? "selected" : ""  ?> >Medicina Preventiva</option>
                    <option value="laboratorio" <?PHP echo ($dadolink->categoria == "laboratorio") ? "selected" : ""  ?> >Laboratório</option>
                    <option value="administrativo" <?PHP echo ($dadolink->categoria == "administrativo") ? "selected" : ""  ?> >Administrativo</option>
                    <option value="ambulatorio" <?PHP echo ($dadolink->categoria == "ambulatorio") ? "selected" : ""  ?> >Ambulátorio</option>
                    <option value="outros" <?PHP echo ($dadolink->categoria == "outros") ? "selected" : ""  ?> >Outros</option>
                </select>
            <label>CATEGORIA</label>
      </div>
        
        <?PHP 
        
        if(!empty($_GET['id']) and isset($_GET['id'])){
            
            // $saidaID2 = "SELECT ID, CONCAT(operadora,'_',tipo) AS nomea, ativo FROM inventario.link_hapvida WHERE visivel_l = 1 and ID_unidade = " . $dadolink->ID . ";";
            $saidaID2 = "SELECT ID, CONCAT(operadora,'_',tipo) AS nomea, ativo FROM inventario.link_hapvida WHERE visivel_l = 1 and ID_unidade = " . $dadolink->ID . " UNION SELECT ID, CONCAT(operadora,'_',tipo) AS nomea, ativo FROM inventario.link_hapvida WHERE visivel_l = 1 and id_concentrador = " . $dadolink->ID . ";";
            $linksaindo2 = $connect->prepare($saidaID2);
            $linksaindo2->execute();
            $val = $linksaindo2->rowCount();
            if($val > 1){
                echo "<Label>Links Vinculados a Unidade:</Label>";
            }

            while ($linha = $linksaindo2->fetch(PDO::FETCH_ASSOC)) {
                if($linha["ID"] != $dadolink->ID){
                  
                  if ($linha["ativo"] == "S"){
                    $corativo = "";
                  }else{
                    $corativo = "red";
                  } 

                echo '<a class="waves-effect waves-light btn ' . $corativo . '" href="/SCL/planta/link.php?id=' . $linha["ID"] . '" class="button">Link ' . $linha["nomea"] . '</a>&nbsp;';
                }
            }

            }


        ?>

<div class="input-field">
                <input name="descricao_u" id="DESCRICAO_U" type="text" value="<?PHP echo $dadolink->descricao_u; ?>" >
                <label for="DESCRICAO_U">Descrição</label>
       </div>
</form>
      </div>
    </div>
  </div>



</div>
<div>
<a class="waves-effect waves-light btn" href="/SCL/planta/">Voltar</a>
<?PHP
if($_SESSION['admLink'] == 1 or $_SESSION['tipo'] == 'Admin'){
  echo '<a class="waves-effect waves-light btn" href="#" id="salvarvalores">Salvar</a>';
  echo ' <a class="waves-effect waves-light btn" href="#" id="deletarvalores">Deletar</a>';
}
?>
</div>




 
</div>
</div>

 

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/SCL/js/formToJson.js"></script>
<script src="/SCL/js/core2.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>
<script>

function replacer2(key, value) {
  if (value == "") {
    return null;
  } else if(value == "0000-00-00"){
    return undefined;
  }else{
    return value;
  }
  
}

function replacer(key, value) {
  if(value == "0000-00-00"){
    return undefined;
  }else{
    return value;
  }
  
}

$("#salvarvalores").click(function() {
// alert(JSON.stringify($("form").formToJson()));
alert("Unidade Atualizada");
$.post( "newunidade.php", { data: JSON.stringify($("form").formToJson(),replacer), modo: "atualizar" } );

});

$("#deletarvalores").click(function() {
// alert(JSON.stringify($("form").formToJson()));
var r = confirm("Deseja Deletar o Link?");
if (r==true){
  $.ajax({ 
    method: "POST", 
    url: "newunidade.php", 
    data: { 
        data: JSON.stringify($("form").formToJson(),replacer), 
        modo: "deletar" } }).done(
          function( msg ) {
            alert("Unidade Deletada");
            location.reload(false);
            return false;
          });


}

});
</script>
</body>
</html>
