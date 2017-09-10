<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;
use Core\Session;
use Core\Validator;

class CategoriaEquipamentoController extends Controller
{
    private $modelCategoria;

    public function __construct()
    {
        parent::__construct();
        $this->modelCategoria = Containers::getModel('CategoriaEquipamento');
    }


    public function index(){

        $this->view->categorias = $this->modelCategoria->all();

        $this->setPageTitle("Categorias de Equipamentos");

        return $this->setView("categoria_equipamento/index", "layout/index");

    }

    public function adicionar(){

        $this->view->categoria = $this->modelCategoria;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Categoria");

        return $this->setView("categoria_equipamento/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->modelCategoria->data($request->post);

        $url = $request->post->action=="salvar" ? "/gerenciamento/categoriaequipamento/adicionar" :  "/gerenciamento/categoriaequipamento/editar/{$request->post->categoria_equipamento_id}";
        
        if (Validator::make($data, $this->modelCategoria->rules())){
            return Redirect::route("{$url}");
        }

        $result = $request->post->action=="salvar" ? $this->modelCategoria->insert($data) :  $this->modelCategoria->update($request->post->categoria_equipamento_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/categoriaequipamento", [
                "success" => ["Categoria Salva com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/categoriaequipamento", [
                "error" => ["Erro ao salvar Categoria!", "Verifique os dados e tente novamente!"]
            ]);
        }

    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->categoria = $this->modelCategoria->find($id);

        $this->setPageTitle("Editar Categoria");

        return $this->setView('categoria_equipamento/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelCategoria->delete($id)){
            return Redirect::route("/gerenciamento/categoriaequipamento", [
                "success" => ["Item excluído!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/categoriaequipamento", [
                "error" => ["Erro ao deletar Categoria!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }

}