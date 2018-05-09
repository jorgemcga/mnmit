<?php

namespace App\Controller;

use App\Model\SistemaOperacional;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class SistemaOperacionalController extends Controller
{

    private $so;
    private $urlIndex = BASE_URL . "/gerenciamento/sistemaoperacional";

    public function __construct()
    {
        parent::__construct();
        $this->so = new SistemaOperacional();
    }

    public function index()
    {

        $this->view->so = $this->so->all();

        $this->setPageTitle("Sistemas Operacionais");
        $this->setView("so/index", "layout/index");

    }

    public function adicionar()
    {

        $this->view->so = $this->so;
        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Sistema Operacional");
        $this->setView("so/form", "layout/index");
    }

    public function salvar($request)
    {
        $data = $this->so->data($request->post);

        $url = $request->post->action=="salvar" ? $this->urlIndex . "/adicionar" :  $this->urlIndex . "/editar/{$request->post->id}";

        if (Validator::make($data, $this->so->rules())) return Redirect::route("{$url}");

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->so->create($data);

                return Redirect::route($this->urlIndex, ["success" => ["Sistema Operacional Salvo com Sucesso!"]]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Sistema Operacional!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->so->find($request->post->id)->update($data);

                return Redirect::route($this->urlIndex, ["success" => ["Sistema Operacional Salvo com Sucesso!"]]);
            } catch (\Exception $exception) {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Sistema Operacional!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->so = $this->so->find($id);

        $this->setPageTitle("Editar Sistema Operacional");
        $this->setView('so/form', 'layout/index');

    }

    public function apagar($id)
    {
        try
        {
            $this->so->find($id)->delete();

            return Redirect::route($this->urlIndex, ["success" => ["Sistema Operacional excluído!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Erro ao deletar Sistema Operacional!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}