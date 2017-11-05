<?php

namespace App\Model;

use Core\ModeloEloquent;

class OidAtivo extends ModeloEloquent
{
    protected $table = "ativo_oid";

    public $timestamps = false;

    public $fillable = [
        'oid_id',
        'ativo_id',
        'ip'
    ];

    public function data($request){
        return [
            'oid_id' => $request->oid_id,
            'ativo_id' => $request->ativo_id,
            'ip' => $request->ip
        ];
    }

    public function ativo()
    {
        return $this->belongsTo("App\Model\Ativo");
    }

    public function oid()
    {
        return $this->belongsTo("App\Model\Oid");
    }
}