<?php
    /*
     * Todas as rotas do sistema devem ser declaradas aqui para existirem
     * a rota é um array composto de [0] => url, [1] => 'Controler@action', [2] => 'protect'
     * sendo o protect 1 = Sim e 0 = Não
     */

    $route[] = ['/', 'HomeController@index', '1'];
    $route[] = ['/dashboard', 'HomeController@dashboard', '1'];

    $route[] = ['/gerenciamento', 'GerenciamentoController@index', '1'];

    $route[] = ['/gerenciamento/ativo', 'AtivoController@index', '1'];
    $route[] = ['/gerenciamento/ativo/visualizar/{id}', 'AtivoController@visualizar', '1'];
    $route[] = ['/gerenciamento/ativo/adicionar', 'AtivoController@adicionar', '1'];
    $route[] = ['/gerenciamento/ativo/salvar', 'AtivoController@salvar', '1'];
    $route[] = ['/gerenciamento/ativo/editar/{id}', 'AtivoController@editar', '1'];
    $route[] = ['/gerenciamento/ativo/apagar/{id}', 'AtivoController@apagar', '1'];

    $route[] = ['/gerenciamento/ativo/interface/todas/{id}', 'InterfaceRedeController@index', '1'];
    $route[] = ['/gerenciamento/ativo/interface/adicionar/{id}', 'InterfaceRedeController@adicionar', '1'];
    $route[] = ['/gerenciamento/ativo/interface/salvar', 'InterfaceRedeController@salvar', '1'];
    $route[] = ['/gerenciamento/ativo/interface/editar/{id}', 'InterfaceRedeController@editar', '1'];
    $route[] = ['/gerenciamento/ativo/interface/apagar/{id}/{id}', 'InterfaceRedeController@apagar', '1'];

    $route[] = ['/gerenciamento/ativo/manutencao/todas/{id}', 'ManutencaoController@index', '1'];
    $route[] = ['/gerenciamento/ativo/manutencao/adicionar/{id}', 'ManutencaoController@adicionar', '1'];
    $route[] = ['/gerenciamento/ativo/manutencao/salvar', 'ManutencaoController@salvar', '1'];
    $route[] = ['/gerenciamento/ativo/manutencao/editar/{id}', 'ManutencaoController@editar', '1'];
    $route[] = ['/gerenciamento/ativo/manutencao/apagar/{id}/{id}', 'ManutencaoController@apagar'];

    $route[] = ['/gerenciamento/categoriaativo', 'CategoriaAtivoController@index', '1'];
    $route[] = ['/gerenciamento/categoriaativo/adicionar', 'CategoriaAtivoController@adicionar', '1'];
    $route[] = ['/gerenciamento/categoriaativo/salvar', 'CategoriaAtivoController@salvar', '1'];
    $route[] = ['/gerenciamento/categoriaativo/editar/{id}', 'CategoriaAtivoController@editar', '1'];
    $route[] = ['/gerenciamento/categoriaativo/apagar/{id}', 'CategoriaAtivoController@apagar', '1'];
    $route[] = ['/gerenciamento/categoriaativo/notificacao/{id}', 'CategoriaAtivoController@notificacao', '1'];
    $route[] = ['/gerenciamento/categoriaativo/notificar', 'CategoriaAtivoController@notificar', '1'];
    $route[] = ['/gerenciamento/categoriaativo/naonotificar/{id}/{id}', 'CategoriaAtivoController@naoNotificar', '1'];

    $route[] = ['/gerenciamento/sistemaoperacional', 'SistemaOperacionalController@index', '1'];
    $route[] = ['/gerenciamento/sistemaoperacional/adicionar', 'SistemaOperacionalController@adicionar', '1'];
    $route[] = ['/gerenciamento/sistemaoperacional/salvar', 'SistemaOperacionalController@salvar', '1'];
    $route[] = ['/gerenciamento/sistemaoperacional/editar/{id}', 'SistemaOperacionalController@editar', '1'];
    $route[] = ['/gerenciamento/sistemaoperacional/apagar/{id}', 'SistemaOperacionalController@apagar', '1'];

    $route[] = ['/gerenciamento/modelo', 'ModeloController@index', '1'];
    $route[] = ['/gerenciamento/modelo/adicionar', 'ModeloController@adicionar', '1'];
    $route[] = ['/gerenciamento/modelo/salvar', 'ModeloController@salvar', '1'];
    $route[] = ['/gerenciamento/modelo/editar/{id}', 'ModeloController@editar', '1'];
    $route[] = ['/gerenciamento/modelo/apagar/{id}', 'ModeloController@apagar', '1'];

    $route[] = ['/gerenciamento/fabricante', 'FabricanteController@index', '1'];
    $route[] = ['/gerenciamento/fabricante/adicionar', 'FabricanteController@adicionar', '1'];
    $route[] = ['/gerenciamento/fabricante/salvar', 'FabricanteController@salvar', '1'];
    $route[] = ['/gerenciamento/fabricante/editar/{id}', 'FabricanteController@editar', '1'];
    $route[] = ['/gerenciamento/fabricante/apagar/{id}', 'FabricanteController@apagar', '1'];

    $route[] = ['/gerenciamento/componente', 'ComponenteController@index', '1'];
    $route[] = ['/gerenciamento/componente/adicionar', 'ComponenteController@adicionar', '1'];
    $route[] = ['/gerenciamento/componente/salvar', 'ComponenteController@salvar', '1'];
    $route[] = ['/gerenciamento/componente/editar/{id}', 'ComponenteController@editar', '1'];
    $route[] = ['/gerenciamento/componente/apagar/{id}', 'ComponenteController@apagar', '1'];

    $route[] = ['/gerenciamento/categoriacomponente', 'CategoriaComponenteController@index', '1'];
    $route[] = ['/gerenciamento/categoriacomponente/adicionar', 'CategoriaComponenteController@adicionar', '1'];
    $route[] = ['/gerenciamento/categoriacomponente/salvar', 'CategoriaComponenteController@salvar', '1'];
    $route[] = ['/gerenciamento/categoriacomponente/editar/{id}', 'CategoriaComponenteController@editar', '1'];
    $route[] = ['/gerenciamento/categoriacomponente/apagar/{id}', 'CategoriaComponenteController@apagar', '1'];

    $route[] = ['/gerenciamento/equipamento', 'EquipamentoController@index', '1'];
    $route[] = ['/gerenciamento/equipamento/adicionar', 'EquipamentoController@adicionar', '1'];
    $route[] = ['/gerenciamento/equipamento/salvar', 'EquipamentoController@salvar', '1'];
    $route[] = ['/gerenciamento/equipamento/editar/{id}', 'EquipamentoController@editar', '1'];
    $route[] = ['/gerenciamento/equipamento/apagar/{id}', 'EquipamentoController@apagar', '1'];

    $route[] = ['/gerenciamento/categoriaequipamento', 'CategoriaEquipamentoController@index', '1'];
    $route[] = ['/gerenciamento/categoriaequipamento/adicionar', 'CategoriaEquipamentoController@adicionar', '1'];
    $route[] = ['/gerenciamento/categoriaequipamento/salvar', 'CategoriaEquipamentoController@salvar', '1'];
    $route[] = ['/gerenciamento/categoriaequipamento/editar/{id}', 'CategoriaEquipamentoController@editar', '1'];
    $route[] = ['/gerenciamento/categoriaequipamento/apagar/{id}', 'CategoriaEquipamentoController@apagar', '1'];

    $route[] = ['/gerenciamento/licenca', 'LicencaController@index', '1'];
    $route[] = ['/gerenciamento/licenca/adicionar', 'LicencaController@adicionar', '1'];
    $route[] = ['/gerenciamento/licenca/salvar', 'LicencaController@salvar', '1'];
    $route[] = ['/gerenciamento/licenca/editar/{id}', 'LicencaController@editar', '1'];
    $route[] = ['/gerenciamento/licenca/apagar/{id}', 'LicencaController@apagar', '1'];

    $route[] = ['/gerenciamento/categorialicenca', 'CategoriaLicencaController@index', '1'];
    $route[] = ['/gerenciamento/categorialicenca/adicionar', 'CategoriaLicencaController@adicionar', '1'];
    $route[] = ['/gerenciamento/categorialicenca/salvar', 'CategoriaLicencaController@salvar', '1'];
    $route[] = ['/gerenciamento/categorialicenca/editar/{id}', 'CategoriaLicencaController@editar', '1'];
    $route[] = ['/gerenciamento/categorialicenca/apagar/{id}', 'CategoriaLicencaController@apagar', '1'];

    $route[] = ['/gerenciamento/usuario', 'UsuarioController@index', '1'];
    $route[] = ['/gerenciamento/usuario/adicionar', 'UsuarioController@adicionar', '1'];
    $route[] = ['/gerenciamento/usuario/salvar', 'UsuarioController@salvar', '1'];
    $route[] = ['/gerenciamento/usuario/editar/{id}', 'UsuarioController@editar', '1'];
    $route[] = ['/gerenciamento/usuario/apagar/{id}', 'UsuarioController@apagar', '1'];
    $route[] = ['/gerenciamento/usuario/alterarsenha/{id}', 'UsuarioController@changePass', '1'];
    $route[] = ['/gerenciamento/usuario/perfil/{id}', 'UsuarioController@perfil', '1'];

    $route[] = ['/login', 'UsuarioController@login', '0'];
    $route[] = ['/logout', 'UsuarioController@logout', '0'];
    $route[] = ['/login/auth', 'UsuarioController@auth', '0'];

    $route[] = ['/gerenciamento/grupo', 'GrupoController@index', '1'];
    $route[] = ['/gerenciamento/grupo/adicionar', 'GrupoController@adicionar', '1'];
    $route[] = ['/gerenciamento/grupo/salvar', 'GrupoController@salvar', '1'];
    $route[] = ['/gerenciamento/grupo/editar/{id}', 'GrupoController@editar', '1'];
    $route[] = ['/gerenciamento/grupo/apagar/{id}', 'GrupoController@apagar', '1'];
    $route[] = ['/gerenciamento/grupo/participantes/{id}', 'GrupoController@participantes', '1'];
    $route[] = ['/gerenciamento/grupo/participante/adicionar', 'GrupoController@adicionarParticipante', '1'];
    $route[] = ['/gerenciamento/grupo/participante/remover/{id}/{id}', 'GrupoController@removerParticipante', '1'];


    $route[] = ['/monitoramento', 'MonitoramentoController@index', '0'];
    $route[] = ['/monitoramento/servidor', 'MonitoramentoController@servidor', '1'];
    $route[] = ['/monitoramento/servidor/config/{$id}', 'MonitoramentoController@config', '1'];
    $route[] = ['/monitoramento/servidor/salvar', 'MonitoramentoController@salvar', '1'];
    $route[] = ['/monitoramento/novo', 'MonitoramentoController@novo', '1'];
    $route[] = ['/monitoramento/start/{id}', 'MonitoramentoController@start', '1'];
    $route[] = ['/monitoramento/stop/{id}', 'MonitoramentoController@stop', '1'];

    $route[] = ['/monitoramento/internet', 'InternetController@index', '1'];
    $route[] = ['/monitoramento/internet/config', 'InternetController@config', '1'];
    $route[] = ['/monitoramento/internet/salvar', 'InternetController@salvar', '1'];
    $route[] = ['/monitoramento/internet/start/{id}', 'InternetController@start', '1'];
    $route[] = ['/monitoramento/internet/stop/{id}', 'InternetController@stop', '1'];
    $route[] = ['/monitoramento/internet/run', 'InternetController@run', '1'];

    $route[] = ['/monitoramento/icmp', 'PingController@index', '1'];
    $route[] = ['/monitoramento/icmp/config', 'PingController@config', '1'];
    $route[] = ['/monitoramento/icmp/salvar/{id}', 'PingController@salvar', '1'];
    $route[] = ['/monitoramento/icmp/start/{id}', 'PingController@start', '1'];
    $route[] = ['/monitoramento/icmp/stop/{id}', 'PingController@stop', '1'];
    $route[] = ['/monitoramento/icmp/run', 'PingController@run', '1'];

    $route[] = ['/monitoramento/http', 'HttpController@index', '1'];
    $route[] = ['/monitoramento/http/config', 'HttpController@config', '1'];
    $route[] = ['/monitoramento/http/salvar', 'HttpController@salvar', '1'];
    $route[] = ['/monitoramento/http/start/{id}', 'HttpController@start', '1'];
    $route[] = ['/monitoramento/http/stop/{id}', 'HttpController@stop', '1'];
    $route[] = ['/monitoramento/http/run', 'HttpController@run', '1'];

    $route[] = ['/monitoramento/site', 'SiteController@index', '1'];
    $route[] = ['/monitoramento/site/adicionar', 'SiteController@adicionar', '1'];
    $route[] = ['/monitoramento/site/salvar', 'SiteController@salvar', '1'];
    $route[] = ['/monitoramento/site/editar/{id}', 'SiteController@editar', '1'];
    $route[] = ['/monitoramento/site/apagar/{id}', 'SiteController@apagar', '1'];

    $route[] = ['/monitoramento/snmp', 'SnmpController@index', '1'];
    $route[] = ['/monitoramento/snmp/config', 'SnmpController@config', '1'];
    $route[] = ['/monitoramento/snmp/salvar', 'SnmpController@salvar', '1'];
    $route[] = ['/monitoramento/snmp/run', 'SnmpController@run', '1'];
    $route[] = ['/monitoramento/snmp/start/{id}', 'SnmpController@start', '1'];
    $route[] = ['/monitoramento/snmp/stop/{id}', 'SnmpController@stop', '1'];
    $route[] = ['/monitoramento/snmp/run', 'SnmpController@run', '1'];

    $route[] = ['/monitoramento/oid', 'OidController@index', '1'];
    $route[] = ['/monitoramento/oid/adicionar', 'OidController@adicionar', '1'];
    $route[] = ['/monitoramento/oid/salvar', 'OidController@salvar', '1'];
    $route[] = ['/monitoramento/oid/editar/{id}', 'OidController@editar', '1'];
    $route[] = ['/monitoramento/oid/apagar/{id}', 'OidController@apagar', '1'];

    $route[] = ['/monitoramento/oid-ativo', 'OidAtivoController@index', '1'];
    $route[] = ['/monitoramento/oid-ativo/salvar', 'OidAtivoController@salvar', '1'];
    $route[] = ['/monitoramento/oid-ativo/apagar/{id}/{id}', 'OidAtivoController@apagar', '1'];

    return $route;