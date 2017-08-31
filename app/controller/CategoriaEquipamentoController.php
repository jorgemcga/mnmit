<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 31/08/2017
 * Time: 09:43
 */

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

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
        $this->setView("categoria_equipamento/index", "layout/index");

    }

    public function adicionar(){

        $this->view->categoria = $this->modelCategoria;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Categoria");
        $this->setView("categoria_equipamento/form", "layout/index");
    }

    public function salvar($request){

        $data = ['nome' => $request->post->nome];

        $result = $request->post->action=="salvar" ? $this->modelCategoria->insert($data) :  $this->modelCategoria->update($request->post->categoria_equipamento_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/categoriaequipamento");
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

        $this->view->categoria = $this->modelCategoria->find($id);

        $this->setPageTitle("Editar Categoria");
        $this->setView('categoria_equipamento/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelCategoria->delete($id)){
            Redirect::route("/gerenciamento/categoriaequipamento");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Categoria! Verifique se há pendencias antes de deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}