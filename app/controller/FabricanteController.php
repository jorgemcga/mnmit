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

        $data = $this->modelFabricante->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/fabricante/adicionar" :  "/gerenciamento/fabricante/editar/{$request->post->fabricante_id}";

        if (Validator::make($data, $this->modelFabricante->rules())){
            return Redirect::route("{$url}");
        }*/

        $result = $request->post->action=="salvar" ? $this->modelFabricante->insert($data) :  $this->modelFabricante->update($request->post->fabricante_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/fabricante", [
                "success" => ["Fabricante Salva com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/fabricante", [
                "error" => ["Erro ao salvar Fabricante!", "Verifique os dados e tente novamente!"]
            ]);
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
            return Redirect::route("/gerenciamento/fabricante", [
                "success" => ["Fabricante excluído!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/fabricante", [
                "error" => ["Erro ao deletar Fabricante!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}