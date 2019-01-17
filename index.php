<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

// varávies de ambiente
require_once 'conexao.env';

// conectar com o banco de dados
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// checar conexão
if($link === false){
    die("ERRO: Não foi possível conectar. " . mysqli_connect_error());
}

if(isset($_GET["updates"])){
	include 'classes/getter.php';
	$updates = $_GET["updates"];
	$response = new Getter($updates);
	echo $response -> getRoute($updates);
}
else {
	$endpoints = array(
		"liste últimas atualizações das mídias do wordpress" => '/?updates=:Number',
		"Exemplo. Retorna últimas três mídias" => $_SERVER['SCRIPT_URI'] . '?updates=3',
	);
	echo json_encode($endpoints); 
}
?>