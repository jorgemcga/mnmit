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

        $data = $this->modelLicenca->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/licenca/adicionar" :  "/gerenciamento/licenca/editar/{$request->post->licenca_id}";

       if (Validator::make($data, $this->modelLicenca->rules())){
           return Redirect::route("{$url}");
       }*/

        $result = $request->post->action=="salvar" ? $this->modelLicenca->insert($data) :  $this->modelLicenca->update($request->post->licenca_id, $data);

        if ($result){
            return Redirect::route("/gerenciamento/licenca", [
                "success" => ["Licença Salva com Sucesso!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/licenca", [
                "error" => ["Erro ao salvar Licença!", "Verifique os dados e tente novamente!"]
            ]);
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
            return Redirect::route("/gerenciamento/licenca", [
                "success" => ["Licença excluída!"]
            ]);
        }
        else {
            return Redirect::route("/gerenciamento/licenca", [
                "error" => ["Erro ao deletar Licença!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}