<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

$return_arr = array();

$sql = $connect->prepare("
SELECT un.unidade, un.UF, un.cidade, un.endereco, un.N, un.complemento, un.bairro, un.CEP, tu.tipo, tu.servico FROM (SELECT os.*, em.email FROM OS_TB AS os LEFT JOIN email_TB AS em ON os.ID_email = em.ID_email) AS tu LEFT JOIN  unidade_hapvida as un ON un.ID = tu.ID_unidade
");
$sql->execute();
while ($row = $sql->fetch()) {
    $return_arr['data'][] = $row;
} 

echo json_encode($return_arr);
?>