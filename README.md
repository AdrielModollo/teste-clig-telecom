# Livraria
Aplicação em PHP 7.4

Esta aplicação foi escrita utilizando o padrão MVC (Model, View e Controller), onde a camada model fica responsável pelo acesso ao banco de dados, a camada view fica responsável pelo html e o controller faz a comunicação entre os dados e o html.

### Como baixar o projeto
Para baixar o projeto acesse o seguinte repositório e clone o projeto na pasta htdocs do XAMPP: 
[https://github.com/AdrielModollo/teste-clig-telecom](https://github.com/AdrielModollo/teste-clig-telecom) 
```
git clone https://github.com/AdrielModollo/teste-clig-telecom.git
```

### Como configurar o acesso ao banco de dados
As configurações de acesso ao banco de dados ficam no arquivo config.php, localizado na raiz da aplicação.
Para alterar a url base da aplicação altere a constante BASE_URL, por padrão a url base é http://localhost/livraria/
Para alterar o nome do banco de dados altere a variável $config['database_name']
Para alterar o usuário do banco de dados altere a variável $config['database_user']
Para alterar a senha do banco de dados altere a variável $config['database_password']

```php
if(ENVIRONMENT == 'development') {
    define('BASE_URL', 'http://localhost/livraria/');
    $config['database_name'] = 'livraria';
    $config['host'] = 'localhost';
    $config['database_user'] = 'root';
    $config['database_password'] = '';
} else {
    define('BASE_URL', 'http://mywebsite.com');
    $config['database_name'] = 'mvc_boilerplate_php';
    $config['host'] = 'localhost';
    $config['database_user'] = 'root';
    $config['database_password'] = '';
}
```

### Script para criar as tabelas do banco e os dados iniciais
Copie todo o conteúdo do arquivo database.sql localizado na raiz da aplicação e execute no mysql

```sql
CREATE DATABASE livraria;

USE livraria;
```