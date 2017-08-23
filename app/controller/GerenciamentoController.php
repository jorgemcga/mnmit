<?php

namespace App\Controller;

use Core\Controller;

class GerenciamentoController extends Controller {

    public function index(){
        $this->view->nome = "Gerencimento";

        $this->setPageTitle("Gerenciamento");
        $this->setView("gerenciamento/index", "layout/index");
    }

}