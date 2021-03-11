<?PHP
//error_reporting(E_ERROR | E_PARSE);


$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

$geral = "SELECT GROUP1.name, GROUP2.hostid FROM (SELECT ev.objectid, ev.name FROM events AS ev LEFT JOIN event_recovery AS er ON ev.eventid = er.eventid WHERE ev.value = 1 AND er.r_eventid IS NULL) AS GROUP1
LEFT JOIN 
(SELECT it.hostid, fu.triggerid FROM items AS it LEFT JOIN `functions` AS fu ON it.itemid = fu.itemid WHERE fu.triggerid IS NOT NULL) AS GROUP2
ON GROUP1.objectid = GROUP2.triggerid
WHERE GROUP2.hostid IS NOT null;";

$geral2 = "SELECT ho.name, ho.hostid  FROM hosts AS ho LEFT JOIN hosts_groups AS hg ON ho.hostid = hg.hostid WHERE hg.groupid = 15 AND ho.`status` = 0;";


                $stmt2 = $connect2->prepare($geral);
                $stmt2->execute();
                $val = $stmt2->rowCount();
                $ds = array();

                $stmt3 = $connect2->prepare($geral2);
                $stmt3->execute();
                $val2 = $stmt3->rowCount();
                $ds2 = array();

                echo '<div class="lista">';

                if($val > 0){
                    $i = 0;
                    while($row = $stmt2->fetch(PDO::FETCH_OBJ)){
                    
                        $ds[$i] = array( 'id' => $row->hostid, 'falha' => $row->name);
                        $i = $i + 1;
                    }
                }

                if($val2 > 0){
                    $i = 0;
                    while($row = $stmt3->fetch(PDO::FETCH_OBJ)){
                    
                        $ds2[$i] = array( 'id' => $row->hostid, 'falha' => $row->name);
                        $i = $i + 1;
                    }
                }
                function juntar($n, $m)
                {
                    if($n[id] == $m[id]){
                        return $m;
                    }
                    return "O número $n é chamado de $m na Espanha";
                }
                
                $c = array_map("juntar", $ds2, $ds);
                print_r($c);

                echo '</div>';

?>