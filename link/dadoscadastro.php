<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['admOS'] != '1' and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}

if(!isset($_SESSION))
    session_start();

    if(isset($_POST['data'])){
                        
            $tarray = json_decode($_POST['data'],TRUE);
            $tarray1 = json_decode($_POST['data1'],TRUE);
            $tarray2 = json_decode($_POST['data2'],TRUE);
            
            $columns = implode(', ', array_keys($tarray));
            $values = "'" . implode("', '",$tarray) . "'";

            $columns1 = implode(', ', array_keys($tarray1));
            $values1 = "'" . implode("', '",$tarray1) . "'";

            $columns2 = implode(', ', array_keys($tarray2));
            $values2 = "'" . implode("', '",$tarray2) . "'";

            $script1 = "INSERT INTO `inventario`.`email_TB` ($columns) VALUES ($values);";
            $stmt2 = $connect->prepare($script1);
            $stmt2->execute();

            $saidat1 = $connect->prepare("SELECT MAX(ID_email) AS saida FROM email_TB");
            $saidat1->execute();
                while($row2 = $saidat1->fetch(PDO::FETCH_OBJ)){
                $saida = $row2->saida;
                }

            $script2 = "INSERT INTO `inventario`.`unidade_hapvida` ($columns1) VALUES ($values1);";
            $stmt3 = $connect->prepare($script2);
            $stmt3->execute();

            $saidat2 = $connect->prepare("SELECT MAX(ID) AS saida FROM unidade_hapvida");
            $saidat2->execute();
                while($row2 = $saidat2->fetch(PDO::FETCH_OBJ)){
                $saida2 = $row2->saida;
                }

            $script3 = "INSERT INTO `inventario`.`OS_TB` ($columns2 , ID_email, ID_unidade) VALUES ($values2 , '" . $saida . "', '" . $saida2 . "');";
        
            $stmt4 = $connect->prepare($script3);
            $resultado = $stmt4->execute();

            if (!$resultado){
                echo "failed";
                //die("Database access failed: " . mysql_error());
            } else {
                echo "success";
            }

    }

?>