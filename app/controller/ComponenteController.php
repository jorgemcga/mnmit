<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class ComponenteController extends Controller
{
    private $modelComponente;
    private $modelCategoriaComponente;
    private $modelAtivo;

    public function __construct()
    {
        parent::__construct();

        $this->modelComponente = Containers::getModel('Componente');
        $this->modelAtivo = Containers::getModel('Ativo');
        $this->modelCategoriaComponente = Containers::getModel('CategoriaComponente');

    }

    public function index(){

        $fields =
            "componente_id,
            a.nome,
            valor,
            b.nome as categoria,
            c.nome as ativo,
            tipo_valor,
            sigla_valor";


        $join = array(
            [
                "type" => "JOIN",
                "table" => "categoria_componente as b",
                "field1" => "a.categoria_componente_id",
                "op" => "=",
                "field2" => "b.categoria_componente_id"
            ],
            [
                "type" => "LEFT JOIN",
                "table" => "ativo as c",
                "field1" => "a.ativo_id",
                "op" => "=",
                "field2" => "c.ativo_id"
            ]
        );

        $this->view->componentes = $this->modelComponente->join($fields, $join, null);

        $this->setPageTitle("Componentes");
        $this->setView("componente/index", "layout/index");

    }

    public function adicionar(){

        $this->view->componente = $this->modelComponente;
        $this->view->ativo = $this->modelAtivo->all();
        $this->view->categoria = $this->modelCategoriaComponente->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Componente");
        $this->setView("componente/form", "layout/index");
    }

    public function salvar($request){

        $data = [
            'nome' => $request->post->nome,
            'valor' => $request->post->valor,
            'categoria_componente_id' => $request->post->categoria_componente_id,
            'ativo_id' => $request->post->ativo_id
        ];

        $result = $request->post->action=="salvar" ? $this->modelComponente->insert($data) :  $this->modelComponente->update($request->post->componente_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/componente");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao salvar Componente! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
        }

    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->componente = $this->modelComponente->find($id);

        $this->view->ativo = $this->modelAtivo->all();
        $this->view->categoria = $this->modelCategoriaComponente->all();

        $this->setPageTitle("Editar Componente");
        $this->setView('componente/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelComponente->delete($id)){
            Redirect::route("/gerenciamento/componente");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Componente! Verifique se há pendencias antes de deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}