<?php

    $route[] = ['/', 'HomeController@index'];

    $route[] = ['/gerenciamento', 'GerenciamentoController@index'];

    $route[] = ['/gerenciamento/ativo', 'AtivoController@index'];
    $route[] = ['/gerenciamento/ativo/visualizar/{id}', 'AtivoController@visualizar'];
    $route[] = ['/gerenciamento/ativo/adicionar', 'AtivoController@adicionar'];
    $route[] = ['/gerenciamento/ativo/salvar', 'AtivoController@salvar'];
    $route[] = ['/gerenciamento/ativo/editar/{id}', 'AtivoController@editar'];
    $route[] = ['/gerenciamento/ativo/apagar/{id}', 'AtivoController@apagar'];

    $route[] = ['/gerenciamento/categoriaativo/adicionar', 'CategoriaAtivoController@adicionar'];
    $route[] = ['/gerenciamento/categoriaativo/salvar', 'CategoriaAtivoController@salvar'];
    $route[] = ['/gerenciamento/categoriaativo/editar/{id}', 'CategoriaAtivoController@editar'];
    $route[] = ['/gerenciamento/categoriaativo/apagar/{id}', 'CategoriaAtivoController@apagar'];

    $route[] = ['/monitoramento', 'MonitoramentoController@index'];

    return $route;