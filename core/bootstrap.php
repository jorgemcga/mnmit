<?php

    //Iniciando Sessão
    if (!session_id()) session_start();

    setlocale(LC_MONETARY, 'pt_BR.UTF-8');

    //Obtendo a configs
    require_once __DIR__ . '/../app/config/config.php';
    require_once __DIR__ . '/../app/config/config_monitor.php';
    
    //Obtendo Rotas
    $routes = require_once __DIR__ . '/../app/routes.php';
    $route = new \Core\Route($routes);
