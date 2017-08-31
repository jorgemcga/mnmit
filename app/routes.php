<?php

    $route[] = ['/', 'HomeController@index'];

    $route[] = ['/gerenciamento', 'GerenciamentoController@index'];

    $route[] = ['/gerenciamento/ativo', 'AtivoController@index'];
    $route[] = ['/gerenciamento/ativo/visualizar/{id}', 'AtivoController@visualizar'];
    $route[] = ['/gerenciamento/ativo/adicionar', 'AtivoController@adicionar'];
    $route[] = ['/gerenciamento/ativo/salvar', 'AtivoController@salvar'];
    $route[] = ['/gerenciamento/ativo/editar/{id}', 'AtivoController@editar'];
    $route[] = ['/gerenciamento/ativo/apagar/{id}', 'AtivoController@apagar'];
    $route[] = ['/gerenciamento/ativo/interfaces/{id}', 'AtivoController@apagar'];
    $route[] = ['/gerenciamento/ativo/manutencao/{id}', 'AtivoController@apagar'];

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

    $route[] = ['/gerenciamento/modelo', 'ModeloController@index'];
    $route[] = ['/gerenciamento/modelo/adicionar', 'ModeloController@adicionar'];
    $route[] = ['/gerenciamento/modelo/salvar', 'ModeloController@salvar'];
    $route[] = ['/gerenciamento/modelo/editar/{id}', 'ModeloController@editar'];
    $route[] = ['/gerenciamento/modelo/apagar/{id}', 'ModeloController@apagar'];

    $route[] = ['/gerenciamento/fabricante', 'FabricanteController@index'];
    $route[] = ['/gerenciamento/fabricante/adicionar', 'FabricanteController@adicionar'];
    $route[] = ['/gerenciamento/fabricante/salvar', 'FabricanteController@salvar'];
    $route[] = ['/gerenciamento/fabricante/editar/{id}', 'FabricanteController@editar'];
    $route[] = ['/gerenciamento/fabricante/apagar/{id}', 'FabricanteController@apagar'];

    $route[] = ['/gerenciamento/componente', 'ComponenteController@index'];
    $route[] = ['/gerenciamento/componente/adicionar', 'ComponenteController@adicionar'];
    $route[] = ['/gerenciamento/componente/salvar', 'ComponenteController@salvar'];
    $route[] = ['/gerenciamento/componente/editar/{id}', 'ComponenteController@editar'];
    $route[] = ['/gerenciamento/componente/apagar/{id}', 'ComponenteController@apagar'];

    $route[] = ['/gerenciamento/categoriacomponente', 'CategoriaComponenteController@index'];
    $route[] = ['/gerenciamento/categoriacomponente/adicionar', 'CategoriaComponenteController@adicionar'];
    $route[] = ['/gerenciamento/categoriacomponente/salvar', 'CategoriaComponenteController@salvar'];
    $route[] = ['/gerenciamento/categoriacomponente/editar/{id}', 'CategoriaComponenteController@editar'];
    $route[] = ['/gerenciamento/categoriacomponente/apagar/{id}', 'CategoriaComponenteController@apagar'];

    $route[] = ['/gerenciamento/equipamento', 'EquipamentoController@index'];
    $route[] = ['/gerenciamento/equipamento/adicionar', 'EquipamentoController@adicionar'];
    $route[] = ['/gerenciamento/equipamento/salvar', 'EquipamentoController@salvar'];
    $route[] = ['/gerenciamento/equipamento/editar/{id}', 'EquipamentoController@editar'];
    $route[] = ['/gerenciamento/equipamento/apagar/{id}', 'EquipamentoController@apagar'];

    $route[] = ['/gerenciamento/categoriaequipamento', 'CategoriaEquipamentoController@index'];
    $route[] = ['/gerenciamento/categoriaequipamento/adicionar', 'CategoriaEquipamentoController@adicionar'];
    $route[] = ['/gerenciamento/categoriaequipamento/salvar', 'CategoriaEquipamentoController@salvar'];
    $route[] = ['/gerenciamento/categoriaequipamento/editar/{id}', 'CategoriaEquipamentoController@editar'];
    $route[] = ['/gerenciamento/categoriaequipamento/apagar/{id}', 'CategoriaEquipamentoController@apagar'];

    $route[] = ['/monitoramento', 'MonitoramentoController@index'];

    return $route;