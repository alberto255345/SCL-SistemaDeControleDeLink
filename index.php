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
  <div id="plantaoid" class="container gssss colorr1" style="text-align: -webkit-center;">
    <br>
    <a href="tel:085981877040" style="line-height: 0px;font-size: 13px;text-align: center;width: 80%;padding-top: 10px;"
      class="card">
      <p>Número Plantão Telecom</p>
      <p>(85)98187-7040</p>
    </a>
    <br>
    <a href="https://api.whatsapp.com/send?1=pt_br&amp;phone=05585988981321" style="line-height: 0px;font-size: 13px;text-align: center;width: 80%;padding-top: 10px; display: none;" class="card">
      <p>Whatsapp Plantonista</p>
      <p>Daniel Wagner</p>
      <p>(85)98898-1321</p>
    </a>
    <a href="https://api.whatsapp.com/send?1=pt_br&amp;phone=05585999807075" style="line-height: 0px;font-size: 13px;text-align: center;width: 80%;padding-top: 10px; display: block;" class="card">
      <p>Whatsapp Plantonista</p>
      <p>Alberto Vitoriano</p>
      <p>(85)99980-7075</p>
    </a>
    <a href="https://api.whatsapp.com/send?1=pt_br&amp;phone=05585988308750" style="line-height: 0px;font-size: 13px;text-align: center;width: 80%;padding-top: 10px; display: none;" class="card">
      <p>Whatsapp Plantonista</p>
      <p>André Meireles</p>
      <p>(85)98830-8750</p>
    </a>
    <br>
  </div>
  <br>
  <div id="container1" class="container gssss colorr1">
                <div class="configdiv valro">
                    <div>SCL</div>
                </div>
                <div class="configdiv gfhs">
                        <form>
                        <div>Login</div>
                        <input type="email" class="form-control pamonha" id="InputEmail1" name="email1" aria-describedby="emailHelp" placeholder="Insira o Email">
                        <small id="emailHelp" class="form-text text-muted">Não compartilhe o seu acesso.</small>
                        <div>Senha</div>
                        <input type="password" class="form-control pamonha" id="InputPassword1" name="senha1" placeholder="Senha">
                        </form>
                        <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Check1">
                        <label class="form-check-label" for="exampleCheck1">Lembrar-me?</label>
                        </div>
                        <div class="gfhs"><a href="recuperasenha.php" class="badge badge-success">Esqueci a minha senha</a></div>
                        <button type="submit" class="btn btn-primary btt1" onclick="loginUser()" >Entrar</button>
                        <button type="submit" id="bt34" class="btn btn-primary btt1">Cadastrar</button>
                   
                </div>
        </div>
        <br>
        <div id="retornoalert2" class="alert container df233 colorr1 alert-warning alert-dismissible fade" role="alert">
        <span id="retornoalert"><strong>Sucesso</strong> I'm an alert</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>

          <div id="container2" class="container gssss cont2 colorr1">
                <div class="configdiv valro">
                    <div>SGT</div>
                </div>
                <div class="configdiv gfhs">
                <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <br>
                <fieldset>
                    <div class="form-group">
                        <input autocomplete="off" class="form-control pamonha" placeholder="Nome Completo" id="nomeform" name="nome" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" class="form-control pamonha" placeholder="Setor" id="setorform" name="setor" type="text">
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" class="form-control telefone pamonha" placeholder="Telefone" id="telefoneform" name="telefone" type="text">
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" class="form-control pamonha" placeholder="E-mail" id="validate" name="email" type="email">
                        <div id="result" class="invalid-feedback">Email inválido, favor verificar.</div>
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" id="btnpass" class="form-control pamonha" required placeholder="Senha" name="senha" type="password" value="">
                        <div id="resultpss" class="invalid-feedback">Senha Inválida, a senha deverá ter no minimo 6 caracteres dentre eles letras e números.</div>
                        <div id="tooltip" role="tooltip"><div id="arrow"></div>a senha deverá ter no minimo 6 caracteres dentre eles letras e números.</div>
                    </div>
                    <button type="submit" id="btn122" name="register" onclick="registerUser()" class="btn btn-primary btt1" disabled>Concluir</button>
                    <button type="submit" id="btn642" class="btn btn-primary btt1">Voltar</button>
                  </fieldset>
                </div>
        </div>
<script src="./dist/js/jquery-3.5.1.js"></script>
<script src="./dist/js/jquery.maskedinput.min.js"></script>
<script src="./dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="./js/formToJson.js"></script>
<script src="./js/core.js"></script>
  </body>
</html>