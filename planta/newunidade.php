<?php
error_reporting(E_ERROR | E_PARSE);

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);


function aspas($n)
{
    return '"' . $n . '"';
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
        $query = "INSERT INTO unidade_hapvida ($keysvalor,user_u) VALUES($valorarray,$user_l)";
        $inserir = $connect->prepare($query);
        $inserir->execute();
      }elseif($_POST['modo'] == "atualizar"){
        $obj = json_decode($_POST['data'], true);
        $idunidade = $obj['id'];
        $arr = '';
        foreach ($obj as $key => $value) {
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
        
        $query = "INSERT INTO inventario.unidade_hapvida_trash (user,ID,unidade,apelido_u,UF,cidade,endereco,N,complemento,bairro,CEP,endereco2,N2,bairro2,complemento2,CEP2,ativo,categoria,visivel_u,descricao_u)
        SELECT '" . $_SESSION['usuario_log'] . "' as user,ID,unidade,apelido_u,UF,cidade,endereco,N,complemento,bairro,CEP,endereco2,N2,bairro2,complemento2,CEP2,ativo,categoria,visivel_u,descricao_u FROM inventario.unidade_hapvida WHERE ID =:idunidade;";
        $query2 = "UPDATE `inventario`.`unidade_hapvida` SET $arr WHERE `ID`=:idunidade ;";
        
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
        
        // $query = "INSERT INTO inventario.link_hapvida_trash (user,ID,ID_unidade,operadora,apelido,tipo,velocidade,circuito,propria,ativo,SDWAN,ip_link,subnetwork,firewall,ip_firewall,interface,ip_operadora,id_concentrador,data_ativação,data_cancelamento,descricao_l,visivel_l)
        // SELECT '" . $_SESSION['usuario_log'] . "' as user, ID,ID_unidade,operadora,apelido,tipo,velocidade,circuito,propria,ativo,SDWAN,ip_link,subnetwork,firewall,ip_firewall,interface,ip_operadora,id_concentrador,data_ativação,data_cancelamento,descricao_l,visivel_l FROM inventario.link_hapvida WHERE ID =:idunidade;";
        $query2 = "UPDATE `inventario`.`unidade_hapvida` SET visivel_u = 0 WHERE `ID`=:idunidade ;";
        
        // $inserir2 = $connect->prepare($query);
        $inserir = $connect->prepare($query2);
        
        // $inserir2->bindParam(':idunidade', $idunidade, PDO::PARAM_INT);
        $inserir->bindParam(':idunidade', $idunidade, PDO::PARAM_INT);
        
        // $inserir2->execute();
        $inserir->execute();
    }
}
$sql = "Select u.avatar, u.nome, u.setor, u.telefone, u.email, u.edicao, l.data, u.hash from user as u left join last_login as l on u.cod = l.cod_user where u.cod = '" . $_SESSION['usuario_log'] . "';";
$stmt2 = $connect->prepare($sql);
$stmt2->execute();
$dado = $stmt2->fetch();

if(!empty($_GET['id']) and isset($_GET['id'])){
$saidaID = "SELECT * FROM unidade_hapvida WHERE ID = " . $_GET['id'] . ";";
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
<form>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body" style="text-align: initial;">
      
      <div class="input-field d-inline-flex">
        <input style="width: 330px;" name="unidade" id="idunidade" type="text" value="<?PHP echo $dadolink->unidade; ?>" >
        <label  >Unidade</label>
      </div>

      <div class="input-field inline">
        <input style="width: 330px;" name="apelido_u" id="APELIDO_U" type="text" value="<?PHP echo $dadolink->apelido_u; ?>" >
        <label for="APELIDO_U">Apelido</label>
      </div>

      <div class="input-field d-inline-flex">
        <input style="width: 30px;" name="uf" id="iduf" type="text" value="<?PHP echo $dadolink->UF; ?>" >
        <label style="width: 30px;"  >UF</label>
      </div>

      <div class="input-field d-inline-flex">
        <input name="cidade" id="idcidade" type="text" value="<?PHP echo $dadolink->cidade; ?>" >
        <label  >Cidade</label>
      </div>
        <br>
      <div class="input-field d-inline-flex">
        <input style="width: 330px;" name="endereco" id="idendereco" type="text" value="<?PHP echo $dadolink->endereco; ?>" >
        <label style="width: 330px;"  >Endereço</label>
      </div>

      <div class="input-field d-inline-flex">
        <input style="width: 100px;" name="n" id="idn" type="text" value="<?PHP echo $dadolink->N; ?>" >
        <label style="width: 100px;"  >Número</label>
      </div>

      <div class="input-field d-inline-flex">
        <input name="complemento" id="idcomplemento" type="text" value="<?PHP echo $dadolink->complemento; ?>" >
        <label  >Complemento</label>
      </div>

      <div class="input-field d-inline-flex">
        <input name="bairro" id="idbairro" type="text" value="<?PHP echo $dadolink->bairro; ?>" >
        <label  >Bairro</label>
      </div>

      <div class="input-field d-inline-flex">
        <input name="cep" id="idcep" type="text" value="<?PHP echo $dadolink->CEP; ?>" >
        <label  >CEP</label>
      </div>

      <br>
      <div class="input-field inline">
        <input style="width: 330px;" name="endereco2" id="ENDERECO2" type="text" value="<?PHP echo $dadolink->endereco2; ?>" >
        <label style="width: 330px;" for="ENDERECO2">Endereço 2</label>
      </div>

      <div class="input-field inline">
        <input style="width: 100px;" name="N2" id="N2" type="text" value="<?PHP echo $dadolink->endereco2; ?>" >
        <label style="width: 100px;" for="N2">Número 2</label>
      </div>

      <div class="input-field inline">
        <input name="complemento2" id="COMPLEMENTO2" type="text" value="<?PHP echo $dadolink->endereco2; ?>" >
        <label for="COMPLEMENTO2">Complemento 2</label>
      </div>

      <div class="input-field inline">
        <input name="bairro2" id="BAIRRO2" type="text" value="<?PHP echo $dadolink->endereco2; ?>" >
        <label for="BAIRRO2">Bairro 2</label>
      </div>

      <div class="input-field inline">
        <input name="cep2" id="CEP2" type="text" value="<?PHP echo $dadolink->endereco2; ?>" >
        <label for="CEP2">CEP 2</label>
      </div>

      <div class="input-field d-inline-flex">
                <select name="ativo" id="idativo">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->ativo == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->ativo == "N") ? "selected" : ""  ?> >NÃO</option>
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
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/core2.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/geral.js"></script>
<script>

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

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
alert("Unidade Criada");
$.post( "newunidade.php", { data: JSON.stringify($("form").formToJson(),replacer), modo: "inserir" } );
$(':input').val("");

});

</script>
</body>
</html>
