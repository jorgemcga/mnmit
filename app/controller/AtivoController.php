<?php

namespace App\Controller;

use App\Model\Ativo;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

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
        $this->modelAtivo = new Ativo();
    }


    public function index(){

        $this->view->ativos = $this->modelAtivo->all();

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

        $request->post->monitorar = isset($request->post->monitorar) ? 1 : 0;

        $data = $this->modelAtivo->data($request->post);

        $url = $request->post->action=="salvar" ? "/gerenciamento/ativo/adicionar" :  "/gerenciamento/ativo/editar/{$request->post->ativo_id}";

        if (Validator::make($data, $this->modelAtivo->rules())){
            return Redirect::route("{$url}");
        }

        $result = $request->post->action=="salvar" ? $this->modelAtivo->insert($data) :  $this->modelAtivo->update($request->post->ativo_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/ativo", [
                "success" => ["Ativo Salvo com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/ativo", [
                "error" => ["Erro ao salvar Ativo!", "Verifique os dados e tente novamente!"]
            ]);
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
            return Redirect::route("/gerenciamento/ativo", [
                "success" => ["Ativo excluído!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/ativo", [
                "error" => ["Erro ao deletar Ativo!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }

}