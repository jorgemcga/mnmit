<?php

namespace App\Controller;

use Core\Containers;
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
        $this->modelAtivo = Containers::getModel('Ativo');
        $this->modelCategoriaAtivo = Containers::getModel('CategoriaAtivo');
        $this->modelSO = Containers::getModel('SistemaOperacional');
        $this->modelModelo = Containers::getModel('ModeloModel');
        $this->modelInterface = Containers::getModel('InterfaceRede');
    }


    public function index(){

        $fields =
            "ativo_id,
            nrpatrimonio,
            a.nome,
            tag,
            descricao,
            datacompra,
            monitorar,
            a.categoria_ativo_id,
            serial,
            usuario_id,
            b.nome as categoria,
            c.nome as so,
            d.nome as modelo,
            e.nome as fabricante";


        $join = array(
            [
                "type" => "JOIN",
                "table" => "categoria_ativo as b",
                "field1" => "a.categoria_ativo_id",
                "op" => "=",
                "field2" => "b.categoria_ativo_id"
            ],
            [
                "type" => "LEFT JOIN",
                "table" => "so as c",
                "field1" => "a.so_id",
                "op" => "=",
                "field2" => "c.so_id"
            ],
            [
                "type" => "LEFT JOIN",
                "table" => "modelo as d",
                "field1" => "a.modelo_id",
                "op" => "=",
                "field2" => "d.modelo_id"
            ],
            [
                "type" => "LEFT JOIN",
                "table" => "fabricante as e",
                "field1" => "d.fabricante_id",
                "op" => "=",
                "field2" => "e.fabricante_id"
            ]
        );

        $this->view->ativos = $this->modelAtivo->join($fields, $join, null);

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