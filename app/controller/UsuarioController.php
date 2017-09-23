<?php

namespace App\Controller;

use Core\Authenticate;
use App\Model\Grupo;
use App\Model\Usuario;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class UsuarioController extends Controller
{
    use Authenticate;

    private $usuario;
    private $grupo;

    public function __construct()
    {
        parent::__construct();
        $this->usuario = new Usuario();
        $this->grupo = new Grupo();
    }


    public function index(){

        $this->view->usuarios = $this->usuario->all();

        $this->setPageTitle("Usuários");
        $this->setView("usuario/index", "layout/index");

    }

    public function adicionar(){

        $this->view->usuario = $this->usuario;
        $this->view->grupos = $this->grupo->all();

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar Usuário");
        $this->setView("usuario/form", "layout/index");
    }

    public function salvar($request){

        $data = $this->usuario->data($request->post);

        $data['password'] = password_hash($request->post->password,PASSWORD_BCRYPT);

        if ($request->post->action=="salvar")
        {
            $url = "/gerenciamento/usuario/adicionar";

            if (Validator::make($data, $this->usuario->rulesCreate())){
                return Redirect::route("{$url}");
            }

            try
            {
                $this->usuario->create($data);

                return Redirect::route("/gerenciamento/usuario", [
                    "success" => ["Usuário Criado com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/usuario", [
                    "error" => ["Erro ao Criar Usuário!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar")
        {
            $url = "/gerenciament/usuario/editar/{$request->post->usuario_id}";

            if (Validator::make($data, $this->usuario->rulesUpdate($request->post->usuario_id))){
                return Redirect::route("{$url}");
            }

            try
            {
                $this->usuario->find($request->post->id)->update($data);

                return Redirect::route("/gerenciamento/usuario", [
                    "success" => ["Usuário Atualizado com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/usuario", [
                    "error" => ["Erro ao Atulizar Usuário!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";

        $this->view->usuario = $this->usuario->find($id);

        $this->view->grupos = $this->grupo->all();

        $this->setPageTitle("Editar Usuário");
        $this->setView('usuario/form', 'layout/index');

    }

    public function apagar($id)
    {
        try {
            $this->usuario->find($id)->delete();

            return Redirect::route("/gerenciamento/usuario", [
                "success" => ["Usuário Apagado!"]
            ]);
        } catch (\Exception $exception) {
            return Redirect::route("/gerenciamento/usuario", [
                "error" => ["Erro ao Apagar Usuário!", "Verifique se há pendencias antes de deletar!"]
            ]);
        }
    }

}