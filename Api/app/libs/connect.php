<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

function getConnection(){
	try {
		$db_username = "root";
		$db_password = "DXGqgh56840";
		$connection = new PDO("mysql:host=172.18.3.251; dbname=NewEco", $db_username, $db_password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}

	return $connection;
}
