<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class CategoriaLicencaController extends Controller
{
    private $modelCategoriaLicenca;

    public function __construct()
    {
        parent::__construct();
        $this->modelCategoriaLicenca = Containers::getModel('CategoriaLicenca');
    }


    public function index(){

        $this->view->categorias = $this->modelCategoriaLicenca->all();

        $this->setPageTitle("Categoria de Licenças");
        $this->setView("categoria_licenca/index", "layout/index");

    }

    public function adicionar(){

        $this->view->categoria = $this->modelCategoriaLicenca->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Licenca");
        $this->setView("categoria_licenca/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->modelCategoriaLicenca->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/categorialicenca/adicionar" :  "/gerenciamento/categorialicenca/editar/{$request->post->categoria_licenca_id}";

        if (Validator::make($data, $this->CategoriaLicenca->rules())){
            return Redirect::route("{$url}");
        }*/

        $result = $request->post->action=="salvar" ? $this->modelCategoriaLicenca->insert($data) :  $this->modelCategoriaLicenca->update($request->post->categoria_licenca_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/categorialicenca", [
                "success" => ["Categoria Salva com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/categorialicenca", [
                "error" => ["Erro ao salvar Categoria!", "Verifique os dados e tente novamente!"]
            ]);
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->categoria = $this->modelCategoriaLicenca->find($id);

        $this->setPageTitle("Editar Licença");
        $this->setView('categoria_licenca/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelCategoriaLicenca->delete($id)){
            return Redirect::route("/gerenciamento/categorialicenca", [
                "success" => ["Categoria excluída!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/categorialicenca", [
                "error" => ["Erro ao deletar Categoria!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }

}