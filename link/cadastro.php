<?php
error_reporting(E_ERROR | E_PARSE);

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['telecom'] != 1 and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}

if($_SESSION['admOS'] != '1' and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}

$sql = "Select u.avatar, u.nome, u.setor, u.telefone, u.email, u.edicao, l.data, u.hash from user as u left join last_login as l on u.cod = l.cod_user where u.cod = '" . $_SESSION['usuario_log'] . "';";
$stmt2 = $connect->prepare($sql);
$stmt2->execute();
$dado = $stmt2->fetch();

include("../linkgeral.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>
<body>
<div>
    <div class="pamens"></div>
    <div class="pamens2"></div>
</div>
<div style="display: inline-flex; height: 100%;">
<?PHP 
include("../menu/menu.php");
?>
<div id="separa" style="align-items: center; margin: 5px; border-radius: 5px;">
<div style="text-align: center;">
<h4>Cadastro de OS</h4>
<form id="form1">
    <table>
    <tbody>
        <tr>
        <td colspan="4">
        <div class="input-field inline" style="width: 98%;">
            <input name="email" id="localizador" type="text"  >
            <label for="localizador" class="">Localizador E-mail</label>
        </div>
        </td>
        </tr>
    </tbody>
    </table>
</form>
<form id="form2">
    <table>
    <tbody>
        <tr>
        <td>
        <div class="input-field inline">
            <input name="UF" id="FILIAL" type="text"  >
            <label for="FILIAL">FILIAL</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
            <input name="cidade" id="MUNICIPIO" type="text"  >
            <label for="MUNICIPIO">MUNICIPIO</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
            <input name="unidade" id="Unidade" type="text"  >
            <label for="Unidade">UNIDADE</label>
        </div>
        </td>
        </tr>
    </tbody>
    </table>
    <table>
    <tbody>
        <tr>
        <td>
        <div class="input-field inline">
            <input name="endereco" id="RUA" type="text"  >
            <label for="RUA">RUA</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
            <input name="N" style="width: 50px;" id="NS" type="text"  >
            <label for="NS">Nº</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
            <input name="bairro" id="BAIRRO" type="text"  >
            <label for="BAIRRO">BAIRRO</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="complemento" id="COMPLEMENTO" type="text"  >
                <label for="COMPLEMENTO">COMPLEMENTO</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="CEP" id="CEP" type="number" >
                <label for="CEP">CEP</label>
        </div>
        </td>
        </tr>
    </tbody>
    </table>
</form>
<form id="form3">
    <table>
    <tbody>
        <tr>
        <td>
            <div class="input-field col s12">
                <select name="servico" >
                <option value="" disabled selected>Escolha a opção</option>
                <option value="1">MPLS</option>
                <option value="2">FIBRA</option>
                <option value="3">RÁDIO</option>
                <option value="4">INTERNET</option>
                </select>
                <label>SERVIÇO</label>
            </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="operadora" id="OPERADORA" type="text"  >
                <label for="OPERADORA">OPERADORA</label>
        </div>
        </td>
        <td>
            <div class="input-field col s12">
                <select name="tipo" >
                <option value="" disabled selected>Escolha a opção</option>
                <option value="1">INSTALAÇÃO</option>
                <option value="2">CANCELAMENTO</option>
                <option value="3">MUDEND</option>
                <option value="4">UPGRADE</option>
                </select>
                <label>TIPO</label>
            </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="velocidade" class="meucampo" id="VELOCIDADE" type="number"  >
                <label for="VELOCIDADE">VELOCIDADE(MB)</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="circuito" id="CIRCUITO" type="text"  >
                <label for="CIRCUITO">CIRCUITO</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="dataativacao" id="DATAATIVACAO" type="DATE"  >
                <label for="DATAATIVACAO">DATA DA ATIVAÇÃO</label>
        </div>
        </td>
        <td>
            <div class="input-field col s12">
                <select name="redepropria">
                <option value="" disabled selected>Escolha a opção</option>
                <option value="S">SIM</option>
                <option value="N">NÃO</option>
                </select>
                <label>REDE PROPRIA?</label>
            </div>
        </td>
        </tr>
    </tbody>
    </table>

        <table>
        <tbody>
        <tr>
        <td>
        <div class="input-field inline">
                <input name="acionamentoadm" id="ACIONAMENTOADM" type="date"  >
                <label for="ACIONAMENTOADM">ACIONAMENTO ADM</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="requisicao" id="REQUISICAO" type="text"  >
                <label for="REQUISICAO">REQUISIÇÃO</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="retornoadm" id="RETORNOADM" type="date"  >
                <label for="RETORNOADM">RETORNO ADM</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="acionamentosupply" id="ACIONAMENTOSUPPLY" type="date"  >
                <label for="ACIONAMENTOSUPPLY">ACIONAMENTO SUPPLY</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="retornosupply" id="RETORNOSUPPLY" type="date"  >
                <label for="RETORNOSUPPLY">RETORNO SUPPLY</label>
        </div>
        </td>
        <td>
        <div class="input-field inline">
                <input name="pedido" id="PEDIDO" type="text"  >
                <label for="PEDIDO">PEDIDO</label>
        </div>
        </td>
        </tr>
    </tbody>
    </table>

    <table>
    <tbody>
        <tr>
            <td>
                <div class="input-field col s12">
                    <select name="area">
                    <option value="" disabled selected>Escolha a opção</option>
                    <option value="1">ADM</option>
                    <option value="2">TELECOM</option>
                    <option value="3">SUPPLY</option>
                    <option value="4">OPERADORA</option>
                    <option value="5">PENDÊNCIA TI</option>
                    <option value="6">PENDÊNCIA MANUTENÇÃO</option>
                    <option value="7">PENDÊNCIA OPERADORA</option>
                    <option value="8">PENDÊNCIA ORÇAMENTO</option>
                    <option value="9">PENDÊNCIA HAPVIDA</option>
                    </select>
                    <label>ÁREA</label>
                </div>
            </td>
            <td>
                <div class="input-field inline">
                    <input name="previsaodaarea" id="PREVISAODAAREA" type="date"  >
                    <label for="PREVISAODAAREA">PREVISAO DA AREA</label>
                </div>
            </td>
            <td>
                <div class="input-field inline">
                    <input name="datadaentrega" id="DATAENTREGA" type="date"  >
                    <label for="DATAENTREGA">DATA DA ENTREGA</label>
                </div>
            </td>
            <td>
                <div class="input-field inline">
                    <input name="prazoinstalacao" id="PRAZOINTALACAO" type="date"  >
                    <label for="PRAZOINTALACAO">PRAZO DE INSTALAÇÃO</label>
                </div>
            </td>
            <td>
                <div class="input-field inline">
                    <input name="iniciooperacao" id="OPERACAOUNIDADE" type="date"  >
                    <label for="OPERACAOUNIDADE">INÍCIO DE OPERAÇÃO UNIDADE</label>
                </div>
            </td>
        </tr>
    </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td>
                    <div class="input-field inline">
                        <input name="chamadootrs" id="CHAMADOOTRS" type="text"  >
                        <label for="CHAMADOOTRS">CHAMADO OTRS</label>
                    </div>
                </td>
                <td>
                    <div class="input-field inline">
                        <input name="aberturaotrs" id="DATAABERTURA" type="date"  >
                        <label for="DATAABERTURA">DATA ABERTURA</label>
                    </div>
                </td>
                <td>
                    <div class="input-field inline">
                        <input name="encerramentootrs" id="DATAENCERRAMENTO" type="date"  >
                        <label for="DATAENCERRAMENTO">DATA ENCERRAMENTO</label>
                    </div>
                </td>
                <td>
                    <div class="input-field inline">
                        <input name="solicitanteotrs" id="SOLICITANTE" type="text"  >
                        <label for="SOLICITANTE">SOLICITANTE OTRS</label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <tbody>
        <tr>
                <td>
                    <div class="input-field col s12">
                        <textarea name="observacao" id="OBSERVACAO" class="materialize-textarea"></textarea>
                        <label for="OBSERVACAO">OBSERVAÇÃO</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-field col s12">
                        <textarea name="pendencia" id="PENDENCIA" class="materialize-textarea"></textarea>
                        <label for="PENDENCIA">PENDÊNCIA</label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="width:100%;text-align: right;" ><a class="waves-effect waves-light btn" id="buttonv2" style="color: white;">Cadastrar</a></div>
    
</>

</div>
<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/SCL/js/formToJson.js"></script>
<script src="/SCL/js/core2.js"></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
</body>
</html>
