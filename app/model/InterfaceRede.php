<?php

namespace App\Model;

use Core\ModeloEloquent;

class InterfaceRede extends ModeloEloquent
{
    protected $table = "interface_rede";

    public $timestamps = false;

    public $fillable = [
        'hostname',
        'ip',
        'mascara',
        'gateway',
        'dns1',
        'dns2',
        'macaddress',
        'monitorar',
        'ativo_id'
    ];

    public function data($request){
        return [
            'hostname' => $request->hostname,
            'ip' => $request->ip,
            'mascara' => $request->mascara,
            'gateway' => $request->gateway,
            'dns1' => $request->dns1,
            'dns2' => $request->dns2,
            'macaddress' => $request->macaddress,
            'monitorar' => $request->monitorar,
            'ativo_id' => $request->ativo_id
        ];
    }

    public function rules(){
        return [

        ];
    }

    public function ativo(){
        return $this->belongsTo("\App\Model\Ativo");
    }

}