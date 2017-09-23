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
        $this->modelModelo = Containers::getModel('Modelo');
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

        $data = $this->modelModelo->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/categoriacomponente/adicionar" :  "/gerenciamento/categoriacomponente/editar/{$request->post->categoria_componente_id}";

        if (Validator::make($data, $this->CategoriaComponente->rules())){
            return Redirect::route("{$url}");
        }*/

        $result = $request->post->action=="salvar" ? $this->modelModelo->insert($data) :  $this->modelModelo->update($request->post->modelo_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/modelo", [
                "success" => ["Modelo Salvo com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/modelo", [
                "error" => ["Erro ao salvar Modelo!", "Verifique os dados e tente novamente!"]
            ]);
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
            return Redirect::route("/gerenciamento/modelo", [
                "success" => ["Modelo excluído!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/modelo", [
                "error" => ["Erro ao deletar Modelo!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}