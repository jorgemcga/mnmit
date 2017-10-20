<?php

namespace App\Controller;

use Core\Controller;

class PingController extends Controller
{
    public function index()
    {
        $this->setPageTitle("Monitoramento ICMP (Ping)");
        $this->setView("ping/index", "layout/index");
    }

}