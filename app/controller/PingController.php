<?php

namespace App\Controller;

use App\Model\Agendador;
use App\Model\Ativo;
use App\Model\InterfaceRede;
use App\Model\Ping;
use Core\Controller;
use Core\Redirect;

class PingController extends Controller
{
    protected $ping;
    protected $interface;
    protected $agendador;
    protected $ativo;

    public function __construct()
    {
        parent::__construct();
        $this->ping = new Ping();
        $this->interface = new InterfaceRede();
        $this->agendador = new Agendador();
        $this->ativo = new Ativo();
    }

    public function index()
    {
        $interfaces = $this->interface->where("monitorar", 1)->get();

        foreach ($interfaces as $interface) {
            $this->view->pings[] = $this->ping->where("interface_rede_id", "$interface->id")->orderBy("updated_at", "desc")->first();
        }

        $this->setPageTitle("Monitor ICMP (Ping)");
        $this->setView("ping/index", "layout/index");
    }

    public function config()
    {
        $this->view->agendador = $this->agendador->where("tipo", "icmp")->first();

        $this->view->ativos = $this->ativo->all();

        $this->setPageTitle("Configurações ICMP (Ping)");
        $this->setView("ping/config", "layout/index");
    }

    public function salvar($type, $request)
    {
        if ($type == 1){
            try
            {
                $data = $this->agendador->data($request->post);

                $this->agendador->find($request->post->id)->update($data);

                return Redirect::route("/monitoramento/icmp/config", [
                    "success" => ["Agendamento Atualizado!"]
                ]);
            }
            catch (\Exception $exception)
            {
                return Redirect::route("/monitoramento/icmp/config", [
                    "error" => ["Erro ao Configurar Agendador!", "Verifique a conexão com o banco de dados!"]
                ]);
            }
        } else
        {
            foreach ($request->post as $item) {
                $itens[] = $item;
            }

            for($i=0; $i<count($itens); $i++){

                echo $itens[$i] . "<br>";
                echo $itens[$i+1] . "<br><br>";

                try
                {
                    $this->interface->where("id", $itens[$i])->update(["monitorar" => $itens[$i+1]]);
                }
                catch (\Exception $exception)
                {
                    return Redirect::route("/monitoramento/icmp/config", [
                        "error" => ["Erro ao Tentar Salvar!"]
                    ]);
                }

                $i++;
            }

            return Redirect::route("/monitoramento/icmp/config", [
                "success" => ["Interfaces Monitoradas Salva!"]
            ]);
        }
    }
}