<?php
if(!isset($_SESSION))
session_start();

// Define database
define('db_hostname', '127.0.0.1');

	define('db_username', 'alberto');
	define('db_password', '123456');

		define('db_database', 'inventario');
		define('db_database2', 'zabbix');
		define('db_database3', 'db_zabbix');

// Connecting database
try {
	$connect = new PDO("mysql:host=".db_hostname."; dbname=".db_database, db_username, db_password);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

try {
	$connect2 = new PDO("mysql:host=".db_hostname."; dbname=".db_database2, db_username, db_password);
	$connect2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

try {
	$connect3 = new PDO("mysql:host=".db_hostname."; dbname=".db_database3, db_username, db_password);
	$connect3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}


?>
