<?php

namespace App\Controller;

use Core\Controller;
use Core\Containers;
use Core\Redirect;

class SistemaOperacionalController extends Controller
{

    private $modelSO;

    public function __construct()
    {
        parent::__construct();
        $this->modelSO = Containers::getModel('SistemaOperacional');
    }

    public function index()
    {

        $this->view->so = $this->modelSO->all();

        $this->setPageTitle("Sistemas Operacionais");
        $this->setView("so/index", "layout/index");

    }

    public function adicionar()
    {

        $this->view->so = $this->modelSO;
        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Sistema Operacional");
        $this->setView("so/form", "layout/index");
    }

    public function salvar($request){

        $data = [
            'nome' => $request->post->nome,
            'versao' => $request->post->versao,
        ];

        $result = $request->post->action=="salvar" ? $this->modelSO->insert($data) :  $this->modelSO->update($request->post->so_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/sistemaoperacional");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao Salvar! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
        }

    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->so = $this->modelSO->find($id);

        $this->setPageTitle("Editar Sistema Operacional");
        $this->setView('so/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelSO->delete($id)){
            Redirect::route("/gerenciamento/sistemaoperacional");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao Deletar! Verifique se há pendencias para deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}