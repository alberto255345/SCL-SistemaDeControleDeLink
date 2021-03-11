<?php
if(!isset($_SESSION))
session_start();

if(isset($_SESSION['usuario_log'])){
            echo "<script>location.href='http://10.5.90.139/SCL/home.php';</script>";
            exit();
            unset($_SESSION['email']);
    }
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <head>
    <title>SCL - Sistema de Controle de Links</title>
    <link rel="stylesheet" href="/SCL/css/popper.css">
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/logo.png">
    <link rel="icon" type="image/png" href="./assets/img/logo.png">
  </head>

  <body> 
  <div class="heidi"></div>
  <div id="container1" class="container gssss colorr1">
                <div class="configdiv valro">
                    <div>Recupera Senha</div>
                </div>
                <div class="configdiv gfhs">
                        <form>
                            <div>Código</div>
                            <input type="text" class="form-control pamonha" id="codigo" name="senha1" placeholder="Código" value="<?PHP echo (empty($_GET["codigo"]) ? "" : $_GET["codigo"]); ?>">
                            <div>E-mail</div>
                            <input type="email" class="form-control pamonha" id="InputEmail1" name="email1" aria-describedby="emailHelp" placeholder="Insira o Email" value="<?PHP echo (empty($_GET["email"]) ? "" : $_GET["email"]); ?>">
                            <div>Nova Senha</div>
                            <input type="password" class="form-control pamonha" id="senha1" name="senha1" placeholder="Senha">
                        </form>
                        <button type="submit" class="btn btn-primary btt1" onclick="alterarpass()">Alterar</button>
                        <button type="submit" class="btn btn-primary btt1" onclick="para('/SCL/')">Voltar</button>
                </div>
        </div>

        <div id="retornoalert2" class="alert container df233 colorr1 alert-warning alert-dismissible fade" role="alert">
        <span id="retornoalert"><strong>Sucesso</strong> I'm an alert</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        
<script src="./dist/js/jquery-3.5.1.js"></script>
<script src="./dist/js/jquery.maskedinput.min.js"></script>
<script src="./dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="./js/formToJson.js"></script>
<script src="./js/core.js"></script>
  </body>
</html>