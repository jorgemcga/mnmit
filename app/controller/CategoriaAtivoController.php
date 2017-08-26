<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class CategoriaAtivoController extends Controller
{
    private $modelCategoriaAtivo;

    public function __construct()
    {
        parent::__construct();
        $this->modelCategoriaAtivo = Containers::getModel('CategoriaAtivoModel');
    }

    public function index()
    {

        $this->view->categoria_ativos = $this->modelCategoriaAtivo->all();

        $this->setPageTitle("Categoria de Ativos");
        $this->setView("categoria_ativo/index", "layout/index");

    }

    public function adicionar()
    {

        $this->view->categoria_ativo = $this->modelCategoriaAtivo;
        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Categoria de Ativo");
        $this->setView("categoria_ativo/form", "layout/index");
    }

    public function salvar($request){

        $data = [
            'nome' => $request->post->nome,
        ];

        $result = $request->post->action=="salvar" ? $this->modelCategoriaAtivo->insert($data) :  $this->modelCategoriaAtivo->update($request->post->categoria_ativo_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/ativo");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao realizar operação! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
        }

    }
}