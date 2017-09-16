<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class CategoriaComponenteController extends Controller
{
    private $modelCategoriaComponente;

    public function __construct()
    {
        parent::__construct();
        $this->modelCategoriaComponente = Containers::getModel('CategoriaComponente');
    }


    public function index(){

        $this->view->categorias = $this->modelCategoriaComponente->all();

        $this->setPageTitle("Categorias de Componentes");
        $this->setView("categoria_componente/index", "layout/index");

    }

    public function adicionar(){

        $this->view->categoria = $this->modelCategoriaComponente;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Categoria");
        $this->setView("categoria_componente/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->modelCategoriaComponente->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/categoriacomponente/adicionar" :  "/gerenciamento/categoriacomponente/editar/{$request->post->categoria_componente_id}";

        if (Validator::make($data, $this->CategoriaComponente->rules())){
            return Redirect::route("{$url}");
        }*/

        $result = $request->post->action=="salvar" ? $this->modelCategoriaComponente->insert($data) :  $this->modelCategoriaComponente->update($request->post->categoria_componente_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/categoriacomponente", [
                "success" => ["Categoria Salva com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/categoriacomponente", [
                "error" => ["Erro ao salvar Categoria!", "Verifique os dados e tente novamente!"]
            ]);
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->categoria = $this->modelCategoriaComponente->find($id);

        $this->setPageTitle("Editar Categoria");
        $this->setView('categoria_componente/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelCategoriaComponente->delete($id)){
            return Redirect::route("/gerenciamento/categoriacomponente", [
                "success" => ["Categoria excluída!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/categoriacomponente", [
                "error" => ["Erro ao deletar Categoria!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }

}