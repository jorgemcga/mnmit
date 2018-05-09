<?php

namespace App\Controller;

use App\Model\Ativo;
use App\Model\Oid;
use App\Model\OidAtivo;
use Core\Controller;
use Core\Redirect;
use PHPMailer\PHPMailer\Exception;

class OidAtivoController extends Controller
{
    protected $oidAtivo;
    protected $oid;
    protected $ativo;
    private $urlIndex = BASE_URL . "/monitoramento/oid-ativo";

    public function __construct()
    {
        parent::__construct();

        $this->oidAtivo = new OidAtivo();
        $this->oid = new Oid();
        $this->ativo = new Ativo();
    }

    public function index()
    {
        $this->view->ativos = $this->ativo->all();
        $this->view->oids = $this->oid->all();

        $this->view->oidAtivo = $this->oidAtivo->all();

        $this->setPageTitle("Relacionar OID e Ativo");
        $this->setView("oid_ativo/index", "layout/index");
    }

    public function salvar($request)
    {
        $data = $this->oidAtivo->data($request->post);

        try
        {
            $this->oidAtivo->create($data);

            return Redirect::route($this->urlIndex, ["success" => ["OID atrelada ao Ativo!"]]);
        }
        catch (\Exception $exception)
        {
            if($exception->getCode() == 23000)
            {
                return Redirect::route($this->urlIndex,
                    ["error" => ["Impossível criar relação!", "Este relacionamento já existe!"]
                ]);
            }
            return Redirect::route("/monitoramento/oid-ativo",
                ["error" => ["Não foi possível criar a relação!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function apagar($idOid, $idAtivo)
    {
        try {
            $this->oidAtivo->where([['oid_id', '=', $idOid],['ativo_id', '=', $idAtivo]])->delete();

            return Redirect::route($this->urlIndex, ["success" => ["Relacionamento Desfeito!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex,
                ["error" => ["Erro ao Desfazer Relacionamento!", "Verifique se há pendencias antes de deletar!"]
            ]);
        }
    }

}