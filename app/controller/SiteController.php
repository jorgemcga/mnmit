<?php

namespace App\Controller;

use App\Model\Site;
use Core\Controller;
use Core\Redirect;

class SiteController extends Controller
{
    protected $site;

    public function __construct()
    {
        parent::__construct();
        $this->site = new Site();
    }

    public function index()
    {
        $this->view->sites = $this->site->all();

        $this->setPageTitle("Sites");
        $this->setView("site/index", "layout/index");
    }

    public function adicionar()
    {
        $this->view->site = $this->site;
        $this->view->action = "salvar";

        $this->setPageTitle("Novo Site");
        $this->setView("site/form", "layout/index");
    }

    public function editar($id)
    {
        $this->view->action = "editar";

        $this->view->site = $this->site->find($id);

        $this->setPageTitle("Editar Site");
        $this->setView('site/form', 'layout/index');
    }

    public function salvar($request)
    {
        $data = $this->site->data($request->post);

        //$data['senha'] = password_hash($request->post->senha,PASSWORD_BCRYPT);

        //$url = $request->post->action=="salvar" ? "/monitoramento/site/adicionar" :  "/monitoramento/site/editar/{$request->post->id}";
        //if (Validator::make($data, $this->ativo->rules())) return Redirect::route("{$url}");

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->site->create($data);

                return Redirect::route("/monitoramento/site", [
                    "success" => ["Site Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/monitoramento/site", [
                    "error" => ["Erro ao salvar Site!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->ativo->find($request->post->id)->update($data);

                return Redirect::route("/monitoramento/site", [
                    "success" => ["Site Atualizado com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/monitoramento/site", [
                    "error" => ["Erro ao Atualizar Site!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function apagar($id)
    {
        try
        {
            $this->site->find($id)->delete();

            return Redirect::route("/monitoramento/site", [
                "success" => ["Site excluído!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/site", [
                "error" => ["Erro ao deletar Site!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}