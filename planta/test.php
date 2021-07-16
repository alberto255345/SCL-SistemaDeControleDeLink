<?PHP

$postData = array(
    'jsonrpc' => '2.0',
    'method' => 'user.login',
    'params' => array(
        'user' => 'alberto',
        'password' => 'facu94Hap'
    ),
    'id' => 1,
    'auth' => null
);


$json = json_encode($postData);


$ch = curl_init('http://10.5.90.139/zabbix/api_jsonrpc.php');

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(

    'Content-Type: application/json',

    'Content-Length: ' . strlen($json))

);

$jsonRet = json_decode(curl_exec($ch),1);

// print_r($jsonRet);

// echo '<br> <br>';

$postData = array(
    'jsonrpc' => '2.0',
    'method' => 'host.create',
    'params' => array(
        'host' => 'TESTE',
        'interfaces' => array(
            'type' => 1,
            'main' => 1,
            'useip' => 1,
            'ip' => '192.168.20.2',
            'dns' => '',
            'port' => '10050'
        ),
        'groups' => array(
            'groupid' => 15,
            'groupid' => 33,
            'groupid' => 42
        ),
        'templates' => array(
            'templateid' => 10374
        ),
        'inventory_mode' => 0,
        'inventory' => array(
            'serialno_a' => '15',
            'serialno_b' => '15',
            'location' => '15'
        )
    ),
    'id' => 1,
    'auth' => $jsonRet['result']
);


$json = json_encode($postData);

echo $json . '<br>';

$ch = curl_init('http://10.5.90.139/zabbix/api_jsonrpc.php');

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(

    'Content-Type: application/json',

    'Content-Length: ' . strlen($json))

);

$jsonRet = json_decode(curl_exec($ch));

// print_r($jsonRet);

?>