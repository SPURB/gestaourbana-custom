<?php
// conexão com o banco de dados
require_once 'conexao.env';

if(isset($_GET["data"])){
	include 'classes/getter.php';
	$data = $_GET["data"];
	$response = new Getter($data);
	echo $response->getRoute($data);
}
else {
	$endpoints = array(
		"listar últimas atualizações das mídias do wordpress (apenas 1, 2 e 3)" => '/?data=wp-midias/:id'
	);
	echo json_encode($endpoints); 
}


?>  