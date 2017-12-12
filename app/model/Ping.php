<?php

namespace App\Model;

use Core\ModeloEloquent;

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
            if ($monitor->first()->plataforma == "Windows") $return = $this->pingWin($interface);
            else $return =  $this->pingLinux($interface);

            if(!$return) return false;
        }
        return true;
    }

    public function pingWin($interface)
    {
        exec("ping {$interface->ip}", $saida, $retorno);

        $newSaida = "";

        foreach ($saida as $peaces){
            str_replace(",", "", $peaces);
            $newSaida .= $peaces . "<br>";
        }

        $data = [
            'status' => $retorno,
            'descricao' => $newSaida,
            'interface_rede_id' => $interface->id
        ];

        try
        {
            $this->create($data);
            return true;
        }
        catch (\Exception $exception)
        {
            echo $exception;
            return false;
        }
    }

    public function pingLinux($interface)
    {
        exec("ping -c4 {$interface->ip}", $saida, $retorno);

        $newSaida = "";

        foreach ($saida as $peaces){
            $newSaida .= $peaces . "<br>";
        }

        $data = [
            'status' => $retorno,
            'descricao' => $newSaida,
            'interface_rede_id' => $interface->id
        ];

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