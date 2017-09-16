<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class InterfaceRedeController extends Controller
{
    private $modelAtivo;
    private $modelInterface;

    public function __construct()
    {
        parent::__construct();
        $this->modelAtivo = Containers::getModel('Ativo');
        $this->modelInterface = Containers::getModel('InterfaceRede');
    }

    public function index($idAtivo){

        $this->view->ativo = $this->modelAtivo->find($idAtivo);

        $where = "ativo_id = {$idAtivo}";

        $this->view->interfaces = $this->modelInterface->all($where);

        $this->setPageTitle("Interfaces de Rede em " . $this->view->ativo->nome);
        $this->setView('interface/index', 'layout/index');

    }

    public function adicionar($idAtivo){

        $this->view->ativo = $this->modelAtivo->find($idAtivo);
        $this->view->interface = $this->modelInterface;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Interface de Rede");
        $this->setView("interface/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->modelInterface->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/ativo/interface/adicionar" :  "/gerenciamento/ativo/interface/editar/{$request->post->interface_id}";

       if (Validator::make($data, $this->modelInterface->rules())){
           return Redirect::route("{$url}");
       }*/

        $result = $request->post->action=="salvar" ? $this->modelInterface->insert($data) :  $this->modelInterface->update($request->post->interface_rede_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/ativo/interface/todas/{$request->post->ativo_id}", [
                "success" => ["Interface Salva com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/ativo/interface/todas/{$request->post->ativo_id}", [
                "error" => ["Erro ao salvar Interface!", "Verifique os dados e tente novamente!"]
            ]);
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->interface = $this->modelInterface->find($id);

        $this->view->ativo->ativo_id = $this->view->interface->ativo_id;

        $this->setPageTitle("Editar Interface de Rede");
        $this->setView('interface/form', 'layout/index');

    }

    public function apagar($idAtivo, $idInterface){

        if($result = $this->modelInterface->delete($idInterface)){
            return Redirect::route("/gerenciamento/ativo/interface/todas/{$idAtivo}", [
                "success" => ["Interface excluída!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/ativo/interface/todas/{$idAtivo}", [
                "error" => ["Erro ao deletar Interface!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}