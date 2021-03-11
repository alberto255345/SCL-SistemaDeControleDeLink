<?php

$saidadevalro = 'config.php';
require_once $saidadevalro;

if(!function_exists("protect")){

  function protect(){

    if(!isset($_SESSION['usuario_log'])){

      header('Location: /SCL/');
      //echo "<script>location.href='" . $path . "';</script>";
      exit('Login inválido: Redirecionando...');

    }


  }

}

protect();

if(isset($_SESSION['email'])){

  $sql = "SELECT admDisp, admLink, admOS, changepass, email, telecom, tipo, cod as valor, ativo, nome, avatar FROM user WHERE email = '$_SESSION[email]'";
  $que = $connect->prepare($sql) or die($mysqli->error);
  $dado = $que->execute();
  $val = $que->rowCount();
  $row = $que->fetch(PDO::FETCH_OBJ);
  if($val == 0 or $val > 1){

    header('Location: /SCL/');
    //echo "<script>location.href='" . $path . "';</script>";
    exit('Login inválido: Redirecionando...');

  }
  if($row->ativo == 1){
      $_SESSION['avatar'] = $row->avatar;
      $_SESSION['usuario_log'] = $row->valor;
      $pieces = explode(" ", $row->nome);
      $_SESSION['nome_1'] = $pieces[0];
      $_SESSION['telecom'] = $row->telecom;
      $_SESSION['tipo'] = $row->tipo;
      $_SESSION['email'] = $row->email;
      $_SESSION['changepass'] = $row->changepass;
      $_SESSION['admOS'] = $row->admOS;
      $_SESSION['admLink'] = $row->admLink;
      $_SESSION['admDisp'] = $row->admDisp;
  }

}

?>
