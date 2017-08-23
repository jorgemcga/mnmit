<?php

    $route[] = ['/', 'HomeController@index'];

    $route[] = ['/gerenciamento', 'GerenciamentoController@index'];

    $route[] = ['/gerenciamento/ativo', 'AtivoController@index'];
    $route[] = ['/gerenciamento/ativo/visualizar/{id}', 'AtivoController@visualizar'];
    $route[] = ['/gerenciamento/ativo/adicionar', 'AtivoController@adicionar'];
    $route[] = ['/gerenciamento/ativo/salvar', 'AtivoController@salvar'];

    $route[] = ['/gerenciamento/ativo/editar/{id}', 'AtivoController@editar'];

    $route[] = ['/monitoramento', 'MonitoramentoController@index'];

    return $route;