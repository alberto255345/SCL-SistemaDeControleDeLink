<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['telecom'] != 1 and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}

$return_arr = array();

$sql = $connect->prepare('
SELECT 
li.ID,
un.unidade, 
un.UF, 
un.cidade, 
CONCAT(un.endereco," ",un.N,",",un.bairro," ",un.CEP) AS endereco,
un.ativo as ativo1,
li.ativo as ativo2,
li.tipo,
li.operadora,
li.velocidade,
li.circuito,
li.ip_link,
li.firewall,
li.ip_firewall,
li.interface,
li.ip_operadora,
li.id_concentrador
from link_hapvida AS li LEFT JOIN unidade_hapvida AS un ON li.ID_unidade = un.ID;
');
$sql->execute();
while ($row = $sql->fetch()) {
    $return_arr['data'][] = $row;
} 

echo json_encode($return_arr);
?>