<?php

namespace App\Controller;

use Core\Containers;
use Core\Controller;
use Core\Redirect;

class AtivoController extends Controller
{
    private $modelAtivo;

    public function __construct()
    {
        parent::__construct();
        $this->modelAtivo = Containers::getModel('AtivoModel');
    }


    public function index(){

        $ativos = $this->modelAtivo->all();

        $this->view->ativos = $ativos;

        $this->setPageTitle("Ativos");
        $this->setView("ativo/index", "layout/index");

    }

    public function visualizar($id){

        $ativo = $this->modelAtivo->find($id);

        $this->view->ativo = $ativo;

        $this->setPageTitle("Visualizar Ativo");
        $this->setView("ativo/detalhes", "layout/index");

    }

    public function adicionar(){
        $this->setPageTitle("Adicionar Ativo");
        $this->setView("ativo/adicionar", "layout/index");
    }

    public function salvar($request){

        $data = [
            'nrpatrimonio' => $request->post->nrpatrimonio,
            'nome' => $request->post->nome,
            'tag' => $request->post->tag,
            'descricao' => $request->post->descricao,
            'datacompra' => $request->post->datacompra,
            'monitorar' => $request->post->monitorar,
            'categoria_ativo_id' => $request->post->categoria_ativo_id,
            'so_id' => $request->post->so_id,
            'modelo_id'=> $request->post->modelo_id,
            'usuario_id' => $request->post->usuario_i
        ];

        $result = $this->modelAtivo->insert($data);

        if (!$request){
            Redirect::route("gerenciamento/ativo");
        }
        else {
            echo "<scrpit> alert('Erro ao salvar!'); </scrpit>";
        }

    }

    public function editar($id, $request){
        echo "Editando ativo id: " . $id . " Com os dados: " . $request->get->nome . " e " . $request->get->obs;
    }

}