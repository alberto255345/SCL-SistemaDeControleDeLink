<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);

$return_arr = array();

if(isset($_POST['separada']) && !empty($_POST['separada'])){

if($_POST['separada'] == "group" ){
$sql = $connect2->prepare('
SELECT GROUP1.name, GROUP2.hostid FROM (SELECT ev.objectid, ev.name FROM events AS ev LEFT JOIN event_recovery AS er ON ev.eventid = er.eventid WHERE ev.value = 1 AND er.r_eventid IS NULL) AS GROUP1
LEFT JOIN 
(SELECT it.hostid, fu.triggerid FROM items AS it LEFT JOIN `functions` AS fu ON it.itemid = fu.itemid WHERE fu.triggerid IS NOT NULL) AS GROUP2
ON GROUP1.objectid = GROUP2.triggerid
WHERE GROUP2.hostid IS NOT null;
');

$sql->execute();
while ($row = $sql->fetch()) {
    $return_arr[] = $row;
} 

echo json_encode($return_arr);

}elseif($_POST['separada'] == "hostid" ) {
$sql = $connect2->prepare('
SELECT ho.name, ho.hostid  FROM hosts AS ho LEFT JOIN hosts_groups AS hg ON ho.hostid = hg.hostid WHERE hg.groupid = 15 AND ho.`status` = 0;
');

$sql->execute();
while ($row = $sql->fetch()) {
    $return_arr[] = $row;
} 

echo json_encode($return_arr);
}
}

?>