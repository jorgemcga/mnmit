<?php

namespace App\Controller;

use App\Model\CategoriaLicenca;
use App\Model\Licenca;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class LicencaController extends Controller
{
    private $licenca;
    private $categoria;

    public function __construct()
    {
        parent::__construct();
        $this->licenca = new Licenca();
        $this->categoria = new CategoriaLicenca();
    }

    public function index()
    {
        $this->view->licencas = $this->licenca->all();

        $this->setPageTitle("Licenças");
        $this->setView("licenca/index", "layout/index");
    }

    public function adicionar(){

        $this->view->licenca = $this->licenca;
        $this->view->categorias = $this->categoria->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Licença");
        $this->setView("licenca/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->licenca->data($request->post);

        $url = $request->post->action=="salvar" ? "/gerenciamento/licenca/adicionar" :  "/gerenciamento/licenca/editar/{$request->post->licenca_id}";

       if (Validator::make($data, $this->licenca->rules())){
           return Redirect::route("{$url}");
       }

       if ($request->post->action=="salvar")
        {
            try
            {
                $this->licenca->create($data);

                return Redirect::route("/gerenciamento/licenca", [
                    "success" => ["Licença Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/licenca", [
                    "error" => ["Erro ao salvar Licença!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
       elseif ($request->post->action=="editar") {
            try
            {
                $this->licenca->find($request->post->id)->update($data);

                return Redirect::route("/gerenciamento/licenca", [
                    "success" => ["Licença Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/licenca", [
                    "error" => ["Erro ao salvar Licença!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->licenca = $this->licenca->find($id);

        $this->view->categorias = $this->categoria->all();

        $this->setPageTitle("Editar Licenca");
        $this->setView('licenca/form', 'layout/index');

    }

    public function apagar($id)
    {
        try
        {
            $this->licenca->find($id)->delete();

            return Redirect::route("/gerenciamento/licenca", [
                "success" => ["Licença excluída!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/gerenciamento/licenca", [
                "error" => ["Erro ao deletar Licença!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}