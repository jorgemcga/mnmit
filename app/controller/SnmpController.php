<?php

namespace App\Controller;

use App\Model\Agendador;
use App\Model\Ativo;
use App\Model\Oid;
use App\Model\Snmp;
use Core\Controller;
use Core\Redirect;

class SnmpController extends Controller
{
    protected $agendador;
    protected $snmp;
    protected $ativo;
    protected $oid;
    private $urlIndex = BASE_URL . "/monitoramento/snmp";
    private $urlConf = BASE_URL . "/monitoramento/snmp/config";

    public function __construct()
    {
        parent::__construct();
        $this->agendador = new Agendador();
        $this->snmp = new Snmp();
        $this->ativo = new Ativo();
        $this->oid = new Oid();
    }

    public function index()
    {

        $oids = $this->oid->all();$ativos = $this->ativo->all();

        foreach ($ativos as $ativo) {
            foreach ($oids as $oid) {
                $this->view->snmps[] = $this->snmp->where([ ["ativo_id","=",$ativo->id],["oid_id","=", $oid->id]])->orderBy("updated_at", "desc")->first();
            }
        }

        $this->setPageTitle("Monitoramento SNMP");
        $this->setView("snmp/index", "layout/index");
    }

    public function config()
    {
        $this->view->agendador = $this->agendador->where("tipo", "snmp")->first();

        $this->setPageTitle("Configurações SNMP");
        $this->setView("snmp/config", "layout/index");
    }

    public function salvar($request)
    {
        try
        {
            $data = $this->agendador->data($request->post);

            $this->agendador->find($request->post->id)->update($data);

            return Redirect::route($this->urlConf, [
                "success" => ["Agendamento Atualizado!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlConf, [
                "error" => ["Erro ao Configurar Agendador!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function start($id)
    {
        try
        {
            $data = ['status' => '1'];

            $this->agendador->find($id)->update($data);

            return Redirect::route($this->urlConf, [
                "success" => ["Disparos Habilitados!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlConf, [
                "error" => ["Erro ao Habilitar Disparos!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function stop($id)
    {
        try
        {
            $data = ['status' => '0'];

            $this->agendador->find($id)->update($data);

            return Redirect::route($this->urlConf, [
                "success" => ["Disparos Desabilitados!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlConf, [
                "error" => ["Erro ao Desabilitados Disparos!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function run()
    {
        try
        {
            $this->snmp->run();
            return Redirect::route($this->urlIndex, ["success" => ["Executado com Sucesso!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex,
                ["error" => ["Houve um erro ao pegar valores SNMP!", "Verifique as configurações!"]
            ]);
        }
    }
}