<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['telecom'] != 1 and $_SESSION['tipo'] != 'Admin' or $_SESSION['admDisp'] != 1){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}

$return_arr = array();

$sql = $connect3->prepare('
SELECT ID, ID as linkid, host, name, eventid,  FROM_UNIXTIME(fail,"%h:%i:%s %d/%m/%Y") as fail, r_eventid,  if( clear = 0, NULL, FROM_UNIXTIME(clear,"%h:%i:%s %d/%m/%Y")) as clear, round(time/60,0) as time, groupid  FROM log_falhas where clear IS not NULL AND NAME = "ICMP Ping Indisponível";
');
$sql->execute();
while ($row = $sql->fetch()) {
    $return_arr['data'][] = $row;
 

// foreach ($row as $value => $valor) {
//     print_r($value . ' -> ' . $valor );
//     echo ' / ';
// }
// echo '<br>';
}
echo json_encode($return_arr);
?>