<?PHP
//error_reporting(E_ERROR | E_PARSE);



$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

$geral = "select ll.UF, ll.unidade as metric, 
if(AVG(ll.ONLINE) = 0 AND avg(ll.degra) = 0,3,if(AVG(ll.ONLINE) = 0 AND avg(ll.degra) = 1,3,if(AVG(ll.ONLINE) = 0 AND avg(ll.degra) > 0 AND avg(ll.degra) < 1,3,if(AVG(ll.ONLINE) = 1 AND avg(ll.degra) = 0,0,if(AVG(ll.ONLINE) = 1 AND avg(ll.degra) = 1,1,if(AVG(ll.ONLINE) = 1 AND avg(ll.degra) > 0 AND avg(ll.degra) < 1,1,if(AVG(ll.degra) = 0 AND avg(ll.ONLINE) > 0 AND avg(ll.ONLINE) < 1,2,if(AVG(ll.degra) = 1 AND avg(ll.ONLINE) > 0 AND avg(ll.ONLINE) < 1,2,if(avg(ll.degra) > 0 AND avg(ll.degra) < 1 AND avg(ll.ONLINE) > 0 AND avg(ll.ONLINE) < 1,2,3))))))))) AS value 
FROM (SELECT hh.*, if(hh.falha=1,0,1) AS ONLINE, 
if(hh.falha=2,1,0) AS degra 
FROM (SELECT dfd1.*, sum(if(dfd2.name = 'Perda de Pacote' OR dfd2.name = 'Tempo de resposta de ping ICMP alto',2,if(dfd2.name = 'ICMP Ping Indisponível',1,0))) AS falha 
FROM (SELECT AT1.*, AT2.itemid FROM (SELECT hb.*
FROM (
            SELECT HOST,
            LEFT(HOST,2) AS UF,
            SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',2),'_',-1) AS Operadora, 
            SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1) AS unidade, 
            SUBSTRING_INDEX(HOST,'_',-1) as tipo, 
            if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),3) = 'HS.' , 'hospital', if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),3) = 'VI.' , 'vidaeimagem', if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),7) = 'HAPCLI.' , 'hapclinica', if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),3) = 'PA.' , 'prontoatendimento', if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),3) = 'CD.' , 'centrodedistribuicao', if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),8) = 'MEDPREV.' , 'medprev', if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),4) = 'LAB.' , 'laboratorio', if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),4) = 'ADM.' , 'administrativo', if( LEFT( SUBSTRING_INDEX(SUBSTRING_INDEX(HOST,'_',-2),'_',1),4) = 'AMB.' , 'ambulatorio', 'outros' ) ) ) ) ) ) ) ) )   as modalidade, 
            hostid 
            FROM hosts WHERE STATUS = 0 ) AS hb 
LEFT JOIN hosts_groups AS idgr 
ON hb.hostid = idgr.hostid 
WHERE idgr.groupid = 15) AS AT1 
LEFT JOIN items AS AT2 ON AT1.hostid = AT2.hostid) AS dfd1 
LEFT JOIN (SELECT gn2.itemid, gn1.name from (SELECT a1.* FROM events AS a1 LEFT JOIN event_recovery AS a2 ON a1.eventid = a2.eventid WHERE a2.r_eventid IS NULL AND a1.value = 1) AS gn1 LEFT JOIN functions AS gn2 ON gn1.objectid = gn2.triggerid WHERE gn2.itemid IS NOT NULL) AS dfd2
ON dfd1.itemid = dfd2.itemid
GROUP BY dfd1.host) AS hh) AS ll";

if(!empty($_POST["UF"]) && empty($_POST["modalidade"])){
     
    $uf = " '" . str_replace(" ","','",$_POST["UF"]) . "' ";
    
    $sql2 = $geral . "
    where ll.uf in (" . $uf . ")
    GROUP BY ll.unidade";

}elseif (empty($_POST["UF"]) && !empty($_POST["modalidade"])){

    $modalidade = " '" . str_replace(" ","','",$_POST["modalidade"]) . "' ";
    
    $sql2 = $geral . "
    where ll.modalidade in (" . $modalidade . ")
    GROUP BY ll.unidade";

}elseif (!empty($_POST["UF"]) && !empty($_POST["modalidade"])){

    $uf = " '" . str_replace(" ","','",$_POST["UF"]) . "' ";
    $modalidade = " '" . str_replace(" ","','",$_POST["modalidade"]) . "' ";
    
    $sql2 = $geral . "
    where ll.uf in (" . $uf . ")
    and ll.modalidade in (" . $modalidade . ")
    GROUP BY ll.unidade";

}else{

    $sql2 = $geral . "
    GROUP BY ll.unidade";

}

if(!empty($_POST["separa"])){
    $sql2 = $sql2 . "
    ORDER BY ll.UF ASC, VALUE desc";
}else{
    $sql2 = $sql2 . "
    ORDER BY VALUE desc";
}

if(!empty($_POST["falha"])){
    $sql2 = 'SELECT i.* FROM (' . $sql2 . ') AS i WHERE i.VALUE != 0';
}

                $stmt2 = $connect2->prepare($sql2);
                $result2 = $stmt2->execute();
                $val = $stmt2->rowCount();
                $ds = "";
                echo '<div class="lista">';

                if($val > 0){
                    while($row = $stmt2->fetch(PDO::FETCH_OBJ)){
                        
                        if(!empty($_POST["separa"])){
                            if ($ds <> $row->UF) {
                                $ds = $row->UF;
                                echo '</div><h2><span  class="line-center">' . $row->UF . '</span></h2><div class="lista">';
                            }
                        }
                        

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