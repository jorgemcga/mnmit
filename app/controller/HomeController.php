<?php

namespace App\Controller;

use Core\Controller;

class HomeController extends Controller {

    public function index(){

        $this->view->nome = "Dashboard";

        $this->setPageTitle("Dashboard");
        $this->setView("home/index", "layout/index");
    }

}