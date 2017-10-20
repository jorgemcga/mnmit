<?php

namespace App\Controller;

use Core\Controller;

class InternetController extends Controller
{
    public function index()
    {
        $this->setPageTitle("Velocidade da Internet");
        $this->setView("internet/index", "layout/index");
    }
}