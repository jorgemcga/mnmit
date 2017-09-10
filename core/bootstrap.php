<?php

    //Iniciando Sessão
    if (!session_id()) session_start();

    //Obtendo Rotas
    $routes = require_once __DIR__ . '/../app/routes.php';
    $route = new \Core\Route($routes);
