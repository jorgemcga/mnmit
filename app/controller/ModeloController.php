<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class ModeloController extends Controller
{
    private $modelModelo;
    private $modelFabricante;

    public function __construct()
    {
        parent::__construct();
        $this->modelModelo = Containers::getModel('ModeloModel');
        $this->modelFabricante = Containers::getModel('Fabricante');
    }


    public function index(){

        $this->view->modelos = $this->modelModelo->all();;

        $this->setPageTitle("Modelos");
        $this->setView("modelo/index", "layout/index");

    }

    public function adicionar(){

        $this->view->modelo = $this->modelModelo;
        $this->view->fabricante = $this->modelFabricante->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Modelo");
        $this->setView("modelo/form", "layout/index");
    }

    public function salvar($request){

        $data = [
            'nome' => $request->post->nome,
            'fabricante_id' => $request->post->fabricante_id
        ];

        $result = $request->post->action=="salvar" ? $this->modelModelo->insert($data) :  $this->modelModelo->update($request->post->modelo_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/modelo");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao salvar Modelo! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
        }

    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->modelo = $this->modelModelo->find($id);
        $this->view->fabricante = $this->modelFabricante->all();

        $this->setPageTitle("Editar Modelo");
        $this->setView('modelo/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelModelo->delete($id)){
            Redirect::route("/gerenciamento/modelo");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Modelo! Verifique se há pendencias antes de deletar!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}