<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class FabricanteController extends Controller
{
    private $modelFabricante;

    public function __construct()
    {
        parent::__construct();
        $this->modelFabricante = Containers::getModel('Fabricante');
    }


    public function index(){

        $this->view->fabricantes = $this->modelFabricante->all();

        $this->setPageTitle("Fabricantes");
        $this->setView("fabricante/index", "layout/index");

    }

    public function adicionar(){

        $this->view->fabricante = $this->modelFabricante;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Fabricante");
        $this->setView("fabricante/form", "layout/index");
    }

    public function salvar($request){

        $data = [
            'nome' => $request->post->nome
        ];

        $result = $request->post->action=="salvar" ? $this->modelFabricante->insert($data) :  $this->modelFabricante->update($request->post->fabricante_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/fabricante");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao Salvar Fabricante! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
        }

    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->fabricante = $this->modelFabricante->find($id);

        $this->setPageTitle("Editar Fabricante");
        $this->setView('fabricante/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelFabricante->delete($id)){
            Redirect::route("/gerenciamento/fabricante");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Fabricante! Verifique se há pendencias antes de deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}