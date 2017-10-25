<?php

namespace App\Model;

use Core\ModeloEloquent;

class Monitoramento extends ModeloEloquent
{

    protected $table = "monitor";

    public $fillable = [
        'status',
    ];

    public function data($request){
        return [
            'status' => $request->status,
        ];
    }

    public function rules(){
        return [

        ];
    }

}