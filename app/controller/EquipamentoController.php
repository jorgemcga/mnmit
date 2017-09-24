<?php

namespace App\Controller;

use App\Model\CategoriaEquipamento;
use App\Model\Equipamento;
use App\Model\Usuario;
use Core\Containers;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class EquipamentoController extends Controller
{
    private $equipamento;
    private $categoria;
    private $usuario;

    public function __construct()
    {
        parent::__construct();
        $this->equipamento = new Equipamento();
        $this->categoria = new CategoriaEquipamento();
        $this->usuario = new Usuario();
    }

    public function index(){

        $this->view->equipamentos = $this->equipamento->all();

        $this->setPageTitle("Equipamentos");
        $this->setView("equipamento/index", "layout/index");

    }

    public function adicionar(){

        $this->view->equipamento = $this->equipamento;
        $this->view->categoria_equipamento = $this->categoria->all();
        $this->view->usuarios = $this->usuario->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Equipamento");
        $this->setView("equipamento/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->equipamento->data($request->post);

        $url = $request->post->action=="salvar" ? "/gerenciamento/equipamento/adicionar" :  "/gerenciamento/equipamento/editar/{$request->post->equipamento_id}";

        if (Validator::make($data, $this->equipamento->rules())){
            return Redirect::route("{$url}");
        }

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->equipamento->create($data);

                return Redirect::route("/gerenciamento/equipamento", [
                    "success" => ["Equipamento Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/equipamento", [
                    "error" => ["Erro ao salvar Equipamento!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try
            {
                $this->equipamento->find($request->post->id)->update($data);

                return Redirect::route("/gerenciamento/equipamento", [
                    "success" => ["Equipamento Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/equipamento", [
                    "error" => ["Erro ao salvar Equipamento!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id)
    {
        $this->view->action = "editar";

        $this->view->equipamento = $this->equipamento->find($id);
        $this->view->categoria_equipamento = $this->categoria->all();
        $this->view->usuarios = $this->usuario->all();

        $this->setPageTitle("Editar Equipamento");
        $this->setView('equipamento/form', 'layout/index');
    }

    public function apagar($id)
    {
        try
        {
            $this->equipamento->find($id)->delete();

            return Redirect::route("/gerenciamento/equipamento", [
                "success" => ["Equipamento excluída!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/gerenciamento/equipamento", [
                "error" => ["Erro ao deletar Equipamento!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}