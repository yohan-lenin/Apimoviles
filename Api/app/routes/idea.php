<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");
//var_dump($app);
//metodos PAra idea
$app->get("/idea/", function() use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM idea");
		$dbh->execute();
		$idea = $dbh->fetchAll(PDO::FETCH_OBJ);
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($idea));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->get("/idea/:id", function($id) use($app){

	try {
		
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM idea WHERE idIdea LIKE '$id'");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$idea = $dbh->fetchObject();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($idea));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->post("/addI/", function() use($app){
	
	$titulo = $app->request->post("titulo");
	$cuerpo = $app->request->post("cuerpo");
	$referencia = $app->request->post("referencia");
	$contacto = $app->request->post("contacto");
	$nombre = $app->request->post("nombre");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO idea (titulo,cuerpo,referencia,contacto,nombre)VALUES(:titulo,:cuerpo,:referencia,:contacto,:nombre)");
		$dbh->bindParam("titulo", $titulo);
		$dbh->bindParam("cuerpo", $cuerpo);
		$dbh->bindParam("referencia", $referencia);
		$dbh->bindParam("contacto", $contacto);
		$dbh->bindParam("nombre", $nombre);


		$dbh->execute();
		$ideaAdd = $connection->lastInsertId();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($ideaAdd));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->put("/putIdea/", function() use($app){
	
	$titulo = $app->request->put("titulo");
	$cuerpo = $app->request->put("cuerpo");
	$referencia = $app->request->put("referencia");
	$contacto = $app->request->put("contacto");
	$nombre = $app->request->put("nombre");
	$idIdea = $app->request->put("idIdea");

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE idea SET titulo = ?, cuerpo = ?, referencia = ?, contacto = ?, nombre = ?  WHERE idIdea = ?");
		
		$dbh->bindParam(1, $titulo);
		$dbh->bindParam(2, $cuerpo);
		$dbh->bindParam(3, $referencia);
		$dbh->bindParam(4, $contacto);
		$dbh->bindParam(5, $nombre);
		$dbh->bindParam(6, $idIdea);
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->delete("/idead/:id", function($id) use($app){
	
	try {
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM idea WHERE idIdea = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});



