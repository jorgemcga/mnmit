<?php

namespace App\Controller;

use App\Model\Agendador;
use App\Model\Http;
use App\Model\Site;
use Core\Controller;
use Core\Redirect;

class HttpController extends Controller
{
    protected $site;
    protected $agendador;
    protected $http;

    public function __construct()
    {
        parent::__construct();

        $this->site = new Site();
        $this->agendador = new Agendador();
        $this->http = new Http();
    }

    public function index()
    {
        $sites = $this->site->all();

        foreach ($sites as $site) {
            $this->view->https[] = $this->http->where("site_id", "$site->id")->orderBy("updated_at", "desc")->first();
        }

        $this->setPageTitle("Monitoramento HTTP/HTTPS");
        $this->setView("http/index", "layout/index");
    }

    public function config()
    {
        $this->view->agendador = $this->agendador->where("tipo", "http")->first();

        $this->setPageTitle("Configurações HTTP/HTTPS");
        $this->setView("http/config", "layout/index");
    }

    public function salvar($request)
    {
        try
        {
            $data = $this->agendador->data($request->post);

            $this->agendador->find($request->post->id)->update($data);

            return Redirect::route("/monitoramento/http/config", [
                "success" => ["Agendamento Atualizado!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/http/config", [
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

            return Redirect::route("/monitoramento/http/config", [
                "success" => ["Disparos Habilitados!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/http/config", [
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

            return Redirect::route("/monitoramento/http/config", [
                "success" => ["Disparos Desabilitados!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/http/config", [
                "error" => ["Erro ao Desabilitados Disparos!", "Verifique a conexão com o banco de dados!"]
            ]);
        }
    }

    public function run()
    {
        try
        {
            $this->http->run();

            return Redirect::route("/monitoramento/http", [
                //"success" => ["Execução!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route("/monitoramento/http", [
                "error" => ["Houve um erro ao executar o Monitoramento de Sites!", "Verifique as configurações!"]
            ]);
        }
    }

}