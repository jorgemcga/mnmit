<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class ManutencaoController extends Controller
{
    private $modelAtivo;
    private $modelManutencao;

    public function __construct()
    {
        parent::__construct();
        $this->modelAtivo = Containers::getModel('Ativo');
        $this->modelManutencao = Containers::getModel('Manutencao');
    }


    public function index($idAtivo){

        $this->view->ativo = $this->modelAtivo->find($idAtivo);

        $cond = "ativo_id = {$idAtivo}";
        $this->view->manutencoes = $this->modelManutencao->allWhere($cond);

        $this->view->action = "salvar";
        $this->view->show = "";
        $this->view->manutencao = $this->modelManutencao;


        $this->setPageTitle("Manutenções em {$this->view->ativo->nome}");
        $this->setView("manutencao/index", "layout/index");

    }

    public function salvar($request){

        $data = [
            'descricao' => $request->post->descricao,
            'datainicio' => $request->post->datainicio,
            'datafim' => $request->post->datafim,
            'status' => $request->post->status,
            'ativo_id' => $request->post->ativo_id
        ];

        $result = $request->post->action=="salvar" ? $this->modelManutencao->insert($data) :  $this->modelManutencao->update($request->post->manutencao_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/ativo/manutencao/todas/{$request->post->ativo_id}");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao registrar Manutenção! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
        }

    }

    public function editar($id){

        $this->view->action = "editar";
        $this->view->show = "show";

        $this->view->manutencao = $this->modelManutencao->find($id);
        $this->view->ativo = $this->modelAtivo->find($this->view->manutencao->ativo_id);

        $cond = "ativo_id = {$this->view->ativo->ativo_id}";
        $this->view->manutencoes = $this->modelManutencao->allWhere($cond);

        $this->setPageTitle("Editar Manutenção  #{$this->view->manutencao->manutencao_id}");
        $this->setView("manutencao/index", "layout/index");

    }

//    public function apagar($id){
//
//        if($result = $this->modelManutencao->delete($id)){
//            Redirect::route("/gerenciamento/ativo");
//        }
//        else {
//            echo '<script language="javascript">';
//            echo 'alert("Erro ao deletar Ativo! Verifique se há pendencias antes de deletar esse item!");';
//            echo 'history.go(-1);';
//            echo '</script>';
//        }
//    }

}