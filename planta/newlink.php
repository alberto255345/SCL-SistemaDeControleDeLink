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
        $query = "INSERT INTO unidade_hapvida ($keysvalor) VALUES($valorarray)";
        $inserir = $connect->prepare($query);
        $inserir->execute();
    }
}
$sql = "Select u.avatar, u.nome, u.setor, u.telefone, u.email, u.edicao, l.data, u.hash from user as u left join last_login as l on u.cod = l.cod_user where u.cod = '" . $_SESSION['usuario_log'] . "';";
$stmt2 = $connect->prepare($sql);
$stmt2->execute();
$dado = $stmt2->fetch();

if(!empty($_GET['id']) and isset($_GET['id'])){
$saidaID = "SELECT li.*, un.unidade, un.UF, un.cidade, un.endereco, un.N, un.complemento, un.bairro, un.CEP, un.ativo AS 'unidadeativa' FROM link_hapvida AS li LEFT JOIN unidade_hapvida AS un ON li.ID_unidade = un.ID WHERE li.ID = " . $_GET['id'] . ";";
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

      <div class="input-field d-inline-flex">
                <select name="ativo" id="idativo">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->unidadeativa == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->unidadeativa == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>ATIVO?</label>
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

$("#salvarvalores").click(function() {
// alert(JSON.stringify($("form").formToJson()));
alert("Unidade Criada");
$.post( "newunidade.php", { data: JSON.stringify($("form").formToJson()), modo: "inserir" } );
$(':input').val("");

});

</script>
</body>
</html>
