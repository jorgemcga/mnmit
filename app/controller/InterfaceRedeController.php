<?php

namespace App\Controller;

use App\Model\Ativo;
use App\Model\InterfaceRede;
use Core\Controller;
use Core\Redirect;

class InterfaceRedeController extends Controller
{
    private $ativo;
    private $interface;

    public function __construct()
    {
        parent::__construct();
        $this->ativo = new Ativo();
        $this->interface = new InterfaceRede();
    }

    public function index($idAtivo){

        $this->view->ativo = $this->ativo->find($idAtivo);

        $this->view->interfaces = $this->interface->where('ativo_id', $idAtivo)->get();

        $this->setPageTitle("Interfaces de Rede em " . $this->view->ativo->nome);
        $this->setView('interface/index', 'layout/index');

    }

    public function adicionar($idAtivo){

        $this->view->ativo = $this->ativo->find($idAtivo);
        $this->view->interface = $this->interface;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Interface de Rede");
        $this->setView("interface/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->interface->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/ativo/interface/adicionar" :  "/gerenciamento/ativo/interface/editar/{$request->post->interface_id}";

       if (Validator::make($data, $this->interface->rules())){
           return Redirect::route("{$url}");
       }*/

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->interface->create($data);

                return Redirect::route("/gerenciamento/ativo/interface/todas/{$request->post->ativo_id}", [
                    "success" => ["Interface Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/ativo/interface/todas/{$request->post->ativo_id}", [
                    "error" => ["Erro ao salvar Interface!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->interface->find($request->post->id)->update($data);

                return Redirect::route("/gerenciamento/ativo/interface/todas/{$request->post->ativo_id}", [
                    "success" => ["Interface Salva com Sucesso!"]
                ]);
            } catch (\Exception $exception) {
                return Redirect::route("/gerenciamento/ativo/interface/todas/{$request->post->ativo_id}", [
                    "error" => ["Erro ao salvar Interface!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->interface = $this->interface->find($id);

        @$this->view->ativo->id = $this->view->interface->ativo_id;

        $this->setPageTitle("Editar Interface de Rede");
        $this->setView('interface/form', 'layout/index');

    }

    public function apagar($idAtivo, $idInterface)
    {
        try
        {
            $this->interface->find($idInterface)->delete();

            return Redirect::route("/gerenciamento/ativo/interface/todas/{$idAtivo}", [
                "success" => ["Interface excluída!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/gerenciamento/ativo/interface/todas/{$idAtivo}", [
                "error" => ["Erro ao deletar Interface!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}