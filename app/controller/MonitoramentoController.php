<?php

namespace App\Controller;

use App\Model\Agendador;
use App\Model\Ativo;
use App\Model\Http;
use App\Model\InterfaceRede;
use App\Model\Internet;
use App\Model\Monitoramento;
//use App\Model\Oid;
use App\Model\Ping;
use App\Model\Snmp;
use Core\Controller;
use Core\Redirect;
use Core\Cron;

class MonitoramentoController extends Controller {

    protected $ativo;
    protected $monitor;
    protected $agendador;
    protected $interface;
    protected $ping;
    protected $http;
    protected $snmp;
    protected $internet;
    private $urlIndex = BASE_URL . "/monitoramento/servidor";

    public function __construct()
    {
        parent::__construct();
        $this->ativo = new Ativo();
        $this->monitor = new Monitoramento();
        $this->agendador = new Agendador();
        $this->interface = new InterfaceRede();
        $this->ping = new Ping();
        $this->http = new Http();
        $this->snmp = new Snmp();
        $this->internet = new Internet();
    }

    public function index()
    {
        if ($this->monitor->first()->status == 0) return false;

        foreach ($this->agendador->all() as $agendado)
        {
            if($agendado->status && Cron::validate($agendado))
            {
                $agendado->touch();
                $this->run($agendado->tipo);
            }
        }
    }

    public function run($type)
    {
        switch ($type)
        {
            case "icmp":
                $this->ping->run();
                break;
            case "http":
                $this->http->run();
                break;
            case "snmp":
                $this->snmp->run();
                break;
            case "internet":
                $this->internet->run();
                break;
            default:
                break;
        }
    }

    public function servidor()
    {
        $this->view->servidor = $this->monitor->first();
        $this->setPageTitle("Servidor Monitor");
        return $this->setView("monitoramento/index", "layout/index");
    }

    public function novo($request)
    {
        $data = $this->monitoramento->data($request->post);
        if (Validator::make($data, $this->monitor->rules())) return false;
        try
        {
            $this->monitor->create($data);
            return true;
        }
        catch (\Exception $exception)
        {
            return false;
        }
    }

    public function config($id)
    {
        $this->view->monitor = $this->monitor->find($id);
        $this->setPageTitle("Configurações Servidor");
        return $this->setView("monitoramento/config", "layout/index");
    }

    public function salvar($request)
    {
        try
        {
            $data = $this->monitor->data($request->post);
            $this->monitor->find($request->post->id)->update($data);
            return Redirect::route($this->urlIndex, ["success" => ["Servidor Atualizado!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex,
                    ["error" => ["Erro ao Atualizar Servidor!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function start($id)
    {
        try
        {
            $this->monitor->find($id)->update(['status' => '1']);
            return Redirect::route($this->urlIndex, ["success" => ["Servidor Iniciado!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex,
                    ["error" => ["Erro ao Iniciar Servidor!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function stop($id)
    {
        try
        {
            $this->monitor->find($id)->update(['status' => '0']);
            return Redirect::route($this->urlIndex, ["success" => ["Servidor Parado!"]]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex,
                    ["error" => ["Erro ao Parar Servidor!", "Verifique se nenhum processo está executando e tente novamente!"]
            ]);
        }
    }

    public function pingAll()
    {
        $interfaces = $this->interface->where("monitorar", "like","1")->get();
        foreach ($interfaces as $interface)
        {
            if ($this->monitor->first()->plataforma == "Windows") $return = $this->ping->pingWin($interface);
            else $return =  $this->ping->pingLinux($interface);
            if(!$return) return false;
        }
        return true;
    }
}