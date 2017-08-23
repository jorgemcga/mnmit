<?php

namespace Core;

abstract class Controller
{
    protected $view;
    private $viewPath;
    private  $layoutPath;
    private $pageTitle = null;

    public function __construct(){
        $this->view = new \stdClass();
    }

    protected function setView($viewPath, $layoutPath = null)
    {
        $this->viewPath = __DIR__ . "/../app/view/{$viewPath}.phtml";
        $this->layoutPath = __DIR__ . "/../app/view/{$layoutPath}.phtml";

        if ($layoutPath){
            $this->setLayout();
        }
        else{
            $this->content();
        }

    }

    protected function content(){
        if (file_exists($this->viewPath)){
            require_once $this->viewPath;
        }
        else {
            require_once __DIR__ . "/../app/view/notfound/index.phtml";
        }
    }

    protected function setLayout(){
        if (file_exists($this->layoutPath)){
            require_once $this->layoutPath;
        }
        else {
            require_once __DIR__ . "/../app/view/notfound/index.phtml";
        }
    }

    protected function setPageTitle($pageTitle){
        $this->pageTitle = $pageTitle;
    }

    protected function getPageTitle($separator = null){
        if ($separator){
            echo $this->pageTitle ." ". $separator . " ";
        }
        else{
            echo $this->pageTitle . " " ;
        }
    }

}