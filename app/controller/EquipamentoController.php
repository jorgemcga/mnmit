<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class EquipamentoController extends Controller
{
    private $modelEquipamento;
    private $modelCategoria;

    public function __construct()
    {
        parent::__construct();
        $this->modelEquipamento = Containers::getModel('Equipamento');
        $this->modelCategoria = Containers::getModel('CategoriaEquipamento');
    }


    public function index(){
        $fields =
            "equipamento_id,
            nrpatrimonio,
            a.nome,
            datacompra,
            a.categoria_equipamento_id,
            usuario_id,
            b.nome as categoria";


        $join = array(
            [
                "type" => "JOIN",
                "table" => "categoria_equipamento as b",
                "field1" => "a.categoria_equipamento_id",
                "op" => "=",
                "field2" => "b.categoria_equipamento_id"
            ]
        );

        $this->view->equipamentos = $this->modelEquipamento->join($fields, $join, null);

        $this->setPageTitle("Equipamentos");
        $this->setView("equipamento/index", "layout/index");

    }

    public function adicionar(){

        $this->view->equipamento = $this->modelEquipamento;
        $this->view->categoria_equipamento = $this->modelCategoria->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Equipamento");
        $this->setView("equipamento/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->modelEquipamento->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/equipamento/adicionar" :  "/gerenciamento/equipamento/editar/{$request->post->equipamento_id}";

        if (Validator::make($data, $this->modelEquipamento->rules())){
            return Redirect::route("{$url}");
        }*/

        $result = $request->post->action=="salvar" ? $this->modelEquipamento->insert($data) :  $this->modelEquipamento->update($request->post->equipamento_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/equipamento", [
                "success" => ["Equipamento Salvo com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/equipamento", [
                "error" => ["Erro ao salvar Equipamento!", "Verifique os dados e tente novamente!"]
            ]);
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->equipamento = $this->modelEquipamento->find($id);

        $this->view->categoria_equipamento = $this->modelCategoria->all();

        $this->setPageTitle("Editar Equipamento");
        $this->setView('equipamento/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelEquipamento->delete($id)){
            return Redirect::route("/gerenciamento/equipamento", [
                "success" => ["Equipamento excluída!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/equipamento", [
                "error" => ["Erro ao deletar Equipamento!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}