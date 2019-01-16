# MySQL to JSON
Backend da API do Plugi de Indexação do Gestão Urbana

Criar arquivo de configuração das variáveis de ambiente chamado "conexao.env" com a seguinte estrutura:

<?php
// conexão com o banco de dados
define('DB_SERVER', 'servidor');
define('DB_USERNAME', 'nome_do_usuario');
define('DB_PASSWORD', 'senha');
define('DB_NAME', 'nome_do_banco_de_dados');
 
// conectar com o banco de dados
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// checar conexão
if($link === false){
    die("ERRO: Não foi possível conectar. " . mysqli_connect_error());
}
?>