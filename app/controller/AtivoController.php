<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class AtivoController extends Controller
{
    private $modelAtivo;

    public function __construct()
    {
        parent::__construct();
        $this->modelAtivo = Containers::getModel('AtivoModel');
    }


    public function index(){

        $ativos = $this->modelAtivo->all();

        $this->view->ativos = $ativos;

        $this->setPageTitle("Ativos");
        $this->setView("ativo/index", "layout/index");

    }

    public function visualizar($id){

        $ativo = $this->modelAtivo->find($id);

        $this->view->ativo = $ativo;

        $this->setPageTitle("Visualizar Ativo");
        $this->setView("ativo/detalhes", "layout/index");

    }

    public function adicionar(){

        $this->view->ativo = new \stdClass();

        $this->view->ativo->ativo_id = "";
        $this->view->ativo->nrpatrimonio = "";
        $this->view->ativo->nome = "";
        $this->view->ativo->tag = "";
        $this->view->ativo->descricao = "";
        $this->view->ativo->datacompra = "";
        $this->view->ativo->monitorar = "checked";
        $this->view->ativo->categoria_ativo_id = "";
        $this->view->ativo->so_id = "";
        $this->view->ativo->modelo_id = "";
        $this->view->ativo->usuario_id = "";

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Ativo");
        $this->setView("ativo/form", "layout/index");
    }

    public function salvar($request){

        $monitorar = isset($request->post->monitorar)? 1 : 0;

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

        $this->setPageTitle("Editar Ativo");
        $this->setView('ativo/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelAtivo->delete($id)){
            Redirect::route("/gerenciamento/ativo");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao Deletar! Verifique se não há pendencias para deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }



    }

}