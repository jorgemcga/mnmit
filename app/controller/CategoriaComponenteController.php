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

        $data = [
            'nome' => $request->post->nome,
            'tipo_valor' => $request->post->tipo_valor,
            'sigla_valor' => $request->post->sigla_valor
        ];

        $result = $request->post->action=="salvar" ? $this->modelCategoriaComponente->insert($data) :  $this->modelCategoriaComponente->update($request->post->categoria_componente_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/categoriacomponente");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao salvar Categoria! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
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
            Redirect::route("/gerenciamento/categoriacomponente");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Categoria! Verifique se há pendencias antes de deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}