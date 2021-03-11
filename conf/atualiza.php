<?PHP
$path1 = $_SERVER['DOCUMENT_ROOT'];
$path1 .= "/SCL/db/config.php";
include($path1);


$erro = array();
$errovalor = 0;

  if(isset($_POST['newpassword'])){
    if(!empty($_POST['newpassword'])){

      $hash = $_POST['hashid'];

      $sqlteste = "SELECT senha, ID FROM user
      WHERE hash = '$hash'";
      $que = $connect->prepare($sqlteste) or die($connect->error);
      $que->execute();
      $dado = $que->fetch();

      if(isset($_POST['novaid'])){

        if($que->rowCount() != 0){

              if(!password_verify($_POST['newpassword'],$dado['senha'])){

                $cod = $_POST['hashid'];
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $email = $_POST['email'];
                $setor = $_POST['setor'];
                $avatar = $_POST['avatar'];
                $bytes = random_bytes(5);
                $hex = bin2hex($bytes);
                $iddele = $dado['ID'];
                $senhasegura = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);

                $sqlteste2 = "UPDATE `inventario`.`user` SET `senha`='$senhasegura', `nome`='$nome', `telefone`='$telefone', `email`='$email', `setor`='$setor', `avatar`='$avatar', `hash`='$hex' WHERE  `hash`='$cod';";
                $sqlteste3 = "UPDATE `kanboard`.`users` SET `password`='$senhasegura' WHERE  `id`='$iddele';";

                $que3 = $connect->prepare($sqlteste2) or die($connect->error);
                $que3->execute();

                $quek = $connect->prepare($sqlteste3) or die($connect->error);
                $quek->execute();

                if(count($erro) == 0){
                  unset($erro);
                }

              }else{
                $errovalor = $errovalor + 1;
                $erro[] = "Senha igual a anterior, tente novamente";
              }



          }else{
            $errovalor = $errovalor + 1;
                $erro[] = "Código não é valido, Atualize a Página";
          }

      }else{
        $errovalor = $errovalor + 1;
          $erro[] = "Erro";
      }

    }else{

      $cod = $_POST['hashid'];
      $nome = $_POST['nome'];
      $telefone = $_POST['telefone'];
      $email = $_POST['email'];
      $setor = $_POST['setor'];
      $avatar = $_POST['avatar'];

      $sqlteste2 = "UPDATE `inventario`.`user` SET `nome`='$nome', `telefone`='$telefone', `email`='$email', `setor`='$setor', `avatar`='$avatar' WHERE  `hash`='$cod';";

      $que4 = $connect->prepare($sqlteste2) or die($connect->error);
      $que4->execute();

      if(count($erro) == 0){
        unset($erro);
      }

    }

  }else{
    $errovalor = $errovalor + 1;
      $erro[] = "Código inválido";
  }


  if($errovalor == 0){
    $erro = array();
  }

  
  if (count($erro) > 0) {
    foreach($erro as $msg) echo '<div class="alert1">' . $msg . '</div><br>';
  }else {
    echo '<div class="sucesso1">Sucesso!</div><br>';
  }

?>
