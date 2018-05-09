<?php

namespace App\Controller;

use App\Model\CategoriaAtivo;
use App\Model\Grupo;
use App\Model\GrupoAtivoCategoria;
use Core\Controller;
use Core\Redirect;

class CategoriaAtivoController extends Controller
{
    private $modelCategoriaAtivo;
    private $grupo;
    private $grupoCategoriaAtivo;
    private $urlIndex = BASE_URL . "/gerenciamento/categoriaativo";

    public function __construct()
    {
        parent::__construct();
        $this->modelCategoriaAtivo = new CategoriaAtivo();
        $this->grupo = new Grupo();
        $this->grupoCategoriaAtivo = new GrupoAtivoCategoria();
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

                return Redirect::route($this->urlIndex, [
                    "success" => ["Categoria criada com sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao criar categoria!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar")
        {
            try
            {
                $this->modelCategoriaAtivo->find($request->post->categoria_ativo_id)->update($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Categoria atualizada com sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao atulizar categoria!", "Verifique os dados e tente novamente!"]
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

            return Redirect::route($this->urlIndex, [
                "success" => ["Categoria Apagada!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Erro ao apagar categoria!", "Verifique se há pendencias para deletar esse item!"]
            ]);
        }
    }

    public function notificacao($id)
    {
        $this->view->categoria = $this->modelCategoriaAtivo->find($id);
        $this->view->grupos = $this->grupo->all();
        $this->view->notificados = $this->grupoCategoriaAtivo->where("categoria_ativo_id", $id)->get();
        return $this->setView('categoria_ativo/notificacao', 'layout/index');
    }

    public function notificar($request)
    {
        $data = $this->grupoCategoriaAtivo->data($request->post);
        try
        {
            $this->grupoCategoriaAtivo->create($data);
            return Redirect::route($this->urlIndex . "/notificacao/{$data['categoria_ativo_id']}",
                ["success" => ["Grupo adicionado"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex . "/notificacao/{$data['categoria_ativo_id']}",
                ["error" => ["Erro ao adicionar grupo", "Verifique se este grupo ja está sendo notificado!"]
            ]);
        }
    }

    public function naoNotificar($grupoId, $categoriaId)
    {
        try {
            $this->grupoCategoriaAtivo->where([['categoria_ativo_id', '=', $categoriaId],['grupo_id', '=', $grupoId]])->delete();

            return Redirect::route($this->urlIndex . "/notificacao/{$categoriaId}",
                ["success" => ["Grupo removido"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex . "/notificacao/{$categoriaId}",
                ["error" => ["Erro ao remover grupo", "Verifique se há pendencias antes de remover!"]
            ]);
        }
    }
}