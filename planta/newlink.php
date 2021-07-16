<?php
error_reporting(E_ERROR | E_PARSE);

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);


function aspas($n)
{
    return '"' . $n . '"';
}

function fundir($a,$b){
  echo $a . ' = ' . $b . '<br>';
  return $a . ' = ' . $b;
}

if($_SESSION['admLink'] != 1 and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}
if($_SESSION['admLink'] == 1 or $_SESSION['tipo'] == 'Admin'){
  if($_POST['modo'] == "inserir"){
      $obj = json_decode($_POST['data'], true);
      $keysvalor = implode(',', array_keys($obj));
      $valorarray = implode(',', array_map('aspas',$obj));
      $user_l = "'" . $_SESSION['usuario_log'] . "'";
      $query = "INSERT INTO link_hapvida ($keysvalor,user_l) VALUES($valorarray,$user_l)";
      $inserir = $connect->prepare($query);
      $inserir->execute();
  }elseif($_POST['modo'] == "atualizar"){
      $obj = json_decode($_POST['data'], true);
      $idunidade = $obj['id'];
      // $keysvalor = implode(',', array_keys($obj));
      // $valorarray = implode(',', array_map('aspas',$obj));
      $arr = '';
      foreach ($obj as $key => $value) {
        // $arr[3] será atualizado com cada valor de $arr...
        if($key != 'host'){
          
          if ($arr == '') {
            if (empty($value)) {
              $arr = $key . ' = NULL';
            }else{
              $arr = $key . ' = "' . $value . '"';
            }
          }else {
            if (empty($value)) {
              $arr = $arr . ' , ' . $key . ' = NULL';
            }else{
              $arr = $arr . ' , ' . $key . ' = "' . $value . '"';
            }
          }
        }
      }
      
      // echo 'saida:' . $arr;
      
      $query = "INSERT INTO inventario.link_hapvida_trash (user,ID,ID_unidade,operadora,apelido,tipo,velocidade,circuito,propria,ativo,SDWAN,ip_link,subnetwork,firewall,ip_firewall,interface,ip_operadora,id_concentrador,data_ativação,data_cancelamento,descricao_l,visivel_l)
      SELECT '" . $_SESSION['usuario_log'] . "' as user, ID,ID_unidade,operadora,apelido,tipo,velocidade,circuito,propria,ativo,SDWAN,ip_link,subnetwork,firewall,ip_firewall,interface,ip_operadora,id_concentrador,data_ativação,data_cancelamento,descricao_l,visivel_l FROM inventario.link_hapvida WHERE ID =:idunidade;";
      $query2 = "UPDATE `inventario`.`link_hapvida` SET $arr WHERE `ID`=:idunidade ;";
      
      $inserir2 = $connect->prepare($query);
      $inserir = $connect->prepare($query2);
      
      $inserir2->bindParam(':idunidade', $idunidade, PDO::PARAM_INT);
      $inserir->bindParam(':idunidade', $idunidade, PDO::PARAM_INT);
      
      $inserir2->execute();
      $inserir->execute();
  }elseif($_POST['modo'] == "deletar"){
      $obj = json_decode($_POST['data'], true);
      $idunidade = $obj['id'];
      $arr = '';
      
      $query = "INSERT INTO inventario.link_hapvida_trash (user,ID,ID_unidade,operadora,apelido,tipo,velocidade,circuito,propria,ativo,SDWAN,ip_link,subnetwork,firewall,ip_firewall,interface,ip_operadora,id_concentrador,data_ativação,data_cancelamento,descricao_l,visivel_l)
      SELECT '" . $_SESSION['usuario_log'] . "' as user, ID,ID_unidade,operadora,apelido,tipo,velocidade,circuito,propria,ativo,SDWAN,ip_link,subnetwork,firewall,ip_firewall,interface,ip_operadora,id_concentrador,data_ativação,data_cancelamento,descricao_l,visivel_l FROM inventario.link_hapvida WHERE ID =:idunidade;";
      $query2 = "UPDATE `inventario`.`link_hapvida` SET visivel_l = 0 WHERE `ID`=:idunidade ;";
      
      $inserir2 = $connect->prepare($query);
      $inserir = $connect->prepare($query2);
      
      $inserir2->bindParam(':idunidade', $idunidade, PDO::PARAM_INT);
      $inserir->bindParam(':idunidade', $idunidade, PDO::PARAM_INT);
      
      $inserir2->execute();
      $inserir->execute();
  }


}
$sql = "Select u.avatar, u.nome, u.setor, u.telefone, u.email, u.edicao, l.data, u.hash from user as u left join last_login as l on u.cod = l.cod_user where u.cod = '" . $_SESSION['usuario_log'] . "';";
$stmt2 = $connect->prepare($sql);
$stmt2->execute();
$dado = $stmt2->fetch();

if(!empty($_GET['id']) and isset($_GET['id'])){
$saidaID = "SELECT li.*, un.unidade, un.UF, un.cidade, un.endereco, un.N, un.complemento, un.bairro, un.CEP, un.ativo AS 'unidadeativa', un.categoria FROM link_hapvida AS li LEFT JOIN unidade_hapvida AS un ON li.ID_unidade = un.ID WHERE li.ID = " . $_GET['id'] . ";";
$linksaindo = $connect->prepare($saidaID);
$linksaindo->execute();
$dadolink = $linksaindo->fetch(PDO::FETCH_OBJ);
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
<div style="text-align: center;">


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
      <div class="card-body " style="text-align: initial;">

    <select name="ID_unidade" id="ID_unidade2">
<?PHP
    $unidades = "SELECT ID, unidade FROM unidade_hapvida WHERE ativo = 'S' AND visivel_u = 1 ORDER BY id DESC";
    foreach ($connect->query($unidades) as $row) {
        echo '<option ' . (($dadolink->ID_unidade == $row['ID']) ? "selected" : "") . ' value="' . $row['ID'] . '">' . $row['unidade'] . '</option>';
    }
?>
</select>
    </div>
    </div>
  </div>

<div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Link 
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body " style="text-align: initial;">
        
      <form id="form1serialize" action="">
      <input type="hidden" name="ID_unidade" id="ID_unidade" value="<?PHP echo $dadolink->ID_unidade; ?>">
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
    <a class="waves-effect waves-light btn" href="#" id="salvarvalores">Salvar</a>
</div>

 
</div>
</div>

 

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/SCL/js/formToJson.js"></script>
<script src="/SCL/js/core2.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/geral.js"></script>
<script>

$("#ID_unidade2").on('change', function() {
  $("#ID_unidade").val($("#ID_unidade2").val()); 
});
$(document).ready(function(){
  $("#ID_unidade").val($("#ID_unidade2").val());
});

function replacer(key, value) {
  if (value == "") {
    return undefined;
  } else if(value == "0000-00-00"){
    return undefined;
  }else{
    return value;
  }
  
}

$("#salvarvalores").click(function() {
// alert(JSON.stringify($("form").formToJson()));
alert("Link Criado");
$.post( "newlink.php", { data: JSON.stringify($("form").formToJson(),replacer), modo: "inserir" } );
$(':input').val("");

});

</script>
</body>
</html>
