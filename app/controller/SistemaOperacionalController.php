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

        $data = $this->modelSO->data($request->post);

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
            return Redirect::route("/gerenciamento/sistemaoperacional", [
                "success" => ["Sistema Operacional excluída!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/sistemaoperacional", [
                "error" => ["Erro ao deletar Sistema Operacional!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}