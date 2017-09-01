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

        $cond = "ativo_id = {$idAtivo}";

        $this->view->interfaces = $this->modelInterface->allWhere($cond);

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

         $data = [
            'hostname' => $request->post->hostname,
            'ip' => $request->post->ip,
            'mascara' => $request->post->mascara,
            'gateway' => $request->post->gateway,
            'dns1' => $request->post->dns1,
            'dns2' => $request->post->dns2,
            'macaddress' => $request->post->macaddress,
            'ativo_id' => $request->post->ativo_id
        ];

        $result = $request->post->action=="salvar" ? $this->modelInterface->insert($data) :  $this->modelInterface->update($request->post->interface_rede_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/ativo/interface/todas/{$request->post->ativo_id}");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao salvar Interface! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
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
            Redirect::route("/gerenciamento/ativo/interface/todas/{$idAtivo}");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Interface! Verifique se há pendencias antes de deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }
}