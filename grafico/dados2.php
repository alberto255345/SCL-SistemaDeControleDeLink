<?PHP

$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

if($_SESSION['grafAcess'] != 1 and $_SESSION['tipo'] != 'Admin'){
    $_SESSION['mensagem'] = "Sem Acesso a esse Link!";
    header('Location: /SCL/');
}


function agroup_array($array){
$new_array = array();
$sortable_array = array();

if (count($array) > 0) {
    foreach ($array as $k => $v) {
        if (is_array($v)) {
            foreach ($v as $k2 => $v2) {
                if ($k2 == 2) {
                    if(count($sortable_array) == 0){
                        array_push($sortable_array,$v2);
                    }else{
                        if (!in_array($v2, $sortable_array)) { 
                            array_push($sortable_array,$v2);
                        }
                    }
                    
                }
            }
        }
    }
    
    foreach ($sortable_array as $k2 => $v2) {
        for($x = 0;$x <= count($array)-1;$x++){
            if($array[$x][2] == $v2){
                if($array[$x][6] == 1){
                    if (!in_array($v2, $sortable_array)) { 
                        array_push($new_array,array($array[$x][0],$v2,1,));
                    }
                }
            }
        }
    }
////////////////////
}

foreach ($sortable_array as &$value) {
    print_r($value);
    echo '<br>';
}

return $new_array;
};

function array_sort($array, $on, $order=SORT_ASC){
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
};


function array_filter2($array, $on, $colum)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($colum == $k2) {
                        if($on <= $v2){
                            $sortable_array[$k] = $v2;
                        }
                    }
                }
            } else {
                if ($on <= $v) {
                    
                    $sortable_array[$k] = $v;
                }
            }
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
};


$geral = "SELECT 
hos.hostid
,max(if(eve.name = 'Perda de Pacote' OR eve.name = 'Tempo de resposta de ping ICMP alto',1,if(eve.name = 'ICMP Ping Indisponível',2,0))) AS falha
FROM `events` AS eve
LEFT JOIN event_recovery AS evr
ON evr.eventid = eve.eventid
LEFT JOIN `functions` AS fun
ON eve.objectid = fun.triggerid
LEFT JOIN items AS ite
ON ite.itemid = fun.itemid
LEFT JOIN hosts_groups AS hsg
ON hsg.hostid = ite.hostid
LEFT JOIN `hosts` AS hos
ON hos.hostid = ite.hostid
WHERE eve.name IN ('ICMP Ping Indisponível','Perda de Ping','Tempo de resposta de ping ICMP alto')
AND evr.eventid IS NULL
AND eve.value = 1
AND hsg.groupid = 15
AND hos.`status`= 0
GROUP BY hos.hostid";

$geral2 = "SELECT * FROM 
(SELECT 
									LEFT(thos.HOST,2)                                         AS UF
                           ,SUBSTRING_INDEX(SUBSTRING_INDEX(thos.HOST,'_',2),'_',-1) AS Operadora
                           ,SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1) AS unidade
                           ,SUBSTRING_INDEX(thos.HOST,'_',-1)                        AS tipo
                           ,if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),3) = 'HS.' ,
                       'hospital',if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),3) = 'VI.' ,
                       'vidaeimagem',if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),7) = 'HAPCLI.' ,
                       'hapclinica',if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),3) = 'PA.' ,
                       'prontoatendimento',if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),3) = 'CD.' ,
                       'centrodedistribuicao',if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),8) = 'MEDPREV.' ,
                       'medprev',if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),4) = 'LAB.' ,
                       'laboratorio',if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),4) = 'ADM.' ,
                       'administrativo',if( LEFT( SUBSTRING_INDEX(if(LOCATE('.',SUBSTRING_INDEX(thos.host,'_',-2)) > 0 , SUBSTRING_INDEX(thos.host,'_',-2),SUBSTRING_INDEX(thos.host,'_',-3)),'_',1),4) = 'AMB.' ,
                       'ambulatorio','outros' ) ) ) ) ) ) ) ) ) AS modalidade,
                       thos.hostid
FROM `hosts` AS thos
LEFT JOIN hosts_groups AS thsg
ON thos.hostid = thsg.hostid
WHERE thsg.groupid = 15
AND thos.`status` = 0) AS t1";

if(!empty($_POST["UF"]) && empty($_POST["modalidade"])){
    $uf = " '" . str_replace(" ","','",$_POST["UF"]) . "' ";
    $geral2 = $geral2 . ' where t1.UF in (' . $uf . ')';
}elseif (empty($_POST["UF"]) && !empty($_POST["modalidade"])){
    $modalidade = " '" . str_replace(" ","','",$_POST["modalidade"]) . "' ";
    $geral2 = $geral2 . ' where t1.modalidade in (' . $modalidade . ')';
}elseif (!empty($_POST["UF"]) && !empty($_POST["modalidade"])){
    $uf = " '" . str_replace(" ","','",$_POST["UF"]) . "' ";
    $modalidade = " '" . str_replace(" ","','",$_POST["modalidade"]) . "' ";
    $geral2 = $geral2 . ' where t1.modalidade in (' . $modalidade . ') and t1.UF in (' . $UF . ')';
}else{


}

$quefalhas = $connect2->prepare($geral);
$quefalhas->execute();
$val2 = $quefalhas->rowCount();
$falhas = array();
$i2 = 0;

if($val2 > 0){
while($colum = $quefalhas->fetch(PDO::FETCH_OBJ)){
        $falhas[$i2] = array($colum->hostid,$colum->falha);
        $i2++;
}
}

$stmt2 = $connect2->prepare($geral2);
$stmt2->execute();
$saida = array();
$i = 0;
while($row = $stmt2->fetch(PDO::FETCH_OBJ)){
    if($val2 > 0){
        for($x = 0;$x <= $val2-1;$x++){
            if ($row->hostid == $falhas[$x][0]) {
                $saida[$i] = array($row->UF,$row->Operadora,$row->unidade,$row->tipo,$row->modalidade,$row->hostid,$falhas[$x][1]);
            }else{
                $saida[$i] = array($row->UF,$row->Operadora,$row->unidade,$row->tipo,$row->modalidade,$row->hostid,0);    
            }
        }
    }else{
            $saida[$i] = array($row->UF,$row->Operadora,$row->unidade,$row->tipo,$row->modalidade,$row->hostid,0);    
    }
    $i++;
}


if(!empty($_POST["separa"])){
    $saida = array_sort($saida,0,SORT_ASC);
}else{
    $saida = array_sort($saida,6,SORT_DESC);
}

if(!empty($_POST["falha"])){
    $saida = array_filter2($saida,1,6);
}

$saida = agroup_array($saida);

foreach ($saida as &$value) {
    print_r($value);
    echo '<br>';
}

?>