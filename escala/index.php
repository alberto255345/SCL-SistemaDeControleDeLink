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

include("../linkgeral.php");
?>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/SCL/css/calendario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <link rel="stylesheet" href="/SCL/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/SCL/css/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
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

<div style="text-align: left;">
<?PHP
    if($_SESSION['admEscala'] == 1 or $_SESSION['tipo'] == 'Admin'){
        echo '<a href="#modal1" id="criaescala" class="waves-effect waves-light btn modal-trigger">Cadastrar</a>';
        echo '<a href="#" id="editarescala" class="waves-effect waves-light btn disabled">Editar</a>';
        echo '<a href="#" id="deleteescala" class="waves-effect waves-light btn disabled">Deletar</a>';
    }
?><a href="#" id="totalescala" class="waves-effect waves-light btn">Total de Horas ao Mês</a>
</div>
<br>
<div id="ganttescala" >

<?PHP

include($_SERVER["DOCUMENT_ROOT"]."/SCL/escala/calendario.php");

?>
    <div id="tabelasegunda" class="tabelasegunda">
    <table>
        <tr>
            <th>Selecionar</th>
            <th>Data de Criação</th>
            <th>Usuário Criador</th>
            <th>Atividade</th>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="checkbox" id="idescala" name="idescala" value="1">
                    <span>1</span>
                </label>
            </td>
            <td>2021-07-12 12:40:33</td>
            <td>Alberto</td>
            <td>Ínicio de Escala 12/03/2021 00:00 Alberto <i class="fas fa-file-import"></i><br>Saída da Escala 13/03/2021 23:59 Alberto <i class="fas fa-file-export"></i></td>
        </tr>
    </table>
    </div>
</div>


</div>
</div>
</div>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>

<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>

<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/js/geral.js"></script>
<script>

$(document).ready(function(){
    
    $('#criaescala').click(function () { 
        $('.modal').modal();
    });

    $("input[type='checkbox']").change(function() {
    var ver = 0;
        $("input[type='checkbox']").each(function()
            {                  
                if($(this).prop("checked")){
                    ver++;
                }
            });
        if(ver == 0){
            $( "#editarescala" ).addClass( "disabled" );
            $( "#deleteescala" ).addClass( "disabled" );
        }else{
            $( "#editarescala" ).removeClass( "disabled" );
            $( "#deleteescala" ).removeClass( "disabled" );
        }
    });

    if(window.matchMedia("(max-width: 767px)").matches){
        // The viewport is less than 768 pixels wide
        // alert("This is a mobile device.");
        $( "#ganttescala" ).removeClass( "ganttescalaC" );
        $( "#ganttescala" ).addClass( "ganttescalaM" );
        $( "#tablecalendar" ).addClass( "calendarFull" );
        $( "#tabelasegunda" ).removeClass( "tabelasegunda" );
    } else{
        // The viewport is at least 768 pixels wide
        $( "#ganttescala" ).removeClass( "ganttescalaM" );
        $( "#ganttescala" ).addClass( "ganttescalaC" );
        $( "#tablecalendar" ).removeClass( "calendarFull" );
        $( "#tabelasegunda" ).addClass( "tabelasegunda" );
    }
});

$(document).on('resize', function(){
    if(window.matchMedia("(max-width: 767px)").matches){
        // The viewport is less than 768 pixels wide
        // alert("This is a mobile device.");
        $( "#ganttescala" ).removeClass( "ganttescalaC" );
        $( "#ganttescala" ).addClass( "ganttescalaM" );
        $( "#tablecalendar" ).addClass( "calendarFull" );
        $( "#tabelasegunda" ).removeClass( "tabelasegunda" );
    } else{
        // The viewport is at least 768 pixels wide
        $( "#ganttescala" ).removeClass( "ganttescalaM" );
        $( "#ganttescala" ).addClass( "ganttescalaC" );
        $( "#tablecalendar" ).removeClass( "calendarFull" );
        $( "#tabelasegunda" ).addClass( "tabelasegunda" );
    }
});

</script>

</body>
</html>
