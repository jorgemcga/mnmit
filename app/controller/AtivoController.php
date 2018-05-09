<?php

namespace App\Controller;

use App\Model\Ativo;
use App\Model\CategoriaAtivo;
use App\Model\Modelo;
use App\Model\SistemaOperacional;
use App\Model\Usuario;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class AtivoController extends Controller
{
    private $ativo;
    private $categoria;
    private $so;
    private $modelo;
    private $usuario;
    private $urlIndex = BASE_URL . "/gerenciamento/ativo";

    public function __construct()
    {
        parent::__construct();
        $this->ativo = new Ativo();
        $this->categoria = new CategoriaAtivo();
        $this->so = new SistemaOperacional();
        $this->modelo = new Modelo();
        $this->usuario = new Usuario();
    }


    public function index(){

        $this->view->ativos = $this->ativo->all();

        $this->setPageTitle("Ativos");
        $this->setView("ativo/index", "layout/index");

    }

    public function visualizar($id){

        $this->view->ativo = $this->ativo->find($id);

        $this->setPageTitle($this->view->ativo->nome);
        $this->setView("ativo/detalhes", "layout/index");

    }

    public function adicionar(){

        $this->view->ativo = $this->ativo;

        $this->view->categorias = $this->categoria->all();
        $this->view->sos = $this->so->all();
        $this->view->modelos = $this->modelo->all();
        $this->view->usuarios = $this->usuario->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Ativo");
        $this->setView("ativo/form", "layout/index");
    }

    public function salvar($request)
    {
        $data = $this->ativo->data($request->post);

        $url = $request->post->action=="salvar" ? $this->urlIndex . "/adicionar" :  $this->urlIndex . "/editar/{$request->post->ativo_id}";

        if (Validator::make($data, $this->ativo->rules())) return Redirect::route("{$url}");

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->ativo->create($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Ativo Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Ativo!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->ativo->find($request->post->id)->update($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Ativo Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar Ativo!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id)
    {
        $this->view->action = "editar";

        $this->view->ativo = $this->ativo->find($id);

        $this->view->categorias = $this->categoria->all();
        $this->view->sos = $this->so->all();
        $this->view->modelos = $this->modelo->all();
        $this->view->usuarios = $this->usuario->all();

        $this->setPageTitle("Editar Ativo");
        $this->setView('ativo/form', 'layout/index');
    }

    public function apagar($id)
    {
        try
        {
                $this->ativo->find($id)->delete();

            return Redirect::route($this->urlIndex, [
                "success" => ["Ativo excluído!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Erro ao deletar Ativo!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }

}