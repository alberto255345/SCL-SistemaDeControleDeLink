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

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body" style="text-align: initial;">
      
      <div class="input-field inline">
        <input style="width: 330px;" name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->unidade; ?>" >
        <label for="CHAMADOOTRS">Unidade</label>
      </div>
        
      <div class="input-field inline">
        <input style="width: 30px;" name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->UF; ?>" >
        <label style="width: 30px;" for="CHAMADOOTRS">UF</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->cidade; ?>" >
        <label for="CHAMADOOTRS">Cidade</label>
      </div>
      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" disabled value="<?PHP echo $dadolink->ID; ?>" >
        <label for="CHAMADOOTRS">ID Link</label>
      </div>
        <br>
      <div class="input-field inline">
        <input style="width: 330px;" name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->endereco; ?>" >
        <label style="width: 330px;" for="CHAMADOOTRS">Endereço</label>
      </div>

      <div class="input-field inline">
        <input style="width: 100px;" name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->N; ?>" >
        <label style="width: 100px;" for="CHAMADOOTRS">Número</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->complemento; ?>" >
        <label for="CHAMADOOTRS">Complemento</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->bairro; ?>" >
        <label for="CHAMADOOTRS">Bairro</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->CEP; ?>" >
        <label for="CHAMADOOTRS">CEP</label>
      </div>

      <div class="input-field inline">
                <select name="unidadepropria">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->unidadeativa == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->unidadeativa == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>ATIVO?</label>
      </div>
        
        <?PHP 
        
        if(!empty($_GET['id']) and isset($_GET['id'])){
            
            $saidaID2 = "SELECT ID, CONCAT(operadora,'_',tipo) AS nomea FROM inventario.link_hapvida WHERE ID_unidade = " . $dadolink->ID_unidade . ";";
            $linksaindo2 = $connect->prepare($saidaID2);
            $linksaindo2->execute();
            $val = $linksaindo2->rowCount();
            if($val > 1){
                echo "<Label>Links Vinculados a Unidade:</Label>";
            }

            while ($linha = $linksaindo2->fetch(PDO::FETCH_ASSOC)) {
                if($linha["ID"] != $dadolink->ID){
                echo '<a class="waves-effect waves-light btn" href="/SCL/planta/link.php?id=' . $linha["ID"] . '" class="button">Link ' . $linha["nomea"] . '</a>&nbsp;';
                }
            }

            }


        ?>

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
      <div class="card-body" style="text-align: initial;">
        
      <form id="form1serialize" action="">
      <div class="input-field inline">
                <input name="operadora" id="OPERADORA" type="text" value="<?PHP echo $dadolink->operadora; ?>" >
                <label for="OPERADORA">OPERADORA</label>
        </div>
    
        <div class="input-field inline">
                <select name="servico" >
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
                <select name="redepropria">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->propria == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->propria == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>REDE PROPRIA?</label>
      </div>


      <div class="input-field inline">
                <select name="redeativa">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="S" <?PHP echo ($dadolink->ativo == "S") ? "selected" : ""  ?> >SIM</option>
                    <option value="N" <?PHP echo ($dadolink->ativo == "N") ? "selected" : ""  ?> >NÃO</option>
                </select>
            <label>ATIVO?</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->ip_link; ?>" >
        <label for="CHAMADOOTRS">IP LINK</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->firewall; ?>" >
        <label for="CHAMADOOTRS">FIREWALL</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->ip_firewall; ?>" >
        <label for="CHAMADOOTRS">IP FIREWALL</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->interface; ?>" >
        <label for="CHAMADOOTRS">INTERFACE</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->ip_operadora; ?>" >
        <label for="CHAMADOOTRS">IP OPERADORA</label>
      </div>

      <div class="input-field inline">
        <input name="chamadootrs" id="CHAMADOOTRS" type="text" value="<?PHP echo $dadolink->id_concentrador; ?>" >
        <label for="CHAMADOOTRS">ID CONCENTRADOR</label>
      </div>

      <div class="input-field inline">
                <input name="dataativacao" id="DATAATIVACAO" type="DATE" value="<?PHP echo $dadolink->data_ativação; ?>" >
                <label for="DATAATIVACAO">DATA DA ATIVAÇÃO</label>
       </div>
       </form>
       <?PHP 
        
        if(!empty($_GET['id']) and isset($_GET['id'])){
            
            $saidaID2 = "SELECT sc.hostid FROM inventario.link_hapvida AS li LEFT JOIN inventario.linkzabbix_scl AS sc ON li.ID = sc.ID WHERE sc.hostid IS NOT NULL AND li.ID = " . $_GET['id'] . ";";
            $linksaindo2 = $connect->prepare($saidaID2);
            $linksaindo2->execute();
            $val = $linksaindo2->rowCount();
                if($val >= 1){

                    while ($linha = $linksaindo2->fetch(PDO::FETCH_ASSOC)) {
                        echo '<a class="waves-effect waves-light btn" href="/zabbix/zabbix.php?action=latest.view&filter_hostids%5B%5D=' . $linha["hostid"] . '&filter_set=1" class="button">Link Zabbix ' . $linha["hostid"] . '</a>&nbsp;';
                    }

                }
        }


        ?>
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
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/core2.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<!-- <script src="/SCL/js/jquery-ui.js"></script> -->
</body>
</html>
