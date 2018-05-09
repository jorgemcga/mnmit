<?php

namespace Core;

abstract class Controller
{
    protected $view;
    protected $auth;
    protected $success;
    protected $errors;
    protected $inputs;
    protected $file;

    private $viewPath;
    private $layoutPath;
    private $pageTitle = null;

    public function __construct()
    {
        $this->view = new \stdClass();
        $this->auth = new Auth();

        if (Session::get('success')){
            $this->success = Session::get('success');
            Session::destroy('success');
        }
        if (Session::get('error')){
            $this->errors = Session::get('error');
            Session::destroy(['error']);
        }
        if (Session::get('inputs')){
            $this->inputs = Session::get('inputs');
            Session::destroy(['inputs']);
        }
        if (Session::get('file')){
            $this->file = Session::get('file');
            Session::destroy(['file']);
        }
    }

    protected function setView($viewPath, $layoutPath = null)
    {
        $this->viewPath = __DIR__ . "/../app/view/{$viewPath}.phtml";
        $this->layoutPath = __DIR__ . "/../app/view/{$layoutPath}.phtml";

        if ($layoutPath) return $this->setLayout();
        else return $this->content();
    }

    protected function content()
    {
        if (file_exists($this->viewPath)) return require_once $this->viewPath;
        else
        {
            //$this->erro = "Content não encontrado";
            //return require_once __DIR__ . "/../app/view/notfound/index.phtml";
        }
    }

    protected function setLayout()
    {
        if (file_exists($this->layoutPath)) return require_once $this->layoutPath;
        else
        {
            $this->erro = "Layout não encontrado";
            return require_once __DIR__ . "/../app/view/notfound/index.phtml";
        }
    }

    protected function setPageTitle($pageTitle)
    {
        return $this->pageTitle = $pageTitle;
    }

    protected function getPageTitle($separator = null)
    {
        if ($separator) return $this->pageTitle ." ". $separator . " ";
        else return $this->pageTitle . " " ;
    }

}