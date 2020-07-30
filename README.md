# To-Do List

Este projeto foi desenvolvido como amostra das habilidades que possuo como desenvolvedor de software. A ideia desse projeto foi criar uma lista de tarefas a serem realizadas por uma pessoa, afim de auxília-la em suas tarefas do dia-a-dia ajudando à organizar os seus afazeres e deixar a sua atenção focada 100% em seus afazeres atual.

## Requistios mínimos

<div style="display: flex;">
    <span style="margin-right: 10px;">
        <img src="https://img.shields.io/static/v1?label=Bootstrap&message=4.5&labelColor=purple&color=gray&style=flat">
    </span>
    <span style="margin-right: 10px;">
        <img src="https://img.shields.io/static/v1?label=Vue.js&message=2.6&labelColor=green&color=gray&style=flat">
    </span>
    <span style="margin-right: 10px;">
        <img src="https://img.shields.io/static/v1?label=EcmaScript&message=6&labelColor=yellow&color=gray&style=flat">
    </span>
    <span style="margin-right: 10px;">
        <img src="https://img.shields.io/static/v1?label=Twig&message=3.x&labelColor=green&color=gray&style=flat">
    </span>
    <span style="margin-right: 10px;">
        <img src="https://img.shields.io/static/v1?label=PHP&message=7.2^&labelColor=blue&color=gray&style=flat">
    </span>
    <span style="margin-right: 10px;">
        <img src="https://img.shields.io/static/v1?label=Composer&message=1.8.6&labelColor=blue&color=gray&style=flat">
    </span>
    <span style="margin-right: 10px;">
        <img src="https://img.shields.io/static/v1?label=MySQL&message=5.7&labelColor=blue&color=gray&style=flat">
    </span>
</div>

## Instalação
Supondo que você já tenha todo o ambiente web já instalado e configurado em sua máquina, seguindo os passos abaixo você conseguirá implatar essa aplicação em seu ambiente local. Mas caso você não tenha instalado o ambiente web em seu computador, eu sugiro que você instale o [XAMPP](https://www.apachefriends.org/pt_br/download.html) que é um pacote de ferramentas que simula um servidor web em sua máquina local.  
  
Feito isso, é só seguir os passos abaixo.

#### Rodando a aplicação
- Baixe o código-fonte da aplicação direto do repositório do [GitHub](https://github.com/brunohmduarte/todo-list)
- Descompacte o arquivo baixado e coloque-o na pasta onde o servidor executa o projeto (Ex.: xammp/htdocs/).
- Abra o terminal prompt de comandos, navegue até a pasta da aplicação e digite o seguinte comando:  
  
  ```$ composer install ```

Com isso o projeto já estará rodando em sua máquina, porém, ainda não estará configurado completamente. Contudo, você já pode acessar em seu navegador abrindo uma nova aba e digitando:  
  
```http://localhost/todo-list-master/```
  
Para concluirmos, precisamos configurar nossa aplicação para que ela possa rodar suas rotas perfeitamente e o nosso banco de dados para que os dados que iremos inserir na aplicação, possa ser persistido em um repositório de dados.  
  
Para isso, iremos primeiro configurar **hostname** da nossa aplicação da seguinte forma:  
  
- Nos arquivos do projeto, navegue até o arquivo **Config.php** que se encontra em:  
```source/Config.php```  
- Na variável **URL_BASE**, informe o hostname da aplicação da mesma forma que o exemplo abaixo:  
```define("URL_BASE", "http://localhost/todo-list-master/");```  
- Voltando ao navegador e atualizando a página do projeto. Você verá que estilização da aplicação estará configurada perfeitamente.  
  
E por fim, agora precisamos configurar o nosso banco de dados para que os nossos registro possa ser persistido e assim toda vez que sairmos da aplicação e voltarmos, os dados estão da mesma forma a qual nós deixamos pela ultima vez.  
  
- Iremos criar nosso banco de dados executando o seguinte comando no terminal **SGBD**.  
```
  --
  -- Banco de dados: `crud`
  --
  CREATE DATABASE IF NOT EXISTS `crud` DEFAULT   CHARACTER SET utf8mb4 COLLATE   utf8mb4_general_ci;
  USE `crud`;
```  
- Agora iremos criar nossas tabela **users**, **tasks** e seus relacionamentos executantod os seguintes comandos:  
```
  --
  -- Estrutura para tabela `users`
  --
  CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `first_name` varchar(50) NOT NULL,
    `last_name` varchar(50) DEFAULT NULL,
    `genre` varchar(10) DEFAULT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  --
  -- Índices de tabela `users`
  --
  ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`);
```  
  
```
  --
  -- Estrutura para tabela `tasks`
  --
  CREATE TABLE `tasks` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `event` varchar(255) NOT NULL,
    `description` varchar(255) DEFAULT NULL,
    `initial_date_time` timestamp NOT NULL   DEFAULT current_timestamp(),
    `final_date_time` timestamp NOT NULL DEFAULT   '0000-00-00 00:00:00',
    `status` tinyint(1) NOT NULL DEFAULT 1   COMMENT '0 - Inativo e 1 - Ativo',
    `created_at` timestamp NOT NULL DEFAULT   '0000-00-00 00:00:00',
    `updated_at` timestamp NOT NULL DEFAULT   '0000-00-00 00:00:00'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;  

  --
  -- Índices de tabela `tasks`
  --
  ALTER TABLE `tasks`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_tasks_user` (`user_id`);
```

```
  --
  -- Restrições para tabelas `tasks`
  --
  ALTER TABLE `tasks`
    ADD CONSTRAINT `fk_tasks_user` FOREIGN KEY   (`user_id`) REFERENCES `users` (`id`) ON   DELETE NO ACTION ON UPDATE NO ACTION;
  COMMIT;
```
- Agora nós iremos configurando a conexão do banco de dados com a nossa aplicação.
    - Navegue até o arquivo:   
    ```source/Config.php```
    - Configure a variável **DATA_LAYER_CONFIG** da seguinte forma:  
    ```
    define("DATA_LAYER_CONFIG", [
        "driver" => "mysql",
        "host" => "localhost",
        "port" => "3306",
        "dbname" => "crud",
        "username" => "root", // Informe o seu usuário do banco de dados
        "passwd" => "", // Informe a senha do usuário
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ]);  
    ```  

## Inicializando a aplicação

Contudo já configurado e pronto para o uso, agora teremos que criar um novo usuário para podermos logar para a área administrativa e assim utilizarmos os recursos da aplicação.  
Para isso, acesse o formulário de [Cadastre-se](http://localhost/todo-list-master/signup) informando os seus dados e logo após realize o login para poder acessar o painel adminitrativo.  

Pronto, agora é só utilizar os recursos da aplicação.

## Autor
Bruno Duarte