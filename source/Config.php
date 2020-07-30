<?php

// Define o fuso horário padrão de usado para todas as funções de data/hora da aplicação.
date_default_timezone_set('America/Sao_Paulo');

// Configuração da hostname padrão da aplicação.
define("URL_BASE", "");

// Configuração da conexão com o banco de dados.
define("DATA_LAYER_CONFIG", [
    "driver" => "",
    "host" => "",
    "port" => "",
    "dbname" => "",
    "username" => "",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
