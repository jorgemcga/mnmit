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
    private $urlIndex = BASE_URL . "/monitoramento/internet";
    private $urlConf = BASE_URL . "/monitoramento/internet/config";

    public function __construct()
    {
        parent::__construct();

        $this->agendador = new Agendador();
        $this->internet = new Internet();
    }

    public function index()
    {
        $this->view->internets = $this->internet->orderBy("updated_at", "desc")->limit(30)->get();

        $this->setPageTitle("Velocidade da Internet");
        $this->setView("internet/index", "layout/index");
    }

    public function config()
    {
        $this->view->agendados = $this->agendador->where("tipo", "internet")->get();

        $this->setPageTitle("Configurações");
        $this->setView("internet/config", "layout/index");
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

    public function run()
    {
        try
        {
            $this->internet->run();

            return Redirect::route($this->urlIndex, [
                "success" => ["Executado com sucesso!"]
            ]);
        }
        catch (\Exception $exception)
        {
            return Redirect::route($this->urlIndex, [
                "error" => ["Houve um erro ao executar o Monitoramento da Internet!", "Verifique as configurações!"]
            ]);
        }
    }
}