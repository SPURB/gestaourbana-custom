<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
include 'classes/getters.php';
require_once 'conexao.env';

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if ($link === false){
	die("ERRO: Não foi possível conectar. " . mysqli_connect_error());
}

if (isset($_GET["media-updates"])){
	$updates = $_GET["media-updates"];
	$response = new Getters($updates);
	echo $response -> getMediaPosts($updates);
}

else if(isset($_GET["noticia-comments"])){
	$noticia = $_GET["noticia-comments"];
	$response = new Getters($updates);
	echo $response -> getCommentsFromNoticia($noticia);
}

else {
	$documentation = array(
		"Descrição" => "Endpoints customizados do banco de dados do portal Gestão Urbana",
		"Repositório" => "https://github.com/spurb/gestaourbana-custom",
		"Bugs" => "https://github.com/spurb/gestaourbana-custom/issues",
		"Enpoints" => array(
			array(
				"Descrição" => "Lista das últimas atualizações das mídias do wordpress",
				"Sintaxe" => '/?media-updates=:Number',
				"Exemplo. Retorna últimas três mídias postadas" => $_SERVER['SCRIPT_URI'] . '?media-updates=3'
			),
			array(
				"Descrição" => "Lista de comentários por notícias ou posts",
				"Sintaxe" => '/?noticia-comments=:id',
				"Exemplo. Retorna comentários da notícia ou post de id 919" => $_SERVER['SCRIPT_URI'] . '?noticia-comments=919',
			)
		)
	);
	echo json_encode($documentation); 
}
mysqli_close($link);
?>