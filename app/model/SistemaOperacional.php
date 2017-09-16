<?php

namespace App\Model;

use Core\Model;

class SistemaOperacional extends Model
{
    protected $table = "so";

    public $so_id;
    public $nome;
    public $versao;

    public function data($request){
        return [
            'nome' => $request->nome,
            'versao' => $request->versao,
        ];
    }

    public function rules(){
        return [

        ];
    }

}