<?php

namespace App\Controller;

use App\Model\Agendador;
use App\Model\Ativo;
use App\Model\InterfaceRede;
use App\Model\Monitoramento;
use App\Model\Ping;
use Core\Controller;
use Core\Redirect;

class MonitoramentoController extends Controller {

    protected $ativo;
    protected $monitor;
    protected $agendador;
    protected $interface;
    protected $ping;

    public function __construct()
    {
        parent::__construct();
        $this->ativo = new Ativo();
        $this->monitor = new Monitoramento();
        $this->agendador = new Agendador();
        $this->interface = new InterfaceRede();
        $this->ping = new Ping();
    }

    public function index()
    {
        if ($this->monitor->first()->status == 0) return 0;

        $agendados = $this->agendador->all();

        foreach ($agendados as $agendado)
        {
            $periodo = false;

            switch ($agendado->periodicidade)
            {
                case "horario":
                    if ($agendado->validarHorario()) {
                        $periodo = true;
                        $agendado->touch();
                    }
                    break;
                case "diario":
                    if ($agendado->validarDiario()) {
                        $periodo = true;
                        $agendado->touch();
                    }
                    break;
                case "semanal":
                    if ($agendado->validarSemanal()) {
                        $periodo = true;
                        $agendado->touch();
                    }
                    break;
                case "mensal":
                    if ($agendado->validarMensal()){
                        $periodo = true;
                        $agendado->touch();
                    }
                    break;
                default:
                    $periodo = false;
                    break;
            }

            if ($periodo)
            {
                switch ($agendado->tipo) {
                    case "icmp":
                        $this->pingAll();
                        break;
                    case "http":
                        break;
                    case "snmp":
                        break;
                    default:
                        break;
                }
            }
        }
    }

    public function servidor()
    {
        $this->view->servidor = $this->monitor->first();

        $this->setPageTitle("Servidor Monitor");
        $this->setView("monitoramento/index", "layout/index");
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

    public function start($id)
    {
        try
        {
            $data = ['status' => '1'];

            $this->monitor->find($id)->update($data);

            return Redirect::route("/monitoramento/servidor", [
                "success" => ["Servidor Iniciado!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/servidor", [
                "error" => ["Erro ao Iniciar Servidor!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function stop($id)
    {
        try
        {
            $data = ['status' => '0'];

            $this->monitor->find($id)->update($data);

            return Redirect::route("/monitoramento/servidor", [
                "success" => ["Servidor Parado!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/servidor", [
                "error" => ["Erro ao Parar Servidor!", "Verifique se nenhum processo está executando e tente novamente!"]
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

           if(!$return) echo "ERRORORORO";
        }

        return 0;

    }
}