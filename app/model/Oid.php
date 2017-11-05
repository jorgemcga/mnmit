<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 03/11/2017
 * Time: 16:04
 */

namespace App\Model;


use Core\ModeloEloquent;

class Oid extends ModeloEloquent
{
    protected $table = "oid";

    public $fillable = [
        'nome',
        'oid',
        'versao',
        'string'
    ];

    public function data($request){
        return [
            'nome' => $request->nome,
            'oid' => $request->oid,
            'versao' => $request->versao,
            'string' => $request->string
        ];
    }

    public function rules(){
        return [];
    }
}