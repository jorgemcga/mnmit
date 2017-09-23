<?php

namespace App\Model;

use Core\ModeloEloquent;

class Fabricante extends ModeloEloquent
{
    protected $table = "fabricante";

    public $fillable = ['nome'];

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