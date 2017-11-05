<?php

namespace App\Controller;

use App\Model\Agendador;
use App\Model\Internet;
use Core\Controller;
use Core\Redirect;

class InternetController extends Controller
{
    protected $agendador;
    protected $internet;

    public function __construct()
    {
        parent::__construct();

        $this->agendador = new Agendador();
        $this->internet = new Internet();
    }

    public function index()
    {
        $this->view->internets = $this->internet->orderBy("updated_at", "desc")->get();

        $this->setPageTitle("Velocidade da Internet");
        $this->setView("internet/index", "layout/index");
    }

    public function config()
    {
        $this->view->agendador = $this->agendador->where("tipo", "internet")->first();

        $this->setPageTitle("Configurações");
        $this->setView("internet/config", "layout/index");
    }

    public function salvar($request)
    {
        try
        {
            $data = $this->agendador->data($request->post);

            $this->agendador->find($request->post->id)->update($data);

            return Redirect::route("/monitoramento/internet/config", [
                "success" => ["Agendamento Atualizado!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/internet/config", [
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

            return Redirect::route("/monitoramento/internet/config", [
                "success" => ["Disparos Habilitados!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/internet/config", [
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

            return Redirect::route("/monitoramento/internet/config", [
                "success" => ["Disparos Desabilitados!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/internet/config", [
                "error" => ["Erro ao Desabilitados Disparos!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function run()
    {
        $result = $this->internet->run();

        return Redirect::route("/monitoramento/internet");
    }
}