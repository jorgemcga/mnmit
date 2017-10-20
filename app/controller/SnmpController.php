<?php

namespace App\Controller;

use Core\Controller;

class SnmpController extends Controller
{
    public function index()
    {
        $this->setPageTitle("Monitoramento SNMP");
        $this->setView("snmp/index", "layout/index");
    }

}