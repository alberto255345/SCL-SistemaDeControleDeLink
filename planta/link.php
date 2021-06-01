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
$saidaID = "SELECT li.*, un.apelido_u, un.unidade, un.UF, un.cidade, un.endereco, un.N, un.complemento, un.bairro, un.CEP, un.endereco2, un.N2, un.complemento2, un.bairro2, un.CEP2, un.ativo AS 'unidadeativa', un.descricao_u FROM link_hapvida AS li LEFT JOIN unidade_hapvida AS un ON li.ID_unidade = un.ID WHERE li.ID = " . $_GET['id'] . ";";
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
        <label for="ID">ID Link</label>
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


      <?PHP
      if($dadolink->endereco2 <> null){
      echo '<br>
      <div class="input-field inline">
        <input style="width: 330px;" name="endereco" id="ENDERECO2" type="text" value="' . $dadolink->endereco2 . '" >
        <label style="width: 330px;" for="ENDERECO2">Endereço 2</label>
      </div>

      <div class="input-field inline">
        <input style="width: 100px;" name="N2" id="N2" type="text" value="' . $dadolink->N2 . '" >
        <label style="width: 100px;" for="N2">Número 2</label>
      </div>

      <div class="input-field inline">
        <input name="complemento2" id="COMPLEMENTO2" type="text" value="' . $dadolink->complemento2 . '" >
        <label for="COMPLEMENTO2">Complemento 2</label>
      </div>

      <div class="input-field inline">
        <input name="bairro2" id="BAIRRO2" type="text" value="' . $dadolink->bairro2 . '" >
        <label for="BAIRRO2">Bairro 2</label>
      </div>

      <div class="input-field inline">
        <input name="cep2" id="CEP2" type="text" value="' . $dadolink->CEP2 . '" >
        <label for="CEP2">CEP 2</label>
      </div>';
      }
      ?>

      <div class="input-field inline">
                <select name="unidadeativa">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->unidadeativa == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->unidadeativa == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>ATIVO?</label>
      </div>
        
        <?PHP 
        
        if(!empty($_GET['id']) and isset($_GET['id'])){
            
            $saidaID2 = "SELECT ID, CONCAT(operadora,'_',tipo) AS nomea, ativo FROM inventario.link_hapvida WHERE ID_unidade = " . $dadolink->ID_unidade . ";";
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
        <input name="ip_link" id="IP_LINK" type="text" value="<?PHP echo $dadolink->ip_link; ?>" >
        <label for="IP_LINK">IP LINK</label>
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
                <input name="dataativacao" id="DATAATIVACAO" type="DATE" value="<?PHP echo $dadolink->data_ativação; ?>" >
                <label for="DATAATIVACAO">DATA DA ATIVAÇÃO</label>
       </div>

       <div class="input-field inline">
                <input name="datacancela" id="DATACANCELA" type="DATE" value="<?PHP echo $dadolink->data_cancelamento; ?>" >
                <label for="DATACANCELA">DATA DE CANCELAMENTO</label>
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
                        echo '<div class="input-field inline"><input class="hosttamanho" name="host" id="HOST" type="text" value="' .  $linha["nome"] . '" ><label for="HOST">HOST</label></div>';
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
<script src="/SCL/js/core2.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>
<!-- <script src="/SCL/js/jquery-ui.js"></script> -->
</body>
</html>
