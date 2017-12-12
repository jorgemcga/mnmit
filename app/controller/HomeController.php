<?php

namespace App\Controller;

use App\Model\Ativo;
use App\Model\Componente;
use App\Model\Equipamento;
use App\Model\Http;
use App\Model\InterfaceRede;
use App\Model\Internet;
use App\Model\Licenca;
use App\Model\Ping;
use App\Model\Site;
use Core\Controller;

class HomeController extends Controller {

    public $ativo;
    public $componente;
    public $equipamento;
    public $licenca;
    public $interface;
    public $site;

    public $internet;
    public $ping;
    public $http;

    public function __construct()
    {
        parent::__construct();

        $this->ativo = new Ativo();
        $this->componente = new Componente();
        $this->equipamento = new Equipamento();
        $this->licenca = new Licenca();
        $this->interface = new InterfaceRede();
        $this->site = new Site();

        $this->internet = new Internet();
        $this->ping = new Ping();
        $this->http = new Http();

    }

    public function index(){

        $this->view->nome = "Dashboard";

        @$this->view->contador->ativos = $this->ativo->count();
        @$this->view->contador->ativos->monitorados = $this->ativo->where("id",1)->count();
        @$this->view->contador->ativos->naoMonitorados = $this->ativo->where("id", 0)->count();
        $this->view->contador->componentes = $this->componente->count();
        $this->view->contador->equipamentos = $this->equipamento->count();
        $this->view->contador->licencas = $this->licenca->count();

        $this->view->contador->internet = $this->internet->first();

        //PING
        $access = 0;
        $inacess = 0;

        $interfaces = $this->interface->where("monitorar", 1)->get();

        foreach ($interfaces as $interface) {
            $ping = $this->ping->where("interface_rede_id", "$interface->id")->orderBy("updated_at", "desc")->first();
            $ping->status == 0 ? $access++ : $inacess++;
        }

        @$this->view->contador->ping->acessiveis = $access ;
        @$this->view->contador->ping->inacessiveis = $inacess;
        //PING

        //HTTP
        $access = 0;
        $inacess = 0;

        $sites = $this->site->all();

        foreach ($sites as $site) {
            $https = $this->http->where("site_id", "$site->id")->orderBy("updated_at", "desc")->first();
            $https->status == 0 ? $access++ : $inacess++;
        }

        @$this->view->contador->http->acessiveis = $access ;
        @$this->view->contador->http->inacessiveis = $inacess;
        //HTTP

        $this->setPageTitle("Dashboard");
        $this->setView("home/index", "layout/index");
    }

}