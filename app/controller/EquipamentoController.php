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

        $data = [
            'nrpatrimonio' => $request->post->nrpatrimonio,
            'nome' => $request->post->nome,
            'datacompra' => $request->post->datacompra,
            'categoria_equipamento_id' => $request->post->categoria_equipamento_id,
            'usuario_id' => $request->post->usuario_id
        ];

        $result = $request->post->action=="salvar" ? $this->modelEquipamento->insert($data) :  $this->modelEquipamento->update($request->post->equipamento_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/equipamento");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao salvar Equipamento! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
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
            Redirect::route("/gerenciamento/equipamento");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Equipamento! Verifique se há pendencias antes de deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}