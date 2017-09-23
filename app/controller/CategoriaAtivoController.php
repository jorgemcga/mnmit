<?php

namespace App\Controller;

use App\Model\CategoriaAtivo;
use Core\Controller;
use Core\Redirect;

class CategoriaAtivoController extends Controller
{
    private $modelCategoriaAtivo;

    public function __construct()
    {
        parent::__construct();
        $this->modelCategoriaAtivo = new CategoriaAtivo();
    }

    public function index()
    {

        $this->view->categoria_ativos = $this->modelCategoriaAtivo->all();

        $this->setPageTitle("Categorias de Ativos");
        $this->setView("categoria_ativo/index", "layout/index");

    }

    public function adicionar()
    {

        $this->view->categoria_ativo = $this->modelCategoriaAtivo;
        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Categoria de Ativo");
        $this->setView("categoria_ativo/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->modelCategoriaAtivo->data($request->post);

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->modelCategoriaAtivo->create($data);

                return Redirect::route("/gerenciamento/categoriaativo", [
                    "success" => ["Categoria Criada com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/categoriaativo", [
                    "error" => ["Erro ao Criar Categoria!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar")
        {
            try
            {
                $this->modelCategoriaAtivo->find($request->post->categoria_ativo_id)->update($data);

                return Redirect::route("/gerenciamento/categoriaativo", [
                    "success" => ["Categoria Atualizada com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/categoriaativo", [
                    "error" => ["Erro ao Atulizar Categoria!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id)
    {
        $this->view->action = "editar";

        $this->view->categoria_ativo = $this->modelCategoriaAtivo->find($id);

        $this->setPageTitle("Editar Categoria");
        $this->setView('categoria_ativo/form', 'layout/index');

    }

    public function apagar($id)
    {
        try
        {
            $this->modelCategoriaAtivo->find($id)->delete();

            return Redirect::route("/gerenciamento/categoriaativo", [
                "success" => ["Categoria Apagada!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/gerenciamento/categoriaativo", [
                "error" => ["Erro ao Apagar Categoria!", "Verifique se há pendencias para deletar esse item!"]
            ]);
        }
    }
}