<?php

namespace App\Model;

use Core\ModeloEloquent;
use Core\Alert;

class Ping extends ModeloEloquent
{
    protected $table = "icmp";

    public $fillable = [
        'status',
        'descricao',
        'interface_rede_id'
    ];

    public function data($request){

        return $data = [
            'status' => $request->status,
            'descricao' => $request->descricao,
            'interface_rede_id' => $request->interface_rede_id,
        ];
    }

    public function rules(){
        return [
        ];
    }

    public function interface_rede()
    {
        return $this->belongsTo('\App\Model\InterfaceRede');
    }

    public function run()
    {
        $interface = new InterfaceRede();
        $monitor = new Monitoramento();

        $interfaces = $interface->where("monitorar", "like","1")->get();

        foreach ($interfaces as $interface)
        {
            if ($monitor->first()->plataforma == "Windows")
                $data = $this->pingWin($interface);
            else
                $data = $this->pingLinux($interface);

            $this->register($data);
            if(!$data["status"]) Alert::ping($interface->ativo->id);
        }
        return true;
    }

    public function pingWin($interface)
    {
        exec("ping {$interface->ip}", $saida, $retorno);

        $newSaida = "";

        foreach ($saida as $peaces)
        {
            str_replace(",", "", $peaces);
            $newSaida .= $peaces . "<br>";
        }

        return [
            'status' => $retorno,
            'descricao' => $newSaida,
            'interface_rede_id' => $interface->id
        ];
    }

    public function pingLinux($interface)
    {
        exec("ping -c4 {$interface->ip}", $saida, $retorno);

        $newSaida = "";

        foreach ($saida as $peaces){
            $newSaida .= $peaces . "<br>";
        }

        return [
            'status' => $retorno,
            'descricao' => $newSaida,
            'interface_rede_id' => $interface->id
        ];
    }

    public function register($data)
    {
        try
        {
            $this->create($data);
            return true;
        }
        catch (\Exception $exception)
        {
            return false;
        }
    }
}