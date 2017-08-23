<?php

namespace App\Controller;

use Core\Controller;

class MonitoramentoController extends Controller {

    public function index(){

        $this->view->nome = "Monitoramento";

        $this->setPageTitle("Monitoramento");
        $this->setView("monitoramento/index", "layout/index");
    }

}