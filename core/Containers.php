<?php

namespace Core;

class Containers
{
    public static function newController($controller)
    {
        $objController = "App\\Controller\\" . $controller;
        return new $objController;
    }

    public static function getModel($model)
    {
        $objModel = "App\\Model\\" . $model;
        return new $objModel(DataBase::getDataBase());
    }

    public static function pageNotFound()
    {
        $fileNotFound = __DIR__ . "/../app/view/errors/index.phtml";

        if($fileNotFound) return require_once $fileNotFound;

        return "Erro 404 - Pagina não encontrada!";
    }

    public static function PageInMaintenance()
    {
        $fileNotFound = __DIR__ . "/../app/view/errors/maintenance.phtml";

        if($fileNotFound) return require_once $fileNotFound;

        return "Erro 404 - Pagina não encontrada!";
    }

}