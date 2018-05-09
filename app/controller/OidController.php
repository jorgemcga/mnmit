<?php

namespace App\Controller;

use App\Model\Oid;
use Core\Controller;
use Core\Redirect;

class OidController extends Controller
{
    protected $oid;
    private $urlIndex = BASE_URL . "/monitoramento/oid";

    public function __construct()
    {
        parent::__construct();

        $this->oid = new Oid();
    }

    public function index()
    {
        $this->view->oids = $this->oid->all();

        $this->setPageTitle("Coleção de OID's");
        $this->setView("oid/index", "layout/index");
    }

    public function adicionar()
    {
        $this->view->oid = $this->oid;

        $this->view->action = "salvar";

        $this->setPageTitle("Adicionar OID");
        $this->setView("oid/form", "layout/index");
    }

    public function salvar($request)
    {
        $data = $this->oid->data($request->post);

        if ($request->post->action=="salvar")
        {
            try
            {
                $this->oid->create($data);

                return Redirect::route($this->urlIndex, [
                    "success" => ["OID Salvo com Sucesso!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao salvar OID!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
        elseif ($request->post->action=="editar") {
            try {
                $this->oid->find($request->post->id)->update($data);

                return Redirect::route($this->urlIndex, ["success" => ["OID Atualizado com Sucesso!"]]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route($this->urlIndex, [
                    "error" => ["Erro ao Atualizar OID!", "Verifique os dados e tente novamente!"]
                ]);
            }
        }
    }

    public function editar($id)
    {
        $this->view->action = "editar";

        $this->view->oid = $this->oid->find($id);

        $this->setPageTitle("Editar OID");
        $this->setView('oid/form', 'layout/index');
    }

    public function apagar($id)
    {
        try
        {
            $this->oid->find($id)->delete();

            return Redirect::route($this->urlIndex, ["success" => ["OID excluído!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Erro ao Deletar OID!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}