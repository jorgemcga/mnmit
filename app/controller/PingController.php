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
    private $urlIndex = BASE_URL . "/monitoramento/icmp";
    private $urlConf = BASE_URL . "/monitoramento/icmp/config";

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
        return $this->setView("ping/index", "layout/index");
    }

    public function config()
    {
        $this->view->agendados = $this->agendador->where("tipo", "icmp")->get();
        $this->view->ativos = $this->ativo->all();
        $this->setPageTitle("Configurações ICMP (Ping)");
        return $this->setView("ping/config", "layout/index");
    }

    public function salvar($type, $request)
    {
        if ($type == 1){
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
                    return Redirect::route($this->urlConf, [
                        "error" => ["Erro ao Tentar Salvar!"]
                    ]);
                }

                $i++;
            }

            return Redirect::route($this->urlConf, [
                "success" => ["Interfaces Monitoradas Salva!"]
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
            $this->ping->run();
            return Redirect::route($this->urlIndex, [
                "success" => ["Executado com sucesso!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Houve um erro ao executar o Monitoramento por Ping!", "Verifique as configurações!"]
            ]);
        }
    }
}