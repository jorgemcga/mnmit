<?php

namespace App\Controller;

use App\Model\Ativo;
use App\Model\Manutencao;
use Core\Controller;
use Core\Redirect;

class ManutencaoController extends Controller
{
    private $ativo;
    private $manutencao;

    public function __construct()
    {
        parent::__construct();
        $this->ativo = new Ativo();
        $this->manutencao = new Manutencao();
    }

    public function index($idAtivo){

        $this->view->ativo = $this->ativo->find($idAtivo);

        $this->view->manutencoes = $this->manutencao->where("ativo_id", $idAtivo)->get();

        $this->view->action = "salvar";
        $this->view->show = "";
        $this->view->manutencao = $this->manutencao;

        $this->setPageTitle("Manutenções em {$this->view->ativo->nome}");
        $this->setView("manutencao/index", "layout/index");

    }

    public function salvar($request){

        $data = $this->manutencao->data($request->post);

        /*$url = $request->post->action=="salvar" ? "/gerenciamento/categoriacomponente/adicionar" :  "/gerenciamento/categoriacomponente/editar/{$request->post->categoria_componente_id}";

        if (Validator::make($data, $this->CategoriaComponente->rules())){
            return Redirect::route("{$url}");
        }*/

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->manutencao->create($data);

                return Redirect::route("/gerenciamento/ativo/manutencao/todas/{$request->post->ativo_id}", [
                    "success" => ["Manutenção Salva com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/gerenciamento/ativo/manutencao/todas/{$request->post->ativo_id}", [
                    "error" => ["Erro ao salvar Manutenção!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->manutencao->find($request->post->id)->update($data);

                return Redirect::route("/gerenciamento/ativo/manutencao/todas/{$request->post->ativo_id}", [
                    "success" => ["Manutenção Salva com Sucesso!"]
                ]);
            } catch (\Exception $exception) {
                return Redirect::route("/gerenciamento/ativo/manutencao/todas/{$request->post->ativo_id}", [
                    "error" => ["Erro ao salvar Manutenção!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id){

        $this->view->action = "editar";
        $this->view->show = "show";

        $this->view->manutencao = $this->manutencao->find($id);
        $this->view->ativo = $this->ativo->find($this->view->manutencao->id);

        $this->view->manutencoes = $this->manutencao->where("ativo_id", $this->view->ativo->id)->get();

        $this->setPageTitle("Editar Manutenção  #{$this->view->manutencao->id}");
        $this->setView("manutencao/index", "layout/index");

    }

//    public function apagar($id){
//
//        if($result = $this->manutencao->delete($id)){
//            Redirect::route("/gerenciamento/ativo");
//        }
//        else {
//            echo '<script language="javascript">';
//            echo 'alert("Erro ao deletar Ativo! Verifique se há pendencias antes de deletar esse item!");';
//            echo 'history.go(-1);';
//            echo '</script>';
//        }
//    }

}