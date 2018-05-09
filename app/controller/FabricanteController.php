<?php

namespace App\Controller;

use App\Model\Fabricante;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class FabricanteController extends Controller
{
    private $fabricante;
    private $urlIndex = BASE_URL . "/gerenciamento/fabricante";

    public function __construct()
    {
        parent::__construct();
        $this->fabricante = new Fabricante();
    }


    public function index(){

        $this->view->fabricantes = $this->fabricante->all();

        $this->setPageTitle("Fabricantes");
        $this->setView("fabricante/index", "layout/index");

    }

    public function adicionar(){

        $this->view->fabricante = $this->fabricante;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Fabricante");
        $this->setView("fabricante/form", "layout/index");
    }

    public function salvar($request)
    {
        $data = $this->fabricante->data($request->post);

        $url = $request->post->action=="salvar" ? $this->urlIndex . "/adicionar" :  $this->urlIndex . "/editar/{$request->post->id}";

        if (Validator::make($data, $this->fabricante->rules())){
            return Redirect::route("{$url}");
        }

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->fabricante->create($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Fabricante Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Fabricante!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->fabricante->find($request->post->id)->update($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Fabricante Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Fabricante!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->fabricante = $this->fabricante->find($id);

        $this->setPageTitle("Editar Fabricante");
        $this->setView('fabricante/form', 'layout/index');

    }

    public function apagar($id)
    {
        try
        {
            $this->fabricante->find($id)->delete();

            return Redirect::route($this->urlIndex, [
                "success" => ["Fabricante excluído!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Erro ao deletar Fabricante!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}