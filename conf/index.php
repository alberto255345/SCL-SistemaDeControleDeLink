<?php
error_reporting(E_ERROR | E_PARSE);

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);


$sql = "Select l.penultimo, u.tipo, u.avatar, u.nome, u.setor, u.telefone, u.email, u.edicao, l.data, u.hash from user as u left join last_login as l on u.cod = l.cod_user where u.cod = '" . $_SESSION['usuario_log'] . "';";
$stmt2 = $connect->prepare($sql);
$stmt2->execute();
$dado = $stmt2->fetch();
include("../linkgeral.php");

?>
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


<div style="display: flex; align-items: center; ">

<div>
    <table>
        <tr>
            <td>Tipo de Usuário:</td><td><?php echo $dado[tipo]; ?></td>
        </tr>
        <tr>
            <td>Nome:</td><td><input type="text" name="nomeid" value="<?php echo $dado[nome]; ?>"></td>
        </tr>
        <tr>
            <td>Setor:</td><td><input type="text" name="setorid" value="<?php echo $dado[setor]; ?>"></td>
        </tr>
        <tr>
            <td>Telefone:</td><td><input type="text" class="telefone" name="telefoneid" value="<?php echo $dado[telefone]; ?>"></td>
        </tr>
        <tr>
            <td>E-Mail:</td><td><input type="text" name="mailid" value="<?php echo $dado[email]; ?>"></td>
        </tr>
        <tr>
            <td>Ultimo Login:</td><td><?php echo $dado[penultimo]; ?></td>
        </tr>
        <tr>
            <td>Ultima Edição:</td><td><?php echo $dado[edicao]; ?></td>
        </tr>
        <tr><td><br><input type="hidden" name="hashid" value="<?php echo $dado[hash]; ?>"></td></tr>
        <?PHP 
        $path4 = $_SERVER['DOCUMENT_ROOT'];
        $path4 .= "/SCL/conf/senha.php";

        if($_SESSION['changepass'] == 1){
            include($path4);
        }
        ?>
        <tr>
          <td colspan="2">
                  <div id="alertaid" class="ocult"></div>
              </td>
        </tr>
    </table>
</div>

<div class="vl"></div>
<div>
    <table>
        <tr>
            <td>
                <div>
                    <input type='file' id="file" name="file">
                    <span id='val'></span>
                    <span class="small blue button" id='button'>Selecionar Arquivo</span>
                </div>
            </td><td><button type="button" onclick="normal()" class="small blue button">Avatar padrão</button></td>
        </tr>
        <tr>
            <td colspan="2"><span id="upload_image"><img id="myimg" src="/SCL/assets/img/<?PHP echo $dado[avatar];?>" alt="<?PHP echo $dado[avatar];?>" class="avatar2"></span></td>
        </tr>
    </table>
</div>

</div>
<button type="button" name="novaid" value="true" onclick="salvando()" class="small blue button">Salvar</button>
</div>

</div>
<script src='/SCL/dist/js/jquery-3.5.1.js'></script>
<script src='/SCL/dist/js/bootstrap.bundle.min.js'></script>
<script src="/SCL/js/coreMenu.js"></script>
<script src="/SCL/js/core3.js"></script>
<script src="/SCL/dist/js/jquery.maskedinput.min.js"></script>
<script type="application/javascript">
            function destino(item) {
            window.location.href = item;
        }


function normal() {
  $('#upload_image').html('<img id="myimg" src="/SCL/assets/img/user.jpg" alt="user.jpg" class="avatar">');
}

$('#button').click(function(){
   $("input[type='file']").trigger('click');
})

$("input[type='file']").change(function(){
   $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
})  

        function salvando() {

          $.ajax({
              url:'atualiza.php',
                  type:'POST',
                  data: {avatar: $('#myimg').attr('alt'), novaid: 'true', nome: $("input[name='nomeid']").val(), setor: $("input[name='setorid']").val(), telefone: $("input[name='telefoneid']").val(), newpassword: $("input[name='senhaid']").val(), email: $("input[name='mailid']").val(), hashid: $("input[name='hashid']").val()},
                  success: function(data){
                    $('#alertaid').html(data);
                    if (data != '') {
                      $("#alertaid").show( 400 );
                    }else {
                      $("#alertaid").hide( 400 );
                    }
                }
            });

        }

        $(document).ready(function () {


          $(document).on('change','#file', function(){

            var property = document.getElementById("file").files[0];
            var image_name = property.name;
            var image_extension = image_name.split(".").pop().toLowerCase();
            if(jQuery.inArray(image_extension, ['gif','png','jpg','jpeg']) == -1){
            	alert("Formato Invalido!");
            }
            var image_size = property.size;
            if(image_size > 2000000){
            	alert("Imagem superior a dois megabytes");
            }else{
            	var form_data = new FormData();
            	form_data.append("file",property);
            	$.ajax({
            		url:"upload.php",
            		method:"POST",
            		data:form_data,
            		contentType:false,
            		cache:false,
            		processData:false,
            		beforeSend:function(){
            			$('#upload_image').html("<label class='text-success'>Imagem Carregando...</label>");
            		},
                success:function(data){
                  $('#upload_image').html(data);
                }
            	})
            }

          });

        });

        </script>
</body>
</html>
