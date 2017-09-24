<?php

namespace App\Controller;

use App\Model\CategoriaLicenca;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class CategoriaLicencaController extends Controller
{
    private $categoria;

    public function __construct()
    {
        parent::__construct();
        $this->categoria = new CategoriaLicenca();
    }

    public function index()
    {
        $this->view->categorias = $this->categoria->all();

        $this->setPageTitle("Categoria de Licenças");
        $this->setView("categoria_licenca/index", "layout/index");

    }

    public function adicionar()
    {
        $this->view->categoria = $this->categoria;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Licenca");
        $this->setView("categoria_licenca/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->categoria->data($request->post);

        $url = $request->post->action=="salvar" ? "/gerenciamento/categorialicenca/adicionar" :  "/gerenciamento/categorialicenca/editar/{$request->post->categoria_licenca_id}";

        if (Validator::make($data, $this->categoria->rules())){
            return Redirect::route("{$url}");
        }

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->categoria->create($data);

                return Redirect::route("/gerenciamento/categorialicenca", [
                    "success" => ["Categoria Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/categorialicenca", [
                    "error" => ["Erro ao salvar Categoria!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->categoria->find($request->post->id)->update($data);

                return Redirect::route("/gerenciamento/categorialicenca", [
                    "success" => ["Categoria Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/categorialicenca", [
                    "error" => ["Erro ao salvar Categoria!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id)
    {
        $this->view->action = "editar";

        $this->view->categoria = $this->categoria->find($id);

        $this->setPageTitle("Editar Licença");
        $this->setView('categoria_licenca/form', 'layout/index');

    }

    public function apagar($id)
    {
        try
        {
            $this->categoria->find($id)->delete();

            return Redirect::route("/gerenciamento/categorialicenca", [
                "success" => ["Categoria excluída!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/gerenciamento/categorialicenca", [
                "error" => ["Erro ao deletar Categoria!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}