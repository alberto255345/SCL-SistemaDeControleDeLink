<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['admDisp'] != 1 and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}

$return_arr = array();
if(!empty($_GET["inicio"]) and isset($_GET["inicio"])){
    if(!empty($_GET["fim"]) and isset($_GET["fim"])){
    $sql = $connect3->prepare('SELECT * FROM disponibilidade_auto_ce WHERE `DATA`  BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW();');
    }else{
    $sql = $connect3->prepare('SELECT * FROM disponibilidade_auto_ce;');
    }
}else{
    $sql = $connect3->prepare('SELECT * FROM disponibilidade_auto_ce;');
}

$sql->execute();
while ($row = $sql->fetch()) {
    $return_arr['data'][] = $row;
} 

echo json_encode($return_arr);
?>