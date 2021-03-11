<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCL - Sistema de Cadastro de Links</title>
    <link rel="stylesheet" href="/SCL/grafico/css/1graf.css">
    <link rel="stylesheet" href="../css/popper.css">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SCL/css/bootstrap-multiselect.css" type="text/css"/>
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
</head>
<body>
    <div>
    <div class="pamens"></div>
    <div class="pamens2"></div>
    <div class="pamenstrs"></div>
    <div class="pamenstex"><img src="/SCL/assets/img/logo.png" alt="" srcset=""></div>
    <div class="titulomidel"><div class="titulo"><h3><?PHP 
    
    if(isset($_GET["modalidade"]) && !empty($_GET["modalidade"])){
        $saida = explode(" ",$_GET["modalidade"]);
        foreach ($saida as $value) {
            if($value == "hospital"){
                echo "Hospital ";
            }
            if($value == "vidaeimagem"){
                echo "Vida e Imagem ";
            }
            if($value == "hapclinica"){
                echo "Hapclinica ";
            }
            if($value == "prontoatendimento"){
                echo "Pronto Atendimento ";
            }
            if($value == "centrodedistribuicao"){
                echo "Centro de Distribuição ";
            }
            if($value == "medprev"){
                echo "Medicina Preventiva ";
            }
            if($value == "ambulatorio"){
                echo "Ambulatório ";
            }
            if($value == "outros"){
                echo "Outros ";
            }
            if($value == "administrativo"){
                echo "Administrativo ";
            }
            if($value == "laboratorio"){
                echo "Laboratório ";
            }
        }
    }else{
        echo "Geral";
    }

    ?></h3></div></div>
    <div class="pamens3">
            <button class="btn btn-primary prevenir" id="button3" aria-describedby="tooltip">Filtro</button>
            <button class="btn btn-primary prevenir" id="button2" aria-describedby="tooltip">Configurações</button>
            <button class="btn btn-primary prevenir" id="button4" aria-describedby="tooltip">Legendas</button>
            <div id="tooltip" role="tooltip">
            <div id="arrow" data-popper-arrow></div>
            <button class="btn btn-primary prevenir" name="increase-font" id="increase-font" title="Aumentar fonte">A +</button>
            <button class="btn btn-primary prevenir" name="decrease-font" id="decrease-font" title="Diminuir fonte">A -</button>
            <button class="btn btn-primary prevenir" name="increase-size" id="increase-size" title="Aumentar Tamanho">T +</button>
            <button class="btn btn-primary prevenir" name="decrease-size" id="decrease-size" title="Diminuir Tamanho">T -</button>
            <button class="btn btn-primary prevenir" name="ajustar-size" id="ajustar-size" title="Ajustar Tamanho">Ajustar Tamanho</button>
            <button class="btn btn-primary prevenir" name="atualizar" id="atualizar" title="Atualizar a Base">Atualizar</button>
            <div style="margin-left: 5rem;" class="prevenir"><input type="checkbox" class="form-check-input prevenir" id="Check1" checked><label class="form-check-label prevenir" for="exampleCheck1">Atualizar Automaticamente</label></div>
            </div>
            <div id="tooltip2" role="tooltip">
                    <label for="Modalidades" class="prevenir">Modalidades</label>
                    <select id="primselec" multiple="multiple">
                        <option value="hospital">Hospital</option>
                        <option value="vidaeimagem">Vida e Imagem</option>
                        <option value="hapclinica">HapClinica</option>
                        <option value="prontoatendimento">Pronto Atendimento</option>
                        <option value="centrodedistribuicao">Centro de Distribuição</option>
                        <option value="medprev">MedPrev</option>
                        <option value="administrativo">Administrativo</option>
                        <option value="laboratorio">Laboratório</option>
                        <option value="ambulatorio">Ambulatório</option>
                        <option value="outros">Outros</option>
                    </select>
                    <label for="UF" class="prevenir">UF</label>
                    <select id="primselec2" multiple="multiple">
                        <option value="AL">AL</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RN">RN</option>
                        <option value="SC">SC</option>
                        <option value="SE">SE</option>
                        <option value="SP">SP</option>
                    </select>
                    <label for="Separação por UF" class="prevenir">Separação por UF</label>
                    <input type="checkbox" id="separaid" class="prevenir" name="separa" >
                    <label for="Separação por UF" class="prevenir">Somente em falhas</label>
                    <input type="checkbox" id="falha" class="prevenir" name="falha" >
                    <button id="target" class="btn btn-primary" type="submit" >Filtrar</button>
    </div>
    <div id="toolti3" role="tooltip"><div class="circulo green" style="width: 2rem; height: 2rem;"></div> Unidade sem falha &nbsp; <div class="circulo orange" style="width: 2rem; height: 2rem;"></div> Unidade com lentidão &nbsp; <div class="circulo yellow" style="width: 2rem; height: 2rem;"></div> Unidade com link inacessível &nbsp; <div class="circulo red" style="width: 2rem; height: 2rem;"></div> Unidade isolada (Somente nesse caso será acionado a equipe de Telecom)</div>
    </div>

    
    </div>
    <div id="valortempo"></div>
    <div id="load">
        <img src="../assets/img/giphy.gif" alt="Carregando aguarde..."/>
    </div>
    <div id="pames">
            <span>Carregando . . .</span>
    </div>
    <script src="../dist/js/jquery-3.5.1.js"></script>
    <script src="/SCL/assets/js/core/popper.min.js"></script>
    <script type="text/javascript" src="/SCL/js/bootstrap-multiselect.js"></script>
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="../js/coreGra.js"></script>
</body>
</html>