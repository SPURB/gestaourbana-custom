# MySQL to JSON
Backend da API do Plugi de Indexa��o do Gest�o Urbana

Criar arquivo de configura��o das vari�veis de ambiente chamado "conexao.env" com a seguinte estrutura:

<?php
// conex�o com o banco de dados
define('DB_SERVER', 'servidor');
define('DB_USERNAME', 'nome_do_usuario');
define('DB_PASSWORD', 'senha');
define('DB_NAME', 'nome_do_banco_de_dados');
 
// conectar com o banco de dados
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// checar conex�o
if($link === false){
    die("ERRO: N�o foi poss�vel conectar. " . mysqli_connect_error());
}
?>