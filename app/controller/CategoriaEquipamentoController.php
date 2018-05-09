<?php

namespace App\Controller;

use App\Model\CategoriaEquipamento;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class CategoriaEquipamentoController extends Controller
{
    private $categoria;
    private $urlIndex = BASE_URL . "/gerenciamento/categoriaequipamento";

    public function __construct()
    {
        parent::__construct();
        $this->categoria = new CategoriaEquipamento();
    }


    public function index()
    {
        $this->view->categorias = $this->categoria->all();

        $this->setPageTitle("Categorias de Equipamentos");

        return $this->setView("categoria_equipamento/index", "layout/index");

    }

    public function adicionar()
    {
        $this->view->categoria = $this->categoria;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Categoria");

        return $this->setView("categoria_equipamento/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->categoria->data($request->post);

        $url = $request->post->action=="salvar" ? $this->urlIndex . "/adicionar" :  $this->urlIndex . "/editar/{$request->post->categoria_equipamento_id}";

        if (Validator::make($data, $this->categoria->rules())){
            return Redirect::route("{$url}");
        }

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->categoria->create($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Categoria Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Categoria!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->categoria->find($request->post->id)->update($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Categoria Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Categoria!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id)
    {
        $this->view->action = "editar";

        $this->view->categoria = $this->categoria->find($id);

        $this->setPageTitle("Editar Categoria");

        return $this->setView('categoria_equipamento/form', 'layout/index');
    }

    public function apagar($id)
    {
        try {
            $this->categoria->find($id)->delete();

            return Redirect::route($this->urlIndex, [
                "success" => ["Item excluído!"]
            ]);
        } catch (\Exception $exception) {
            return Redirect::route($this->urlIndex, [
                "error" => ["Erro ao deletar Categoria!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}