<?php

namespace App\Model;

use Core\ModeloEloquent;

class SistemaOperacional extends ModeloEloquent
{
    protected $table = "so";

    public $fillable = ['nome', 'versao', 'arq'];
    public $timestamps = false;

    public function data($request){
        return [
            'nome' => $request->nome,
            'versao' => $request->versao,
            'arq' => $request->arq,
        ];
    }

    public function rules(){
        return [

        ];
    }

}