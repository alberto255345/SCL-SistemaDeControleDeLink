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

if(!empty($_GET['id']) and isset($_GET['id'])){
$saidaID = "SELECT li.*, un.categoria, un.apelido_u, un.unidade, un.UF, un.cidade, un.endereco, un.N, un.complemento, un.bairro, un.CEP, un.endereco2, un.N2, un.complemento2, un.bairro2, un.CEP2, un.ativo AS 'unidadeativa', un.descricao_u FROM link_hapvida AS li LEFT JOIN unidade_hapvida AS un ON li.ID_unidade = un.ID WHERE li.ID = " . $_GET['id'] . ";";
$linksaindo = $connect->prepare($saidaID);
$linksaindo->execute();
$dadolink = $linksaindo->fetch(PDO::FETCH_OBJ);

if($dadolink->visivel_l == 0){
  header('Location: /SCL/planta/unidade.php?id=' . $dadolink->ID_unidade);
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
<div id="test1" style="text-align: center; height: 43vh;">


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
      
      <div class="input-field inline">
        <input disabled style="width: 330px;" name="unidade" id="UNIDADE" type="text" value="<?PHP echo $dadolink->unidade; ?>" >
        <label for="UNIDADE">Unidade</label>
      </div>
      
      <div class="input-field inline">
        <input disabled style="width: 330px;" name="apelido_u" id="APELIDO_U" type="text" value="<?PHP echo $dadolink->apelido_u; ?>" >
        <label for="APELIDO_U">Apelido</label>
      </div>

      <div class="input-field inline">
        <input disabled style="width: 30px;" name="uf" id="UF" type="text" value="<?PHP echo $dadolink->UF; ?>" >
        <label style="width: 30px;" for="UF">UF</label>
      </div>

      <div class="input-field inline">
        <input disabled name="cidade" id="CIDADE" type="text" value="<?PHP echo $dadolink->cidade; ?>" >
        <label for="CIDADE">Cidade</label>
      </div>
      <div class="input-field inline">
        <input name="id2" id="ID2" type="text" disabled value="<?PHP echo $dadolink->ID; ?>" >
        <label for="ID">ID Link</label>
      </div>
        <br>
      <div class="input-field inline">
        <input disabled style="width: 330px;" name="endereco" id="ENDERECO" type="text" value="<?PHP echo $dadolink->endereco; ?>" >
        <label style="width: 330px;" for="ENDERECO">Endereço</label>
      </div>

      <div class="input-field inline">
        <input disabled style="width: 100px;" name="N" id="N" type="text" value="<?PHP echo $dadolink->N; ?>" >
        <label style="width: 100px;" for="N">Número</label>
      </div>

      <div class="input-field inline">
        <input disabled name="complemento" id="COMPLEMENTO" type="text" value="<?PHP echo $dadolink->complemento; ?>" >
        <label for="COMPLEMENTO">Complemento</label>
      </div>

      <div class="input-field inline">
        <input disabled name="bairro" id="BAIRRO" type="text" value="<?PHP echo $dadolink->bairro; ?>" >
        <label for="BAIRRO">Bairro</label>
      </div>

      <div class="input-field inline">
        <input disabled name="cep" id="CEP" type="text" value="<?PHP echo $dadolink->CEP; ?>" >
        <label for="CEP">CEP</label>
      </div>


      <?PHP
      if($dadolink->endereco2 <> null){
      echo '<br>
      <div class="input-field inline">
        <input disabled style="width: 330px;" name="endereco" id="ENDERECO2" type="text" value="' . $dadolink->endereco2 . '" >
        <label style="width: 330px;" for="ENDERECO2">Endereço 2</label>
      </div>

      <div class="input-field inline">
        <input disabled style="width: 100px;" name="N2" id="N2" type="text" value="' . $dadolink->N2 . '" >
        <label style="width: 100px;" for="N2">Número 2</label>
      </div>

      <div class="input-field inline">
        <input disabled name="complemento2" id="COMPLEMENTO2" type="text" value="' . $dadolink->complemento2 . '" >
        <label for="COMPLEMENTO2">Complemento 2</label>
      </div>

      <div class="input-field inline">
        <input disabled name="bairro2" id="BAIRRO2" type="text" value="' . $dadolink->bairro2 . '" >
        <label for="BAIRRO2">Bairro 2</label>
      </div>

      <div class="input-field inline">
        <input disabled name="cep2" id="CEP2" type="text" value="' . $dadolink->CEP2 . '" >
        <label for="CEP2">CEP 2</label>
      </div>';
      }
      ?>

      <div class="input-field inline">
                <select disabled name="unidadeativa">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->unidadeativa == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->unidadeativa == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>ATIVO?</label>
      </div>

      <div class="input-field inline">
                <select disabled name="categoria">
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
            
          $saidaID2 = "SELECT ID, CONCAT(operadora,'_',tipo) AS nomea, ativo FROM inventario.link_hapvida WHERE visivel_l = 1 and ID_unidade = " . $dadolink->ID_unidade . " UNION SELECT ID, CONCAT(operadora,'_',tipo,' Ponta B ') AS nomea, ativo FROM inventario.link_hapvida WHERE visivel_l = 1 and id_concentrador = " . $dadolink->ID_unidade . ";";
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
                <div class="select-wrapper disabled descri"><?PHP echo $dadolink->descricao_u; ?></div>
                <label for="DESCRICAO_U">Descrição</label>
       </div>

      </div>
    </div>
  </div>


  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Link <?PHP echo $dadolink->operadora . '_' . $dadolink->tipo;  ?>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body  <?PHP echo ($dadolink->ativo == "S") ? "" : "cordesativado"  ?>" style="text-align: initial;">
        
      <form id="form1serialize" action="">
      
      <input name="id" id="ID" type="hidden" value="<?PHP echo $dadolink->ID; ?>">

      <div class="input-field inline">
                <input name="operadora" id="OPERADORA" type="text" value="<?PHP echo $dadolink->operadora; ?>" >
                <label for="OPERADORA">OPERADORA</label>
        </div>

        <div class="input-field inline">
                <input name="apelido" id="APELIDO" type="text" value="<?PHP echo $dadolink->apelido; ?>" >
                <label for="APELIDO">APELIDO</label>
        </div>
    
        <div class="input-field inline">
                <select name="tipo" >
                <option value="" disabled selected>Escolha a opção</option>
                <option value="Mpls" <?PHP echo ($dadolink->tipo == "Mpls") ? "selected" : ""  ?> >MPLS</option>
                <option value="Fibra" <?PHP echo ($dadolink->tipo == "Fibra") ? "selected" : ""  ?> >FIBRA</option>
                <option value="Radio" <?PHP echo ($dadolink->tipo == "Radio") ? "selected" : ""  ?> >RÁDIO</option>
                <option value="Internet" <?PHP echo ($dadolink->tipo == "Internet") ? "selected" : ""  ?> >INTERNET</option>
                </select>
                <label>SERVIÇO</label>
            </div>

      <div class="input-field inline">
                <input name="velocidade" class="meucampo" id="VELOCIDADE" type="number" value="<?PHP echo $dadolink->velocidade; ?>" >
                <label for="VELOCIDADE">VELOCIDADE(MB)</label>
        </div>
        
        <div class="input-field inline">
                <input name="circuito" id="CIRCUITO" type="text" value="<?PHP echo $dadolink->circuito; ?>" >
                <label for="CIRCUITO">CIRCUITO</label>
        </div>

      <div class="input-field inline">
                <select name="propria">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->propria == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->propria == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>REDE PROPRIA?</label>
      </div>


      <div class="input-field inline">
                <select name="ativo">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->ativo == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->ativo == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>ATIVO?</label>
      </div>

      <div class="input-field inline">
                <select name="SDWAN">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->SDWAN == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->SDWAN == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>SDWAN?</label>
      </div>

      <div class="input-field inline">
        <input name="ip_link" id="IP_LINK" type="text" value="<?PHP echo $dadolink->ip_link; ?>" >
        <label for="IP_LINK">IP LINK</label>
      </div>

      <div class="input-field inline">
        <input name="subnetwork" id="subnetwork" type="text" value="<?PHP echo $dadolink->subnetwork; ?>" >
        <label for="subnetwork">Máscara</label>
      </div>

      <div class="input-field inline">
        <input name="firewall" id="FIREWALL" type="text" value="<?PHP echo $dadolink->firewall; ?>" >
        <label for="FIREWALL">FIREWALL</label>
      </div>

      <div class="input-field inline">
        <input name="ip_firewall" id="IP_FIREWALL" type="text" value="<?PHP echo $dadolink->ip_firewall; ?>" >
        <label for="IP_FIREWALL">IP FIREWALL</label>
      </div>

      <div class="input-field inline">
        <input name="interface" id="INTERFACE" type="text" value="<?PHP echo $dadolink->interface; ?>" >
        <label for="INTERFACE">INTERFACE</label>
      </div>

      <div class="input-field inline">
        <input name="ip_operadora" id="IP_OPERADORA" type="text" value="<?PHP echo $dadolink->ip_operadora; ?>" >
        <label for="IP_OPERADORA">IP OPERADORA</label>
      </div>

      <div class="input-field inline">
        <input name="id_concentrador" id="ID_CONCENTRADOR" type="text" value="<?PHP echo $dadolink->id_concentrador; ?>" >
        <label for="ID_CONCENTRADOR">ID CONCENTRADOR</label>
      </div>

      <div class="input-field inline">
                <input name="data_ativação" id="DATA_ATIVAÇÃO" type="DATE" value="<?PHP echo $dadolink->data_ativação; ?>" >
                <label for="DATA_ATIVAÇÃO">DATA DA ATIVAÇÃO</label>
       </div>

       <div class="input-field inline">
                <input name="data_cancelamento" id="DATA_CANCELAMENTO" type="DATE" value="<?PHP echo $dadolink->data_cancelamento; ?>" >
                <label for="DATA_CANCELAMENTO">DATA DE CANCELAMENTO</label>
       </div>

       <?PHP 
        
        if(!empty($_GET['id']) and isset($_GET['id'])){
            
            $saidaID2 = "SELECT sc.hostid, sc.nome FROM inventario.link_hapvida AS li LEFT JOIN inventario.linkzabbix_scl AS sc ON li.ID = sc.ID WHERE sc.hostid IS NOT NULL AND li.ID = " . $_GET['id'] . ";";
            $linksaindo2 = $connect->prepare($saidaID2);
            $linksaindo2->execute();
            $val = $linksaindo2->rowCount();
                if($val >= 1){

                    while ($linha = $linksaindo2->fetch(PDO::FETCH_ASSOC)) {
                        echo '<a class="waves-effect waves-light btn" href="/zabbix/zabbix.php?action=latest.view&filter_hostids%5B%5D=' . $linha["hostid"] . '&filter_set=1" class="button">Link Zabbix ' . $linha["hostid"] . '</a>&nbsp;';
                        echo '<div class="input-field inline"><input disabled class="hosttamanho" name="host" id="HOST" type="text" value="' .  $linha["nome"] . '" ><label for="HOST">HOST</label></div>';
                    }

                }
        }


        ?>

       <div class="input-field">
                <input name="descricao_l" id="DESCRICAO_L" type="text" value="<?PHP echo $dadolink->descricao_l; ?>" >
                <label for="DESCRICAO_L">Descrição</label>
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
  echo '<a class="waves-effect waves-light btn" href="#" id="salvarvalores">Salvar</a>&nbsp;';
  echo '<a class="waves-effect waves-light btn" href="/SCL/planta/unidade.php?id=' . $dadolink->ID_unidade . '" id="editarunidade">Editar Unidade</a>';
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
alert("Link Atualizado");
$.post( "newlink.php", { data: JSON.stringify($("form").formToJson(),replacer), modo: "atualizar" } );

});

$("#deletarvalores").click(function() {
// alert(JSON.stringify($("form").formToJson()));
var r = confirm("Deseja Deletar o Link?");
if (r==true){
  $.ajax({ 
    method: "POST", 
    url: "newlink.php", 
    data: { 
        data: JSON.stringify($("form").formToJson(),replacer), 
        modo: "deletar" } }).done(
          function( msg ) {
            alert("Link Deletado");
            location.reload(false);
            return false;
          });


}

});


</script>
</body>
</html>
