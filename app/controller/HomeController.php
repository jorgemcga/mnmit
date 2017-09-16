<?php

namespace App\Controller;

use Core\Controller;
use Core\Containers;

class HomeController extends Controller {

    public $modelAtivo;
    public $modelComponente;
    public $modelEquipamento;
    public $modelLicenca;

    public function __construct()
    {
        parent::__construct();
        $this->modelAtivo = Containers::getModel('Ativo');
        $this->modelComponente = Containers::getModel('Componente');
        $this->modelEquipamento = Containers::getModel('Equipamento');
        $this->modelLicenca = Containers::getModel('Licenca');
    }

    public function index(){

        $this->view->nome = "Dashboard";

        @$this->view->contador->ativos = $this->modelAtivo->count();
        @$this->view->contador->ativos->monitorados = $this->modelAtivo->count("monitorar like '1'");
        @$this->view->contador->ativos->naoMonitorados = $this->modelAtivo->count("monitorar like '0'");
        @$this->view->contador->componentes = $this->modelComponente->count();
        @$this->view->contador->equipamentos = $this->modelEquipamento->count();
        @$this->view->contador->licencas = $this->modelLicenca->count();

        $this->setPageTitle("Dashboard");
        $this->setView("home/index", "layout/index");
    }

}