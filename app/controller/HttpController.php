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
    private $urlIndex = BASE_URL . "/monitoramento/http";
    private $urlConf = BASE_URL . "/monitoramento/http/config";

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
        return $this->setView("http/index", "layout/index");
    }

    public function config()
    {
        $this->view->agendados = $this->agendador->where("tipo", "http")->get();
        $this->setPageTitle("Configurações HTTP/HTTPS");
        return $this->setView("http/config", "layout/index");
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
            $this->http->run();

            return Redirect::route($this->urlIndex, [
                "success" => ["Executado com sucesso!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Houve um erro ao executar o Monitoramento de Sites!", "Verifique as configurações!"]
            ]);
        }
    }
}