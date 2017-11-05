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
        $ativos = $this->ativo->all();
        $oids = $this->oid->all();

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

            return Redirect::route("/monitoramento/snmp/config", [
                "success" => ["Agendamento Atualizado!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/snmp/config", [
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

            return Redirect::route("/monitoramento/snmp/config", [
                "success" => ["Disparos Habilitados!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/snmp/config", [
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

            return Redirect::route("/monitoramento/snmp/config", [
                "success" => ["Disparos Desabilitados!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/servidor", [
                "error" => ["Erro ao Desabilitados Disparos!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function run()
    {
        $return = $this->snmp->runAll();
        echo $return;
    }
}