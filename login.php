<?PHP
//error_reporting(E_ERROR | E_PARSE);
require_once 'db/config.php';

if(!isset($_SESSION))
    session_start();


    if(isset($_POST['process'])){
        if($_POST['process'] == "registerUser"){ 
    
                
                $tarray = json_decode($_POST['data'],TRUE);
    
                //$sjson = json_encode($tarray);
                //echo '<pre>'; var_dump($sjson); echo '</pre>';
                function senhaP($x, $m) { 
                    if($x == "senha"){
                        $m = password_hash($m, PASSWORD_DEFAULT);
                    }
                        return "'$m'";
                }
                function emailP($x, $m) { 
                    if($x == "email"){
                        return "$m";
                    }
                }
                
                $jjemail = implode('', array_map("emailP",array_keys($tarray) ,$tarray));
    
                $sql2 = 'SELECT email, ID FROM user;';
                $stmt2 = $connect->prepare($sql2);
                $result2 = $stmt2->execute();
                $val = $stmt2->rowCount();
                $maxID = 0;
                if($val > 0){
                    while($row = $stmt2->fetch(PDO::FETCH_OBJ)){
                        $email2 = $row->email;
                        if($row->ID >= $maxID){
                            $maxID = $row->ID;
                        }
                        if($email2 == $jjemail){
                            //echo "Usuário já cadastrado com esse Email";
                            die("Usuário já cadastrado com esse Email");
                        }
                    }
                }
                
                    $bytes = random_bytes(5);
                    $hex = bin2hex($bytes);    
                    $tarray["cod"] = (string)((int)$maxID + 1) . $hex;
                    $tarray["hash"] = $hex;
                    // $tarray[] = array('hash' => 'some_value');
    
                    $columns = implode(', ', array_keys($tarray));
                    $values = implode(', ', array_map("senhap",array_keys($tarray) ,$tarray));
                    //echo $columns;
                    //$placeholders = implode(', ', array_fill(0, count($tarray), '?'));
                    $sql = "INSERT INTO user($columns) VALUES ($values)";
                    $stmt = $connect->prepare($sql);
                    $result = $stmt->execute();
    
                    if (!$result){
                        echo "failed";
                        //die("Database access failed: " . mysql_error());
                    } else {
                        echo "success";
                    }
    
        }
    }

    if(isset($_POST['process'])){
        if($_POST['process'] == "loginUser"){ 
                $erro = 0;
                
                $tarray2 = json_decode($_POST['data'],TRUE);
                $senha = $tarray2["senha1"];
                $_SESSION['email'] = $tarray2["email1"];
                // $_SESSION['email'] = $_POST[login];

                // Validação de dados
                if(!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)){
                    echo "Preencha seu <strong>e-mail</strong> corretamente.";
                    $erro = $erro + 1;
                }

                if(strlen($senha) < 6 || strlen($senha) > 16){
                    echo "Preencha sua <strong>senha</strong> corretamente. Necessário de no minimo 6 caracteres";
                    $erro = $erro + 1;
                }

                if($erro == 0){

                    $sql = "SELECT changepass, email, telecom, tipo, senha as senha, cod as valor, ativo, nome, avatar
                    FROM user
                    WHERE email = '$_SESSION[email]'";
                    $que = $connect->prepare($sql) or die($mysqli->error);
                    $dado = $que->execute();
                    $val = $que->rowCount();
                    $row = $que->fetch(PDO::FETCH_OBJ);
                    if($val == 0 or $val > 1){
                        echo "Nenhum usuário possui o <strong>e-mail</strong> informado.";
                        $erro = $erro + 1;
                    }elseif(password_verify($senha,$row->senha)){
                    if($row->ativo == 1){
                        $_SESSION['avatar'] = $row->avatar;
                        $_SESSION['usuario_log'] = $row->valor;
                        $pieces = explode(" ", $row->nome);
                        $_SESSION['nome_1'] = $pieces[0];
                        $_SESSION['telecom'] = $row->telecom;
                        $_SESSION['tipo'] = $row->tipo;
                        $_SESSION['email'] = $row->email;
                        $_SESSION['changepass'] = $row->changepass;
                        
                        $sqllogin = "Select * from last_login where cod_user = '" . $row->valor . "';";
                        $quelogin = $connect->prepare($sqllogin) or die($mysqli->error);
                        $dadologin = $quelogin->execute();
                        $juvenal = $quelogin->rowCount();
                        if($juvenal == 0){
                            echo "pamanho";
                            $queinto = "INSERT INTO `inventario`.`last_login` (`cod_user`) VALUES ('" . $row->valor . "');";
                        }else{
                            $queinto = "UPDATE `inventario`.`last_login` SET penultimo = `data`, parametro = parametro + 1 WHERE  `cod_user`='" . $row->valor . "';";
                        }

                        $quefinal = $connect->prepare($queinto) or die($mysqli->error);
                        $quefinal->execute();

                    }else {
                        echo "Usuário não ativo, entre em contato com o Admin.";
                        $erro = $erro + 1;
                    }
                    }else{
                        echo "<strong>Senha</strong> incorreta.";
                        $erro = $erro + 1;
                    }
                }

                if($erro == 0){
                    echo "success";
                }
        }
    }

    if(isset($_POST['process'])){
        if($_POST['process'] == "changePass"){ 
    
            $sql = "SELECT * FROM user WHERE hash = '$_POST[codnome]'";
            $que = $connect->prepare($sql);
            $dado = $que->execute();
            $val = $que->rowCount();
            $row = $que->fetch(PDO::FETCH_OBJ);
            if($val == 0 or $val > 1){
                echo "Nenhum usuário possui o <strong>e-mail</strong> informado.";
            }else{

                $bytes = random_bytes(5);
                $hex = bin2hex($bytes);  

                $sql2 = 'UPDATE `inventario`.`user` SET `hash`= "' . $hex . '" , senha = "' . password_hash($_POST['codsenha'], PASSWORD_DEFAULT) . '" WHERE  `email`= "' . $_POST['codemail'] . '" ;';
              
                $stmt2 = $connect->prepare($sql2);
                $result2 = $stmt2->execute();
    
                    if (!$result2){
                        echo "failed";
                        //die("Database access failed: " . mysql_error());
                    } else {
                        echo "success";
                    }

            }
    
        }
    }


?>