<?php

namespace App\Controller;

use App\Model\Grupo;
use Core\Controller;
use Core\Redirect;

class GrupoController extends Controller
{
    private $grupo;

    public function __construct()
    {
        parent::__construct();
        $this->grupo = new Grupo();
    }


    public function index(){

        $this->view->grupos = $this->grupo->all();

        $this->setPageTitle("Grupos");
        $this->setView("grupo/index", "layout/index");

    }

    public function adicionar(){

        $this->view->grupo = $this->grupo;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Grupo");
        $this->setView("grupo/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->grupo->data($request->post);

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->grupo->create($data);

                return Redirect::route("/gerenciamento/grupo", [
                    "success" => ["Grupo Criado com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/grupo", [
                    "error" => ["Erro ao Criar Grupo!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar")
        {
            try
            {
                $this->grupo->find($request->post->id)->update($data);

                return Redirect::route("/gerenciamento/grupo", [
                    "success" => ["Grupo Atualizado com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/grupo", [
                    "error" => ["Erro ao Atulizar Grupo!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->grupo = $this->grupo->find($id);

        $this->setPageTitle("Editar Grupo");
        $this->setView('grupo/form', 'layout/index');

    }

    public function apagar($id)
    {
        try {
            $this->grupo->find($id)->delete();

            return Redirect::route("/gerenciamento/grupo", [
                "success" => ["Grupo Apagado!"]
            ]);
        } catch (\Exception $exception) {
            return Redirect::route("/gerenciamento/grupo", [
                "error" => ["Erro ao Apagar Grupo!", "Verifique se há pendencias antes de deletar!"]
            ]);
        }
    }
}