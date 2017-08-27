<?php

    $route[] = ['/', 'HomeController@index'];

    $route[] = ['/gerenciamento', 'GerenciamentoController@index'];

    $route[] = ['/gerenciamento/ativo', 'AtivoController@index'];
    $route[] = ['/gerenciamento/ativo/visualizar/{id}', 'AtivoController@visualizar'];
    $route[] = ['/gerenciamento/ativo/adicionar', 'AtivoController@adicionar'];
    $route[] = ['/gerenciamento/ativo/salvar', 'AtivoController@salvar'];
    $route[] = ['/gerenciamento/ativo/editar/{id}', 'AtivoController@editar'];
    $route[] = ['/gerenciamento/ativo/apagar/{id}', 'AtivoController@apagar'];

    $route[] = ['/gerenciamento/categoriaativo', 'CategoriaAtivoController@index'];
    $route[] = ['/gerenciamento/categoriaativo/adicionar', 'CategoriaAtivoController@adicionar'];
    $route[] = ['/gerenciamento/categoriaativo/salvar', 'CategoriaAtivoController@salvar'];
    $route[] = ['/gerenciamento/categoriaativo/editar/{id}', 'CategoriaAtivoController@editar'];
    $route[] = ['/gerenciamento/categoriaativo/apagar/{id}', 'CategoriaAtivoController@apagar'];

    $route[] = ['/gerenciamento/sistemaoperacional', 'SistemaOperacionalController@index'];
    $route[] = ['/gerenciamento/sistemaoperacional/adicionar', 'SistemaOperacionalController@adicionar'];
    $route[] = ['/gerenciamento/sistemaoperacional/salvar', 'SistemaOperacionalController@salvar'];
    $route[] = ['/gerenciamento/sistemaoperacional/editar/{id}', 'SistemaOperacionalController@editar'];
    $route[] = ['/gerenciamento/sistemaoperacional/apagar/{id}', 'SistemaOperacionalController@apagar'];

    $route[] = ['/monitoramento', 'MonitoramentoController@index'];

    return $route;