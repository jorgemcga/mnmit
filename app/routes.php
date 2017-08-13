<?php

    $route[] = ['/', 'HomeController@index'];
    $route[] = ['/ativo/', 'AtivoController@index'];
    $route[] = ['/ativo', 'AtivoController@index'];
    $route[] = ['/ativo/editar/{id}', 'AtivoController@editar'];

    return $route;