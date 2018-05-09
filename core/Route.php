<?php

namespace Core;

class Route
{
    private $routes;

    public function __construct(array $routes)
    {
        $this->setRoute($routes);
        $this->run();
    }

    private function setRoute($routes)
    {
        $newRoutes = array();

        foreach ($routes as $route){
            $explode = explode('@', $route[1]);
            $r = [$route[0], $explode[0], $explode[1]];
            $newRoutes[] = $r;
        }

        $this->routes = $newRoutes;

    }

    private function getRequest()
    {
        $obj = new \stdClass();

        foreach ($_GET as $key => $value){
            @$obj->get->$key = $value;
        }

        foreach ($_POST as $key => $value){
            @$obj->post->$key = $value;
        }

        foreach ($_FILES as $key => $value){
            @$obj->files->$key = $value;
        }

        return $obj;
    }

    private function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function run()
    {
        $url = str_replace(BASE_URL,"",$this->getUrl());
        $urlArray = explode("/", $url);

        foreach ($this->routes as $route)
        {
            $routeArray = explode("/", $route[0]);
            $param = array();

            for($i=0; $i<count($routeArray); $i++)
            {
                if ((strpos($routeArray[$i],"{") !== false) && (count($urlArray)==count($routeArray)))
                {
                    $routeArray[$i] = $urlArray[$i];
                    $param[] = $urlArray[$i];
                }
                $route[0] = implode($routeArray, "/");
            }

            if ($url == $route[0])
            {
                $found = true;
                $controller = $route[1];
                $action = $route[2];

                $auth = new Auth();

                if ($action != "login" && $action != "auth" && !$auth->check())
                {
                    if (!($controller == "MonitoramentoController" && $action=="index"))
                    {
                        $controller = "UsuarioController";
                        $action = "login";
                    }
                }

                break;
            }
            else $found = false;
        }

        if (!$found) return Containers::pageNotFound();

        $controller = Containers::newController($controller);

        switch (count($param))
        {
            case 1:
                return $controller->$action($param[0], $this->getRequest());
                break;
            case 2:
                return $controller->$action($param[0], $param[1], $this->getRequest());
                break;
            case 3:
                return $controller->$action($param[0], $param[1], $param[2], $this->getRequest());
                break;
            default:
                return $controller->$action($this->getRequest());
                break;
        }
    }
}