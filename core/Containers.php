<?php

namespace Core;

class Containers
{
    public static function newController($controller)
    {
        $objController = "App\\Controller\\" . $controller;
        return new $objController;
    }

}