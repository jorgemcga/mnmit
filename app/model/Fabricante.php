<?php

namespace App\Model;

use Core\Model;

class Fabricante extends Model
{
    protected $table = "fabricante";

    public $fabricante_id = "";
    public $nome = "";

    public function data($request){
        return [
            'nome' => $request->nome
        ];
    }

    public function rules(){
        return [

        ];
    }

}