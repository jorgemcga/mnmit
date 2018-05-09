<?php

namespace App\Controller;

use App\Model\Ativo;
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
    private $ativo;
    private $urlIndex = BASE_URL . "/gerenciamento/usuario";

    public function __construct()
    {
        parent::__construct();
        $this->usuario = new Usuario();
        $this->grupo = new Grupo();
        $this->ativo = new Ativo();
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
            if (Validator::make($data, $this->usuario->rulesCreate()))
                    return Redirect::route($this->urlIndex . "/adicionar");

            try
            {
                $this->usuario->create($data);

                return Redirect::route($this->urlIndex, ["success" => ["Usuário Criado com Sucesso!"]]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao Criar Usuário!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar")
        {
            $url = $this->urlIndex . "/editar/{$request->post->id}";

            if (Validator::make($data, $this->usuario->rulesUpdate($request->post->id))){
                return Redirect::route($url);
            }

            try
            {
                $this->usuario->find($request->post->id)->update($data);

                return Redirect::route($this->urlIndex, ["success" => ["Usuário Atualizado com Sucesso!"]]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao Atulizar Usuário!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="senha")
        {
            $url = $this->urlIndex . "/alterarsenha/{$request->post->id}";

            $this->usuario = $this->usuario->find($request->post->id);


            if (!password_verify($data['oldpassword'],$this->usuario->password))
            {
                return Redirect::route($url, [
                    "error" =>["oldpassword" => "A senha antiga não combina com a digitada"]
                ]);
            }

            if ($data['password1'] != $data['password2'])
            {
                return Redirect::route($url, [
                    "error" =>["password" => "Senhas não conferem"]
                ]);
            }

            try
            {
                $this->usuario->password = password_hash($data['password1'],PASSWORD_BCRYPT);
                $this->usuario->save();

                return Redirect::route($this->urlIndex . "/perfil/{$this->auth->id()}", [
                    "success" => ["Senha Alterada com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex . "/perfil/{$this->auth->id()}", [
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

            return Redirect::route($this->urlIndex, ["success" => ["Usuário Apagado!"]]);
        } catch (\Exception $exception) {
            return Redirect::route($this->urlIndex,
                ["error" => ["Erro ao Apagar Usuário!", "Verifique se há pendencias antes de deletar!"]
            ]);
        }
    }

    public function changePass($id)
    {
        $this->view->action = "senha";
        $this->view->usuario = $this->usuario->find($id);
        $this->setPageTitle("Alterar Senha");
        return $this->setView('usuario/mudarSenha', 'layout/index');
    }

    public function perfil($id)
    {
        $this->view->usuario = $this->usuario->find($id);
        $this->view->ativos = $this->ativo->where("usuario_id", $id)->get();
        $this->setPageTitle($this->view->usuario->name);
        return $this->setView('usuario/perfil', 'layout/index');
    }
}