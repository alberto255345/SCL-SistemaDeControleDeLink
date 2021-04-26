<?PHP

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);
include("linkedlist.class.php");


$geral = "SELECT eve1.eventid, eve1.objectid, eve1.name FROM zabbix.`events` AS eve1 LEFT JOIN zabbix.event_recovery as eve2
ON eve1.eventid = eve2.eventid
WHERE eve2.eventid IS NULL AND eve1.value = 1";

$geral2 = "SELECT ho1.hostid, 
LEFT(ho1.host,2)                                        AS UF
,SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',2),'_',-1) AS Operadora
,SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1) AS unidade
,SUBSTRING_INDEX(ho1.host,'_',-1)                        AS tipo
,if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),3) = 'HS.' ,
'hospital',if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),3) = 'VI.' ,
'vidaeimagem',if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),7) = 'HAPCLI.' ,
'hapclinica',if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),3) = 'PA.' ,
'prontoatendimento',if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),3) = 'CD.' ,
'centrodedistribuicao',if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),8) = 'MEDPREV.' ,
'medprev',if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),4) = 'LAB.' ,
'laboratorio',if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),4) = 'ADM.' ,
'administrativo',if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(ho1.host,'_',-2),'_',1),4) = 'AMB.' ,
'ambulatorio','outros' ) ) ) ) ) ) ) ) ) AS modalidade
FROM zabbix.`hosts` AS ho1 LEFT JOIN zabbix.hosts_groups AS ho2
ON ho1.hostid = ho2.hostid
WHERE ho2.groupid = 15 AND ho1.`status` = 0";

$geral3 = "SELECT consulta1.triggerid, it.hostid FROM
(SELECT tri.triggerid, fun.itemid FROM `triggers` AS tri LEFT JOIN functions AS fun
ON tri.triggerid = fun.triggerid) AS consulta1
LEFT JOIN
items AS it
ON consulta1.itemid = it.itemid";

$stmt2 = $connect2->prepare($geral2);
$result2 = $stmt2->execute();
$val = $stmt2->rowCount();
$ds = "";
echo '<div class="lista">';

if($val > 0){
    while($row = $stmt2->fetch(PDO::FETCH_OBJ)){
        

        if($row->value == 0){
            $cor = 'green';
        }elseif($row->value == 1){
            $cor = 'orange';
        }elseif($row->value == 2){
            $cor = 'yellow';
        }else{
            $cor = 'red';
        }
        echo '<div class="usu"><span class="textON">' . $row->UF . "-" . str_replace("MEDPREV.","FMED.",str_replace("HS.","HOSP.",str_replace("HAPCLI.","HAP.",$row->metric))) . '</span><div class="circulo ' . $cor . '"></div></div>';
    }
    echo '</div>';
}else{
    echo "Sem Falha";
    echo '</div>';
}

?>