# wp mídia updates
Lista os últimos updates de mídias em um banco genérico do wordpress. 

## Setup
Renomear o arquivo `conexao.env.sample` para `conexao.env` e inclua os campos da lista para realizar a conexão com o banco:

```php
<?php
// conexão com o banco de dados
define('DB_SERVER', 'servidor');
define('DB_USERNAME', 'nome_do_usuario');
define('DB_PASSWORD', 'senha');
define('DB_NAME', 'nome_do_banco_de_dados');

```
