<?php

namespace App\Controller;

use App\Model\Ativo;
use App\Model\CategoriaComponente;
use App\Model\Componente;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class ComponenteController extends Controller
{
    private $componente;
    private $categoria;
    private $ativo;

    public function __construct()
    {
        parent::__construct();

        $this->componente = new Componente();
        $this->ativo = new Ativo();
        $this->categoria = new CategoriaComponente();
    }

    public function index(){

        $this->view->componentes = $this->componente->all();

        $this->setPageTitle("Componentes");
        $this->setView("componente/index", "layout/index");

    }

    public function adicionar(){

        $this->view->componente = $this->componente;
        $this->view->ativo = $this->ativo->all();
        $this->view->categoria = $this->categoria->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Componente");
        $this->setView("componente/form", "layout/index");
    }

    public function salvar($request)
    {
        $data = $this->componente->data($request->post);

        $url = $request->post->action=="salvar" ? "/gerenciamento/componente/adicionar" :  "/gerenciamento/componente/editar/{$request->post->componente_id}";

        if (Validator::make($data, $this->componente->rules())){
            return Redirect::route("{$url}");
        }

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->componente->create($data);

                return Redirect::route("/gerenciamento/componente", [
                    "success" => ["Componente Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/componente", [
                    "error" => ["Erro ao salvar Componente!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try
            {
                $this->componente->find($request->post->id)->update($data);

                return Redirect::route("/gerenciamento/componente", [
                    "success" => ["Componente Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/componente", [
                    "error" => ["Erro ao salvar Componente!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->componente = $this->componente->find($id);

        $this->view->ativo = $this->ativo->all();
        $this->view->categoria = $this->categoria->all();

        $this->setPageTitle("Editar Componente");
        $this->setView('componente/form', 'layout/index');

    }

    public function apagar($id)
    {
        try
        {
            $this->componente->find($id)->delete();

            return Redirect::route("/gerenciamento/componente", [
                "success" => ["Componente excluído!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/gerenciamento/componente", [
                "error" => ["Erro ao deletar Componente!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}