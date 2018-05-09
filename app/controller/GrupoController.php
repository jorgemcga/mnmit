<?php

namespace App\Controller;

use App\Model\Grupo;
use App\Model\Usuario;
use App\Model\UsuarioGrupo;
use Core\Controller;
use Core\Redirect;

class GrupoController extends Controller
{
    private $grupo;
    private $usuario;
    private $usuarioGrupo;
    private $urlIndex = BASE_URL . "/gerenciamento/grupo";

    public function __construct()
    {
        parent::__construct();
        $this->grupo = new Grupo();
        $this->usuario = new Usuario();
        $this->usuarioGrupo = new UsuarioGrupo();
    }


    public function index()
    {
        $this->view->grupos = $this->grupo->all();
        $this->setPageTitle("Grupos");
        return $this->setView("grupo/index", "layout/index");
    }

    public function adicionar()
    {
        $this->view->grupo = $this->grupo;
        $this->view->action = "salvar";
        $this->setPageTitle("Adicionar Grupo");
        return $this->setView("grupo/form", "layout/index");
    }

    public function salvar($request)
    {
        $data = $this->grupo->data($request->post);

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->grupo->create($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Grupo Criado com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao Criar Grupo!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar")
        {
            try
            {
                $this->grupo->find($request->post->id)->update($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["Grupo Atualizado com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao Atulizar Grupo!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id)
    {
        $this->view->action = "editar";
        $this->view->grupo = $this->grupo->find($id);
        $this->setPageTitle("Editar Grupo");
        return $this->setView('grupo/form', 'layout/index');
    }

    public function apagar($id)
    {
        try
        {
            $this->grupo->find($id)->delete();
            return Redirect::route($this->urlIndex, ["success" => ["Grupo Apagado!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex,
                ["error" => ["Erro ao Apagar Grupo!", "Verifique se há pendencias antes de deletar!"]
            ]);
        }
    }

    public function participantes($id)
    {
        $this->setPageTitle("Participantes");
        $this->view->grupo = $this->grupo->find($id);
        $this->view->usuarios = $this->usuario->all();
        $this->view->participantes = $this->usuarioGrupo->where("grupo_id", $id)->get();
        return $this->setView('grupo/participantes', 'layout/index');
    }

    public function adicionarParticipante($request)
    {
        $data = $this->usuarioGrupo->data($request->post);
        try
        {
            $this->usuarioGrupo->create($data);
            return Redirect::route($this->urlIndex . "/participantes/{$data['grupo_id']}",
                ["success" => ["Participante Adicionado!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex . "/participantes/{$data['grupo_id']}",
                ["error" => ["Erro ao Adicionar Participamente!", "Verifique se este usuário ja está neste grupo!"]
            ]);
        }
    }

    public function removerParticipante($usuarioId, $grupoId)
    {
        try {
            $this->usuarioGrupo->where([['usuario_id', '=', $usuarioId],['grupo_id', '=', $grupoId]])->delete();

            return Redirect::route($this->urlIndex . "/participantes/{$grupoId}",
                ["success" => ["Participante removido!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex . "/participantes/{$grupoId}",
                ["error" => ["Erro ao remover pariticipante!", "Verifique se há pendencias antes de remover!"]
            ]);
        }
    }
}