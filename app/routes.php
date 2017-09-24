<?php

    $route[] = ['/', 'HomeController@index'];

    $route[] = ['/gerenciamento', 'GerenciamentoController@index'];

    $route[] = ['/gerenciamento/ativo', 'AtivoController@index'];
    $route[] = ['/gerenciamento/ativo/visualizar/{id}', 'AtivoController@visualizar'];
    $route[] = ['/gerenciamento/ativo/adicionar', 'AtivoController@adicionar'];
    $route[] = ['/gerenciamento/ativo/salvar', 'AtivoController@salvar'];
    $route[] = ['/gerenciamento/ativo/editar/{id}', 'AtivoController@editar'];
    $route[] = ['/gerenciamento/ativo/apagar/{id}', 'AtivoController@apagar'];

    $route[] = ['/gerenciamento/ativo/interface/todas/{id}', 'InterfaceRedeController@index'];
    $route[] = ['/gerenciamento/ativo/interface/adicionar/{id}', 'InterfaceRedeController@adicionar'];
    $route[] = ['/gerenciamento/ativo/interface/salvar', 'InterfaceRedeController@salvar'];
    $route[] = ['/gerenciamento/ativo/interface/editar/{id}', 'InterfaceRedeController@editar'];
    $route[] = ['/gerenciamento/ativo/interface/apagar/{id}/{id}', 'InterfaceRedeController@apagar'];

    $route[] = ['/gerenciamento/ativo/manutencao/todas/{id}', 'ManutencaoController@index'];
    $route[] = ['/gerenciamento/ativo/manutencao/adicionar/{id}', 'ManutencaoController@adicionar'];
    $route[] = ['/gerenciamento/ativo/manutencao/salvar', 'ManutencaoController@salvar'];
    $route[] = ['/gerenciamento/ativo/manutencao/editar/{id}', 'ManutencaoController@editar'];
//    $route[] = ['/gerenciamento/ativo/manutencao/apagar/{id}/{id}', 'ManutencaoController@apagar'];

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

    $route[] = ['/gerenciamento/licenca', 'LicencaController@index'];
    $route[] = ['/gerenciamento/licenca/adicionar', 'LicencaController@adicionar'];
    $route[] = ['/gerenciamento/licenca/salvar', 'LicencaController@salvar'];
    $route[] = ['/gerenciamento/licenca/editar/{id}', 'LicencaController@editar'];
    $route[] = ['/gerenciamento/licenca/apagar/{id}', 'LicencaController@apagar'];

    $route[] = ['/gerenciamento/categorialicenca', 'CategoriaLicencaController@index'];
    $route[] = ['/gerenciamento/categorialicenca/adicionar', 'CategoriaLicencaController@adicionar'];
    $route[] = ['/gerenciamento/categorialicenca/salvar', 'CategoriaLicencaController@salvar'];
    $route[] = ['/gerenciamento/categorialicenca/editar/{id}', 'CategoriaLicencaController@editar'];
    $route[] = ['/gerenciamento/categorialicenca/apagar/{id}', 'CategoriaLicencaController@apagar'];

    $route[] = ['/gerenciamento/usuario', 'UsuarioController@index'];
    $route[] = ['/gerenciamento/usuario/adicionar', 'UsuarioController@adicionar'];
    $route[] = ['/gerenciamento/usuario/salvar', 'UsuarioController@salvar'];
    $route[] = ['/gerenciamento/usuario/editar/{id}', 'UsuarioController@editar'];
    $route[] = ['/gerenciamento/usuario/apagar/{id}', 'UsuarioController@apagar'];
    $route[] = ['/gerenciamento/usuario/alterarsenha/{id}', 'UsuarioController@changePass'];
    $route[] = ['/gerenciamento/usuario/perfil/{id}', 'UsuarioController@perfil'];

    $route[] = ['/login', 'UsuarioController@login'];
    $route[] = ['/logout', 'UsuarioController@logout'];
    $route[] = ['/login/auth', 'UsuarioController@auth'];

    $route[] = ['/gerenciamento/grupo', 'GrupoController@index'];
    $route[] = ['/gerenciamento/grupo/adicionar', 'GrupoController@adicionar'];
    $route[] = ['/gerenciamento/grupo/salvar', 'GrupoController@salvar'];
    $route[] = ['/gerenciamento/grupo/editar/{id}', 'GrupoController@editar'];
    $route[] = ['/gerenciamento/grupo/apagar/{id}', 'GrupoController@apagar'];


$route[] = ['/monitoramento', 'MonitoramentoController@index'];

    return $route;