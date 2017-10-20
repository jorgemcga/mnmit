<?php

namespace App\Controller;

use Core\Controller;

class HttpController extends Controller
{
    public function index()
    {
        $this->setPageTitle("Monitoramento HTTP/HTTPS");
        $this->setView("http/index", "layout/index");
    }

}