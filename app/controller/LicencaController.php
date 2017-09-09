<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class LicencaController extends Controller
{
    private $modelLicenca;
    private $modelCategoriaLicenca;

    public function __construct()
    {
        parent::__construct();
        $this->modelLicenca = Containers::getModel('Licenca');
        $this->modelCategoriaLicenca = Containers::getModel('CategoriaLicenca');
    }


    public function index(){

        $fields =
            "licenca_id,
            a.nome,
            a.categoria_licenca_id,
            serial,
            datacompra,
            datavence,
            b.sigla as categoria";


        $join = array(
            [
                "type" => "JOIN",
                "table" => "categoria_licenca as b",
                "field1" => "a.categoria_licenca_id",
                "op" => "=",
                "field2" => "b.categoria_licenca_id"
            ]
        );

        $this->view->licencas = $this->modelLicenca->join($fields, $join, null);

        $this->setPageTitle("Licenças");
        $this->setView("licenca/index", "layout/index");

    }

    public function adicionar(){

        $this->view->licenca = $this->modelLicenca;
        $this->view->categorias = $this->modelCategoriaLicenca->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Licença");
        $this->setView("licenca/form", "layout/index");
    }

    public function salvar($request){

        $data = [
            'nome' => $request->post->nome,
            'serial' => $request->post->serial,
            'datacompra' => $request->post->datacompra,
            'datavence' => $request->post->datavence,
            'categoria_licenca_id' => $request->post->categoria_licenca_id,
        ];

        $result = $request->post->action=="salvar" ? $this->modelLicenca->insert($data) :  $this->modelLicenca->update($request->post->licenca_id, $data);

        if ($result){
            Redirect::route("/gerenciamento/licenca");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao salvar Licença! Verifique os dados!");';
            echo 'history.go(-1);';
            echo '</script>';
        }

    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->licenca = $this->modelLicenca->find($id);

        $this->view->categorias = $this->modelCategoriaLicenca->all();

        $this->setPageTitle("Editar Licenca");
        $this->setView('licenca/form', 'layout/index');

    }

    public function apagar($id){

        if($result = $this->modelLicenca->delete($id)){
            Redirect::route("/gerenciamento/Licenca");
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Erro ao deletar Licenca! Verifique se há pendencias antes de deletar esse item!");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

}