<?php

namespace App\Controller;

use App\Model\Fabricante;
use App\Model\Modelo;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class ModeloController extends Controller
{
    private $modelo;
    private $fabricante;
    private $urlIndex = BASE_URL . "/gerenciamento/categoriacomponente";

    public function __construct()
    {
        parent::__construct();
        $this->modelo = new Modelo();
        $this->fabricante = new Fabricante();
    }


    public function index(){

        $this->view->modelos = $this->modelo->all();;

        $this->setPageTitle("Modelos");
        $this->setView("modelo/index", "layout/index");

    }

    public function adicionar(){

        $this->view->modelo = $this->modelo;
        $this->view->fabricante = $this->fabricante->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Modelo");
        $this->setView("modelo/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->modelo->data($request->post);

        $url = $request->post->action=="salvar" ? $this->urlIndex . "/adicionar" :  $this->urlIndex . "/editar/{$request->post->id}";

        if (Validator::make($data, $this->modelo->rules())){
            return Redirect::route("{$url}");
        }

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->modelo->create($data);

                return Redirect::route($this->urlIndex,
                        ["success" => ["Modelo Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex,
                        ["error" => ["Erro ao salvar Modelo!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->modelo->find($request->post->id)->update($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Modelo Salvo com Sucesso!"]
                ]);
            } catch (\Exception $exception) {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Modelo!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->modelo = $this->modelo->find($id);
        $this->view->fabricante = $this->fabricante->all();

        $this->setPageTitle("Editar Modelo");
        $this->setView('modelo/form', 'layout/index');

    }

    public function apagar($id)
    {
        try
        {
            $this->modelo->find($id)->delete();

            return Redirect::route($this->urlIndex, [
                "success" => ["Modelo excluído!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Erro ao deletar Modelo!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}