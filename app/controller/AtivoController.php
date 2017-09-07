<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class AtivoController extends Controller
{
    private $modelAtivo;
    private $modelCategoriaAtivo;
    private $modelSO;
    private $modelModelo;
    private $modelInterface;

    public function __construct()
    {
        parent::__construct();
        $this->modelAtivo = Containers::getModel('Ativo');
        $this->modelCategoriaAtivo = Containers::getModel('CategoriaAtivo');
        $this->modelSO = Containers::getModel('SistemaOperacional');
        $this->modelModelo = Containers::getModel('ModeloModel');
        $this->modelInterface = Containers::getModel('InterfaceRede');
    }


    public function index(){

        $fields =
            "ativo_id,
            nrpatrimonio,
            a.nome,
            tag,
            descricao,
            datacompra,
            monitorar,
            a.categoria_ativo_id,
            so_id,
            serial,
            modelo_id,
            usuario_id,
            b.nome as categoria";


        $join = array(
            [
                "table" => "categoria_ativo as b",
                "field1" => "a.categoria_ativo_id",
                "op" => "=",
                "field2" => "b.categoria_ativo_id"
            ]
        );

        $this->view->ativos = $this->modelAtivo->join($fields, $join, null);

        $this->setPageTitle("Ativos");
        $this->setView("ativo/index", "layout/index");

    }

    public function visualizar($id){

        $this->view->ativo = $this->modelAtivo->find($id);

        $this->setPageTitle($this->view->ativo->nome);
        $this->setView("ativo/detalhes", "layout/index");

    }

    public function adicionar(){

        $this->view->ativo = $this->modelAtivo;
        $this->view->categoria_ativo = $this->modelCategoriaAtivo->all();
        $this->view->so = $this->modelSO->all();
        $this->view->modelo = $this->modelModelo->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Ativo");
        $this->setView("ativo/form", "layout/index");
    }

    public function salvar($request){

        $monitorar = isset($request->post->monitorar) ? 1 : 0;

        $data = [
            'nrpatrimonio' => $request->post->nrpatrimonio,
            'nome' => $request->post->nome,
            'tag' => $request->post->tag,
            'descricao' => $request->post->descricao,
            'datacompra' => $request->post->datacompra,
            'monitorar' => $monitorar,
            'categoria_ativo_id' => $request->post->categoria_ativo_id,
            'so_id' => $request->post->so_id,
            'modelo_id'=> $request->post->modelo_id,
            'serial' => $request->post->serial,
            'usuario_id' => $request->post->usuario_id
        ];

        $result = $request->post->action=="salvar" ? $this->modelAtivo->insert($data) :  $this->modelAtivo->update($request->post->ativo_id, $data);

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

    public function editar($id){

        $this->view->action = "editar";

        $this->view->ativo = $this->modelAtivo->find($id);

        if ($this->view->ativo->monitorar == 1){
            $this->view->ativo->monitorar = "checked";
        }

        $this->view->categoria_ativo = $this->modelCategoriaAtivo->all();
        $this->view->so = $this->modelSO->all();
        $this->view->modelo = $this->modelModelo->all();

        $this->setPageTitle("Editar Ativo");
        $this->setView('ativo/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelAtivo->delete($id)){
            Redirect::route("/gerenciamento/ativo");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Ativo! Verifique se há pendencias antes de deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}