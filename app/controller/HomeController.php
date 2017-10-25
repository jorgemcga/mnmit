<?php

namespace App\Controller;

use App\Model\Ativo;
use App\Model\Componente;
use App\Model\Equipamento;
use App\Model\Licenca;
use Core\Controller;

class HomeController extends Controller {

    public $ativo;
    public $componente;
    public $equipamento;
    public $licenca;

    public function __construct()
    {
        parent::__construct();
        $this->ativo = new Ativo();
        $this->componente = new Componente();
        $this->equipamento = new Equipamento();
        $this->licenca = new Licenca();
    }

    public function index(){

        $this->view->nome = "Dashboard";

        @$this->view->contador->ativos = $this->ativo->count();
        @$this->view->contador->ativos->monitorados = $this->ativo->where("id","=" ,1)->count();
        @$this->view->contador->ativos->naoMonitorados = $this->ativo->where("id","=", 0)->count();
        @$this->view->contador->componentes = $this->componente->count();
        @$this->view->contador->equipamentos = $this->equipamento->count();
        @$this->view->contador->licencas = $this->licenca->count();

        $this->setPageTitle("Dashboard");
        $this->setView("home/index", "layout/index");
    }

}