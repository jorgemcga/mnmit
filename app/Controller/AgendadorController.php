<?php
/**
 * Description of AgendadorController
 *
 * @author jorge m abdalla
 */

namespace App\Controller;

use App\Model\Agendador;
use Core\Controller;
use Core\Redirect;
use Core\Validator;

class AgendadorController extends Controller
{
    private $agendador;
    private $url;

    public function __construct()
    {
        parent::__construct();
        $this->agendador = new Agendador();
        $this->url = $_SERVER['HTTP_REFERER'];
    }

    public function add($request)
    {
        try
        {
            $this->agendador->create($this->agendador->data($request->post));
            return Redirect::route($this->url, ["success" => ["Disparo salvo com sucesso"]]);
        }
            catch (\Exception $exception)
            {
                echo $exception->getMessage();
                return Redirect::route($this->url, [
                    "error" => ["Ops... não foi possével salvar disparo", "Verifique os dados e tente novamente!"]
                ]);
            }
    }

    public function enable($id)
    {
        try
        {
            $this->agendador->find($id)->update(['status' => '1']);
            return Redirect::route($this->url, ["success" => ["Disparo habilitado"]]);
        }
        catch (\Exception $e)
        {
            return Redirect::route($this->url, ["error" => ["Ops... não foi possível habilitar o disparo"]]);
        }
    }

    public function disable($id)
    {
        try
        {
            $this->agendador->find($id)->update(['status' => '0']);
            return Redirect::route($this->url, ["success" => ["Disparo desabilitado"]]);
        }
        catch (\Exception $e)
        {
            return Redirect::route($this->url, ["error" => ["Ops... não foi possível desabilitar o disparo"]]);
        }
    }

    public function delete($id)
    {
        try
        {
            $this->agendador->find($id)->delete();

            return Redirect::route($this->url, ["success" => ["Disparo excluído"]]);
        }
        catch (\Exception $e)
        {
            return Redirect::route($this->url, ["error" =>
                ["Ops... não foi possível deletar o disparo!", "Verifique se há pendencias antes de deletar esse item"]
            ]);
        }
    }
}
